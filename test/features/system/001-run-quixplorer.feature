Feature: Call quixplorer
    In order to verify correct configuration,
    just run quixplorer and see if no errors occur

    Scenario: Precondition
        Given I have the reference configuration

    Scenario: Execute default script
        When I run quixplorer
        Then I expect success
