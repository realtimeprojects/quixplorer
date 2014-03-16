Feature: Call quixplorer
    In order to verify the default configuration
    i try to run quixplorer with the default configuration

    Scenario: Precondition
        Given I have the default configuration

    Scenario: Execute default script
        When I run quixplorer
        Then I expect success

    Scenario: List
        When I list
        Then I expect success

    Scenario: List contains files
        When I list
        Then I expect success
        Then I find file index.php in list
