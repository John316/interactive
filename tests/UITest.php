<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Response;

class UITest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_visit_to_about_page()
    {
        
        // 1. go to home

        $this->visit('/')

        // 2. Press link "About"

            ->click("About")
        
        // 3. See text

            ->see('Text about project')

        // 4. Assert the url = about

            ->seePageIs('about');
    }

    public function test_login_page_is_avalible()
    {
        
        // 1. go to Login page

        $this->visit('/login')

        // 2. See text

            ->see('E-Mail Address')

            ->see('Password')

        // 3. Assert the url = login

            ->seePageIs('login');
    }

        // Test for Events

    public function test_single_creating_event ()
    {
        
        $this->visit('/event/create')

             ->type('Auto Test Event', 'name')

             ->type('Auto Test Event desc', 'desc')

             ->press('Create the Event')

             ->seePageIs('/');
    }
}
