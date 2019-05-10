<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

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
           
        $tempsNavigation=rand(5000,10000);
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
                
               

                $browser->assertSee(env('INSTALOGIN', 'rasda_tv'))
                //att pour la recherche
                ->pause($tempsNavigation)
                //va à la page du profil pour se désabo
                ->visit('https://www.instagram.com/'.env('INSTALOGIN', 'rasda_tv').'/?hl=fr')
                ->pause($tempsNavigation)
                //si on voit le lien abonné on clik desuus
                ->assertSee("abonnés")
                 //clieque sur le lien abonné
                 ->click('a[href="/'.env('INSTALOGIN', 'rasda_tv').'/followers/"]')
                 ->pause($tempsNavigation);

                 //att que le bouton s'abonner s'affiche
                 for ($i=0; $i <$nbAbonnemen; $i++) { 
                    $tempsEntreChaqueLike=rand(10000,20000);
                   //si on liker 5fois on rafraichie la page
                    if($i%5==0){
                    //raffraichie la page
                    $browser->driver->executeScript('document.location.reload(true);'); 
                    //pause
                      $browser->pause($tempsNavigation)
                         //clieque sur le lien abonné
                      ->click('a[href="/'.env('INSTALOGIN', 'rasda_tv').'/followers/"]')
                        ->pause($tempsNavigation);
                    }
                    //$browser->assertSee('Abonné(e)');

                    //si le boutton aboonéé est présent on clique
                    if ($browser->element('#selector')){
                        $browser->pause($tempsEntreChaqueLike)
                        ->press('Abonné(e)')
                        ->pause($tempsEntreChaqueLike)
                        ->press('Se désabonner');
                    }


                   
     

                }
        });
    }
}
