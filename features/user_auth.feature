Feature: Login Page

    In order to login to the application
    As a registered user
    So the user can see secured application routes

    Background:
        Given there is a user called "test@domain.tld"

    @happy_path @user_auth @selenium2
    Scenario: Login with Success
        Given I visit the login page
        When I fill in the form field email with "test@domain.tld"
        And I fill in the form field password with "password"
        And I press "Login"
        Then I am logged in as a user called "test@domain.tld"
        And I should see "You are logged in!"

