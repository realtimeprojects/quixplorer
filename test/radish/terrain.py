from radish import before, after, utils, world

@before.all
def before_all( ):
  #print "before_all"
  world.object = object()
  world.fail_after_times_count = 0
  pass

@after.all
def after_all( endResult ):
  #print "after_all"
  pass

@before.each_feature
def bef( feature ):
  #print "Before feature: " + feature.sentence
  pass

@after.each_feature
def aef( feature ):
  #print "After feature: " + feature.sentence
  pass

@before.each_scenario
def bes( scenario ):
  #print "Before scenario: " + scenario.sentence
  pass

@after.each_scenario
def aes( scenario ):
  #print "After scenario: " + scenario.sentence
  pass

@before.each_step
def bestep( step ):
  #print "Before step: " + step.sentence
  pass

@after.each_step
def aestep( step ):
  #print "After step: " + step.sentence
  pass

@utils("show_metrics")
def show_metrics( features, metrics ):
    print features
    print metrics

#@utils( "split_sentence" )
#def util_split_sentence( sentence ):
  #return 1, sentence
