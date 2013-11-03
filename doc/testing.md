QuiXplorer Testing
=============================================

## About Quixplorer testing

Quixplorer uses the BDD tool [radish](https://github.com/timofurrer/radish.git)
for doing rudimentary tests on quixplorer.

The tests are fully automated, however, the may currently only run under linux-like
environments and (of course) Mac.

## Requirements

For the tests to successfully run, the following tools are required to be installed
on your machine:

- Python 2.7

- radish (see [radish documentation](https://github.com/timofurrer/radish/blob/master/README.md)
on how to get radish installed on your system

## How do I run the tests

Assuming you current working directory is the root directory of this repository:

    cd ~/quixplorer_src
    radish -b test test/features/system/*

Will run all tests stored under features/system/ directory.

## Directory organization

    test/radish:                      contains radish-dependend stuff like the step files, etc.
    test/radish/steps.py:             translates radish test scripts to test commands

    test/features:                    contains the BDD test scripts for quixplorer
    test/features/system:             contains system_tests
    test/features/unit:               reserved

    test/data:                        data needed for automated testing (reference data)
    test/data/reference:              "The" reference configuration
    test/data/reference/conf.php:     reference conf.php
    test/data/reference/.htusers.php: reference .htusers.php
    test/data/reference/downloads:    contain reference test data in download directory


* test/data contains reference data required for testing


