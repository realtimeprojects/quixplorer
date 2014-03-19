from logger import Logger
from subprocess import Popen, PIPE

QX_PATH = "src/"
QX_MAIN = "testframe.php"

def run(function = None, args = None):
    cmd = [ 'php', QX_MAIN, "testsession" ]
    actionstr = "";
    if function is not None:
        actionstr += ( "action=%s" % function)
    if args is not None:
        for arg in args:
            actionstr += "&%s" % arg
    if actionstr is not "":
        cmd.append(actionstr)
    Logger.log("running %s" % " ".join(cmd))
    p = Popen( cmd, stdout=PIPE, stderr=PIPE, stdin=PIPE, cwd=QX_PATH )
    exitcode = p.wait()
    output = p.stdout.read()
    return ( exitcode, output, p.stderr.read() )


