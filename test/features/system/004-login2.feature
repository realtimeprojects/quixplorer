Feature: Login to quixplorer
    In order to have sophisticated access control to quixplorer
    I login to quixplorer to see if authentication procedures work

    Scenario: Perparation
        Given I have the reference configuration

#   Scenario: Login basic mask
#       When I login to quixplorer
#       Then I expect success and result containing (login to this page)

    Scenario: Authenticate without username
        When I login to quixplorer as user "" with password ""
        Then I expect success and result containing (provide a valid user name)

    Scenario: Authenticate without username
        When I login to quixplorer as user "admin" with password ""
        Then I expect success and result containing (provide a valid password)

    Scenario: Authenticate without non existent user and password
        When I login to quixplorer as user "nonexistent_user" with password "invalid"
        Then I expect success and result containing (User name or password invalid)

    Scenario: Authenticate without admin user and invalid password
        When I login to quixplorer as user "admin" with password "invalid"
        Then I expect success and result containing (User name or password invalid)

    Scenario: Authenticate without admin user user and correct password
        When I login to quixplorer as user "admin" with password "pwd_admin"
        Then I expect success
