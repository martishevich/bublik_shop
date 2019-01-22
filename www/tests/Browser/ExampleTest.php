<?php

namespace Tests\Browser;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('123456@gmail.com', 'email')
                ->type('123456', 'password')
                ->press('Login')
                ->seeLink('/home');
        });
    }

}
