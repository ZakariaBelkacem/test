<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\WebDriverBy;
class InstaDesabo extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
           
        $tempsNavigation=rand(10000,15000);
        $nbAbonnemen=100;
        //$comptesInsta = array('xsqueezie','yvick','lebledartofficiel1','normanthavaud','tiboinshape');
        //$compteInsta= $comptesInsta[rand(0,count($comptesInsta)-1)];
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
                
                $browser->press('Enregistrer les identifiants')->pause($tempsNavigation);
               
                $browser->assertSee("Votre Story")
                //att pour la recherche
                ->pause($tempsNavigation)
                //va à la page du profil pour se désabo
                ->visit('https://www.instagram.com/'.env('INSTALOGIN', 'rasda_tv').'/?hl=fr')
                ->pause($tempsNavigation)
                //si on voit le lien abonné on clik desuus
                ->assertSee("abonnés")
                 //clieque sur le lien abonné
                 ->click('a[href="/'.env('INSTALOGIN', 'rasda_tv').'/following/"]')
                 ->pause($tempsNavigation);

                 //att que le bouton s'abonner s'affiche
                 $x=25;

                 for ($i=0; $i <$nbAbonnemen; $i++) { 
                    $tempsEntreChaqueLike=rand(1000,2000);
                            try {
                                $browser//->pause($tempsEntreChaqueLike)
                                ->press('Abonné(e)')
                                ->pause($tempsEntreChaqueLike)
                                ->press('Se désabonner');
                            } catch (\Throwable $th) {
                                $browser->driver->executeScript('window.scrollTo(0,'.$x.');');
                                $x+=25;
                                $browser->pause(10000);
                            }
                        
                       
                        
                

                }
        });
    }
}
