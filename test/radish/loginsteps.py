from radish import step, world
import quixplorer

@step(u'I login to quixplorer(?: with \((.*)\))?')
def I_login(step, login_data):
    (world.result, world.output, world.stderr ) = quixplorer.run('login', [ login_data ])
    assert world.result == 0, "login failed: %d\n%s" % (exitcode, p.stderr.read())

