Feature: Call quixplorer
    In order to verify radish,
    just call quixplorer

    Scenario: Execute default script
        When I run quixplorer
        Then I expect success
