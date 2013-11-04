# -*- coding: utf-8 -*-

import syslog

from radish.hookregistry import after, before
from radish.config import Config
from radish import world


class Logger(object):
    @staticmethod
    def init():
        syslog.openlog("radish")

    @staticmethod
    def free():
        syslog.closelog()

    @staticmethod
    def log(message):
        syslog.syslog(syslog.LOG_NOTICE, message)


@before.all
def log_before_all():
    Logger.init()
    Logger.log("starting test %s" % (unicode(Config().marker)))


@after.all
def log_after_all(endResult):
    Logger.log("test %s terminated" % (unicode(Config().marker)))
    Logger.free()


@before.each_feature
def log_before_feature(feature):
    Logger.log("testing feature %d" % (feature.get_id()))


@after.each_feature
def log_after_feature(feature):
    Logger.log("feature %d terminated" % (feature.get_id()))


@before.each_scenario
def log_before_scenario(scenario):
    Logger.log("testing scenario %d" % (scenario.get_id()))


@after.each_scenario
def log_after_scenario(scenario):
    Logger.log("scenario %d terminated" % (scenario.get_id()))


@before.each_step
def log_before_step(step):
    Logger.log("testing step %d" % (step.get_id()))


@after.each_step
def log_after_step(step):
    if step.has_passed() is False:
        Logger.log("step %d FAILED" % (step.get_id()))
    else:
        Logger.log("step %d terminated" % (step.get_id()))
