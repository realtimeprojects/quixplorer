import re

from radish import step, world
import quixplorer
from expressions import Expressions

# ** steps for list feature of quixplorer

@step(u'I list(?: directory (.*))?')
def I_list(step, directory):
    args = []
    if directory is not None:
        args.append("directory=%s" % directory);
    (world.result, world.output, world.stderr ) = quixplorer.run('list', args)
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


