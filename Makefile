RADISH=radish -b test
TESTS=*

.PHONY: tests
tests:
	$(RADISH) test/features/system/$(TESTS)

unittests:
	phpunit --verbose --include-path=src test/unit/*

test1:
	make TESTS=001* tests
