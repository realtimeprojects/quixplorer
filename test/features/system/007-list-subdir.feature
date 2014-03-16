Feature: List file contents
    Check if we are able to list files in subdirectories

    Scenario: Perparation
        Given I have the reference configuration

    Scenario: List subdirectory 'xx'
        When I list directory xx
        Then I expect success
        Then I find file ddd in list
        Then I miss file huhu.txt in list
        Then I miss file haha.txt in list
        Then I miss file nonexistent.txt in list

    Scenario: List subdirectory '/xx' containing absolute path
        When I list directory /xx
        Then I expect success
        Then I find file ddd in list
        Then I miss file huhu.txt in list
        Then I miss file haha.txt in list
        Then I miss file nonexistent.txt in list

