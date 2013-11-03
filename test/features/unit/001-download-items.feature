Feature: Call quixplorer
    In order to verify radish,
    just call quixplorer

    Scenario: Execute default script
        When I execute module fun_down from _include
        Then I expect success

