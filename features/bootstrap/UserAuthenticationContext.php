<?php

use App\User;
use PHPUnit\Framework\TestCase;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\DatabaseTransactions;

/**
 * Defines application features from the specific context.
 */
class UserAuthenticationContext extends MinkContext implements Context
{
    use DatabaseTransactions;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I visit the login page
     */
    public function iVisitTheLoginPage()
    {
        $this->visit(route('login'));
    }

    /**
     * @Given I fill in the form field email with :arg1
     */
    public function iFillInTheFormFieldEmailWith()
    {
        $this->fillField('email', 'test@domain.tld');
    }

    /**
     * @Given I fill in the form field password with :arg1
     */
    public function iFillInTheFormFieldPasswordWith()
    {
        $this->fillField('password', 'password');
    }

    /**
     * @Given there is a user called :email
     *
     * @param mixed $email
     */
    public function thereIsAUserCalled($email)
    {
        if (! User::whereEmail($email)->exists()) {
            $user = factory(User::class)->create([
                'email'    => $email,
                'password' => bcrypt('password'),
            ]);
        }
    }

    /**
     * @Then I am logged in as a user called :email
     *
     * @param mixed $email
     */
    public function iAmLoggedInAsAUserCalled($email)
    {
        $user = User::where('name', $email)->first();

        TestCase::assertSame($email, auth()->user()->email);
    }
}
