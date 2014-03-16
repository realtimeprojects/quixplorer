import re

from radish import step, world
import quixplorer
from expressions import Expressions

# ** steps for login feature of quixplorer

@step(r'I login to quixplorer%(args)s' % { "args":Expressions.args })
def I_login(step, login_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('login', [ login_data ])
    assert world.result == 0, "login failed: %d\n%s\n%s" % (world.result, world.output, world.stderr)

@step(r'I authenticate to quixplorer%(args)s' % { "args":Expressions.args })
def I_login(step, login_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('authenticate', [ login_data ])
    assert world.result == 0, "authenticaton failed: %d\n%s\n%s" % (world.result, world.output, world.stderr)

