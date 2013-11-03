import re

from radish import step, world
import quixplorer

@step(u'I login to quixplorer(?: with \((.*)\))?')
def I_login(step, login_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('login', [ login_data ])
    assert world.result == 0, "login failed: %d\n%s" % (exitcode, p.stderr.read())

@step(u'I list(?: with \((.*)\))?')
def I_list(step, list_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('list', [ list_data])
    assert world.result == 0, "list failed: %d\n%s" % (exitcode, p.stderr.read())

@step(u'I find file (.*) in list')
def I_find_file_xx_in_list(step, filename):
    assert _has_file(filename, world.output), "file %s not found in %s" % ( filename, world.output)

@step(u'I miss (.*) in list')
def I_miss_file_xx_in_list(step, filename):
    assert _has_file(filename, world.output) == False, "file %s not found in %s" % ( filename, world.output)

def _has_file(filename, output):
    filter = 'value="%s"' % filename
    return re.search(filter, output) != None

