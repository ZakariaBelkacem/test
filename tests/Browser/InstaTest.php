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
                    //entre le pseudo
                    ->pause($tempsNavigation)

                    ->assertSee("Instagram")

                    ->type('username', env('INSTALOGIN', 'rien'))
                    //entre le mdp
                    ->type('password',  env('INSTAMDP', 'rien'))
                    ->pause($tempsNavigation)
                    //submit
                    ->click('button[type="submit"]')
                    //att le popup
                    ->pause($tempsNavigation);
                    

          
                    $browser->press('Enregistrer les identifiants')->pause($tempsNavigation);
                  
                   
                  
                    $browser->assertSee("Votre Story")

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
                    $x=100;
                    //att que le bouton s'abonner s'affiche
                    for ($i=0; $i <$nbAbonnemen; $i++) { 
                        $tempsEntreChaqueLike=rand(5000,10000);
                        echo "ok";
                        try {

                            $browser->assertSee('S’abonner')
                            ->pause($tempsEntreChaqueLike)
                            ->press('S’abonner');
                            //bouton se désabos
                           /* if($browser->element('button[tabindex="0"]')){
                                $browser->click('button[tabindex="0"]')->pause(10000);
                            }*/
                        } catch (\Throwable $th) {
                            $x+=100;
                            $browser->driver->executeScript('window.scrollTo(0,'.$x.');');
                            $browser->pause(10000);

                            //throw $th;sqds
                        }

                    }
                   
                ;
        });
    }
}
