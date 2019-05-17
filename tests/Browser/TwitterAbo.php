<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\WebDriverBy;

class TwitterAbo extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
            
        $this->browse(function (Browser $browser) {

            $tempsNavigation=rand(5000,10000);
            $nbAbonnemen=100;
            $comptesTwiter = array('RoseCarpet','Elsamakeup','jenesuispasjoli','Horia','BeauteActive');
            $compteTwiter= $comptesTwiter[rand(0,count($comptesTwiter)-1)];

            $browser->visit('https://twitter.com/login?lang=fr')
                    ->assertSee('Se connecter à Twitter')
                    ->pause($tempsNavigation)
                    //entre le pseudo
                    ->keys('input.js-initial-focus', env('TWITTERLOGIN', 'rien'))
                    //entre le mdp
                    ->keys('input.js-password-field', env('TWITTERMDP', 'rien'))
                    //submit
                    ->click('button[type="submit"]')
                    //att qu'on connecte
                    ->pause($tempsNavigation)
                    //se rend sur page aboonné du tweet
                    ->visit('https://twitter.com/'.$compteTwiter.'/followers')
                    //pause entre like
                    ->pause($tempsNavigation)
                    ->assertSee("Suivre");
                    for ($i=0; $i <$nbAbonnemen; $i++) { 
                        echo "okk";

                        $tempsEntreChaqueLike=rand(10000,20000);
                        //test si le bouton suivre existe
                       // count($browser->driver->findElements(WebDriverBy::xpath('//*[@id="home-wrapper"]'))) > 0
                        if ($i%5!=0){
                            $browser->pause($tempsEntreChaqueLike)
                            ->press('Suivre');
                        }else {
                            $browser->driver->executeScript('window.scrollTo(0, 50);'); 
                        }
                    }
        });
    }
}
