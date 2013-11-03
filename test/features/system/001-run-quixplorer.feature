Feature: Call quixplorer
    In order to verify radish,
    just call quixplorer

    Scenario: Execute default script
        Given I have the reference configuration
        When I run quixplorer
        Then I expect success
