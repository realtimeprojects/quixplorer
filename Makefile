RADISH=radish -b test
TESTS=*

tests:
	$(RADISH) test/features/system/$(TESTS)

unittests:
	phpunit --verbose --include-path=src test/unit/*
