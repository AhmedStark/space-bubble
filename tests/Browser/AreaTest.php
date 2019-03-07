<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AreaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateArea()
    {
        $name = 'area-46';
        $this->browse(function (Browser $browser)use($name){

            
            $browser->visit('/admin/dashboard')
            ->type( 'name',$name)
            ->press('Add');
            
        });
        $this->assertDatabaseHas('areas',['name'=>$name]);
        
        

    }

    public function testCreateAreaNullName(){
        $this->browse(function (Browser $browser){

            
            $browser->visit('/admin/dashboard')
            ->assertSee('Fill the name');
            
        });

    }
}
