import re

from radish import step, world
import quixplorer
from expressions import Expressions

# ** steps for login feature of quixplorer

@step(r'I login to quixplorer%(args)s' % { "args":Expressions.args })
def I_login(step, login_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('login', [ login_data ])
    assert world.result == 0, "login failed: %d\n%s" % (world.result, world.stderr)

# ** steps for list feature of quixplorer

@step(u'I list%(args)s' % { "args":Expressions.args} )
def I_list(step, list_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('list', [ list_data ])
    assert world.result == 0, "list failed: %d\n%s\n%s" % (world.result, world.output, world.stderr)

@step(u'I find %(file)s in list' % { "file": Expressions.file } )
def I_find_file_xx_in_list(step, filename):
    assert _has_file(filename, world.output), "file %s not found in %s" % ( filename, world.output)

@step(u'I miss %(file)s in list' % { "file": Expressions.file } )
def I_miss_file_xx_in_list(step, filename):
    assert _has_file(filename, world.output) == False, "file %s not found in %s" % ( filename, world.output)

def _has_file(filename, output):
    filter = 'value="%s"' % filename
    return re.search(filter, output) != None

