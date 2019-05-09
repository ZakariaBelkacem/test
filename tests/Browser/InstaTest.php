<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InstaTest extends DuskTestCase
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
            $nbAbonnemen=200;
            $comptesInsta = array('xsqueezie','yvick','lebledartofficiel1','normanthavaud','tiboinshape');
            $compteInsta= $comptesInsta[rand(0,count($comptesInsta)-1)];
                    //se rend à la page login
            $browser->visit('https://www.instagram.com/accounts/login/?hl=fr')
                    //att input username
                    //att input password
                    //att button submit
                    ->pause($tempsNavigation)
                    //entre le pseudo
                    ->type('username', env('INSTALOGIN', 'rien'))
                    //entre le mdp
                    ->type('password',  env('INSTAMDP', 'rien'))
                    //submit
                    ->click('button[type="submit"]')
                    //att le popup
                    ->pause($tempsNavigation);
                    
                   

                    $browser->assertSee(env('INSTALOGIN', 'rasda_tv'))

                    //click sur lepopup
                    //->click('button[tabindex="0"]')
                    //attpour la recherche
                    ->pause($tempsNavigation)
                    //va a la page xsqueezie
                    ->visit('https://www.instagram.com/'.$compteInsta.'/?hl=fr')
                    ->pause($tempsNavigation)
                    //att de voir la page squeeziz
                    ->assertSee($compteInsta)
                    //att que le lien abooné soit présent
                    //clieque sur le lien abonné
                    ->click('a[href="/'.$compteInsta.'/followers/"]')
                    ->pause($tempsNavigation)
                    ->assertSee("Abonnés");

                    
                    //att que le bouton s'abonner s'affiche
                    for ($i=0; $i <$nbAbonnemen; $i++) { 
                        $tempsEntreChaqueLike=rand(10000,20000);
                        echo "ok";
                        try {

                            $browser->assertSee('S’abonner')
                            ->pause($tempsEntreChaqueLike)
                            ->press('S’abonner');
                            //bouton se désabos
                           /* if($browser->element('button[tabindex="0"]')){
                                $browser->click('button[tabindex="0"]')->pause(10000);
                            }*/
                        } catch (Exception $th) {
                            //throw $th;sqds
                        }

                    }
                   
                ;
        });
    }
}
