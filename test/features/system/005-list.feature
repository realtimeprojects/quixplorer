Feature: List file contents
    In order to explore the server file conent
    i list the content of the server

    Scenario: Perparation
        Given I have the reference configuration

    Scenario: List
        When I list
        Then I expect success

    Scenario: List contains files
        When I list
        Then I expect success
        Then I find file xx in list
        Then I find file huhu.txt in list
        Then I find file haha.txt in list
        Then I miss file nonexistent.txt in list

    Scenario: List contains symbolic links
        When I list
        Then I find file yy in list

    Scenario: List contains invalid symbolic links
        When I list
        Then I find file zy in list
