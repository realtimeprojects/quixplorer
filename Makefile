RADISH=radish -b test
TESTS=*

default: usertest
.PHONY: tests
tests:
	$(RADISH) test/features/system/$(TESTS)

usertest:
	phpunit --verbose --include-path=src test/unit/User.php

unittests:
	phpunit --verbose --include-path=src test/unit/

test1:
	make TESTS=002* tests

testdebug:
	make TESTS=debug* tests
