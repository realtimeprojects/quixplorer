import re

from radish import step, world
import quixplorer
from expressions import Expressions

@step(r'I login to quixplorer as user "(.*)" with password "(.*)"')
def login(step, user, passwd):
    args = [ "activity=authenticate",
             "loginname="+user,
             "password="+passwd ]
    (world.result, world.output, world.stderr ) = quixplorer.run("login", args)

@step(r'I logout')
def logout(step):
    (world.result, world.output, world.stderr ) = quixplorer.run("logout");

@step(r'I login to quixplorer$')
def I_login(step, login_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('login')
    assert world.result == 0, "login failed: %d\n%s\n%s" % (world.result, world.output, world.stderr)

