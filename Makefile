RADISH=radish -b test
TESTS=*

tests:
	$(RADISH) test/features/system/$(TESTS)
