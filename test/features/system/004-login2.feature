Feature: Login to quixplorer
    In order to have sophisticated access control to quixplorer
    I login to quixplorer to see if authentication procedures work

    Scenario: Perparation
        Given I have the reference configuration

    Scenario: Login basic mask
        When I login to quixplorer
        Then I expect success and result containing (Login to use quixplorer)

    Scenario: Authenticate without username
        When I authenticate to quixplorer
        Then I expect an error (username or password not set)

    Scenario: Authenticate without username
        When I authenticate to quixplorer with (loginname=admin)
        Then I expect an error (username or password not set)

    Scenario: Authenticate without non existent user and password
        When I authenticate to quixplorer with (loginname=nonexistent&password=invalid)
        Then I expect an error (username or password invalid)

    Scenario: Authenticate without non existent user and password
        When I authenticate to quixplorer with (loginname=admin&password=invalid)
        Then I expect an error (username or password invalid)
