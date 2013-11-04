# -*- coding: utf-8 -*-

from time import sleep
from subprocess import Popen, PIPE
import os
import re
import shutil

from radish import step, world
from radish.hookregistry import after, before

from logger import Logger
import quixplorer
import specialsteps
from expressions import Expressions

# ** steps for running quixplorer

@step(r'I run (\w+) function on quixplorer with %(parameters)s' % { 'parameters':Expressions.parameters } )
def run_quixplorer_with(step, function, arg):
    Logger.log("run_width")
    (world.result, world.output, world.stderr ) = quixplorer.run(function, [ arg ])
    assert world.result == 0, "run failed (%d):\n%s" %  (world.result, "".join(world.output))

@step(r'I run (?:(\w+) function on )?quixplorer(?: without args)?')
def run_quixplorer(step, function):
    (world.result, world.output, world.stderr) = quixplorer.run(function)
    assert world.result == 0, "run failed:\n%s\n%s" % (world.output, world.stderr )

# ** steps for module execution

@step(r'I execute module (\w+) from (\w+)')
def execute_module(step, module, from_dir):
    (world.result, world.output) = quixplorer.run( "%s/%s.php" % ( from_dir, module ) )

# ** expect success result

@step(r'I expect success and a binary result')
def check_success_with_binary_result(step):
    assert world.result == 0, "result was %d\n%s" % ( world.result, "".join(world.output) )
    assert ord(world.output[0]) == 80, "no binary result: %d" % ord(world.output[0])

@step(r'I expect success and result containing %(search)s' % { 'search':Expressions.search } )
def check_success_with_result(step, expected_data):
    assert world.result == 0, "result was %d\n%s" % ( world.result, "".join(world.output) )
    res = "".join(world.output)
    fp = open("src/result.html", "w")
    fp.write(res)
    fp.close()
    assert _has_error(res) == False, "found error in result %s" % res
    if expected_data is not None:
        assert re.search(expected_data, res) != None, "result does not contain '%s':\n'%s'" % (expected_data, res)

@step(r'I expect success$')
def check_success(step):
    check_success_with_result(step, None);

# ** error handling expressions {{{1

@step(r'I (expect|reject) (?:an )error %(error)s' % { 'error': Expressions.search })
def expect_error(step, expect_or_reject, error):
    expect_error = True if expect_or_reject == "expect" else False
    assert world.result == 0, "result was %d\n%s\n%s" % ( world.result, world.output, world.stderr )
    res = world.output
    assert _has_error(res, error) == expect_error, "no %s error %s found in result:\n%s" % (expect_or_reject, error, res)

@step(r'I (expect|reject) an error$')
def expect_any_error(step, expect_or_reject):
    expect_error(step, expect_or_reject, None)

@step(u'I write the binary result to %(file)s' % { 'file':Expressions.file } )
def I_write_the_binary_result_to(step, into_file):
    fp = open(into_file, "wb")
    fp.write(world.output)
    fp.close()

@step(u'I find "([^"]+)" in zip content of %(file)s' % { 'file':Expressions.file } )
def I_find_a_file_in_zip_content_of_zip_archive(step, a_file, zip_archive):
    cmd = [ "unzip", "-l", zip_archive ]
    p = Popen( cmd, stdout=PIPE, stderr=PIPE, stdin=PIPE )
    exitcode = p.wait()
    output = p.stdout.read()
    assert exitcode == 0, "unzip failed: %d\n%s" % (exitcode, p.stderr.read())
    assert re.search(a_file, output)

DATA_DIR = "src/tmp/data"

@step(u'I have the reference configuration')
def I_have_the_reference_configuration(step):
    try:
        shutil.copy("test/data/reference/quixplorer.cfg", "src/_config/")
        shutil.copy("test/data/reference/.htusers.php", "src/_config/")
        if os.path.isdir(DATA_DIR):
            shutil.rmtree(DATA_DIR)
        os.makedirs(DATA_DIR)
        shutil.copytree("test/data/reference/download/data", DATA_DIR+"/download", symlinks=True)
    except shutil.Error as err:
        assert False, "%s" % err

# ** local functions

def _has_error(output, error = None):
    if re.search(r'ERROR', output) is None:
        return False

    if error is None:
        return True

    if re.search(error, output) is None:
        return False

    return True

