Feature: Login to quixplorer
    In order to have sophisticated access control to quixplorer
    I login to quixplorer to see if authentication procedures work

    Scenario: Perparation
        Given I have the reference configuration
        And I logout

    Scenario: Login basic mask
        When I run login function on quixplorer
        Then I expect success and result containing "Login"

    Scenario: Login invalid user
        Then I login to quixplorer as user "nonexistent_user" with password "invalid"
        Then I expect an error "Login failed: nonexistent_user"

    Scenario: Login user with wrong password
        Then I login to quixplorer as user "admin" with password "invalid"
        Then I expect an error "Login failed: admin"

    Scenario: Login user with correct password
        Then I login to quixplorer as user "admin" with password "pwd_admin"
        Then I expect success and result containing "action=logout"
