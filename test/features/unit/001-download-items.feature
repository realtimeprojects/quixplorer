Feature: Call quixplorer
    In order to verify radish,
    just call quixplorer

    Scenario: Execute default script
        When I execute module fun_down from _include
        Then I expect success

# vim: set makeprg=make\ -b\ test\b test/features/unit/001-download-items.feature
