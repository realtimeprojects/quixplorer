Feature: Change admin password
    User may change his password by entering a new one

    Scenario: Perparation
        Given I have the reference configuration
        And I logout

    Scenario: Change password without login
        When I change password with original password "pwd_admin", first password "adm1" and second password "adm2"
        Then I expect an error "Function unavailable"

    Scenario: Login
        Given I login to quixplorer as user "admin" with password "pwd_admin"
        Then I expect success and result containing "action=logout"

    Scenario: Change password with incorrect admin password
        When I change password with original password "wrongpassword", first password "adm1" and second password "adm1"
        Then I expect an error "Username or password incorrect"
        
    Scenario: Passwords differ
        When I change password with original password "pwd_admin", first password "adm1" and second password "adm2"
        Then I expect an error "Passwords don't match"

    Scenario: Successful password change
        When I change password with original password "pwd_admin", first password "adm1" and second password "adm1"
        Then I expect success
        Then I logout
        Then I login to quixplorer as user "admin" with password "pwd_admin"
        And I expect an error "Login failed"
        Then I login to quixplorer as user "admin" with password "adm1"
        Then I expect success and result containing "action=logout"
