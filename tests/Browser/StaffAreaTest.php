<?php

namespace Tests\Browser;

use App\Models\BPO;
use App\Models\Patient;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StaffAreaTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function can_register_new_patient()
    {
        // $this->actingAs($user);
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();

            $browser->loginAs(User::find($user->id));
            $faker = Faker::create();

            $browser->visit(route('staff.patients.create'))
                    ->assertSee('Staff Area - Register New Patient')
                    ->type('name', $faker->name())
                    ->type('email', $faker->safeEmail())
                    ->press('Register')
                    ->assertPathIs('/staff/patients');
        });
    }

    /**
     * @test
     */
    public function can_edit_patient()
    {
        // $this->actingAs($user);
        $this->browse(function (Browser $browser) {
            $patient = Patient::factory()->create();
            $user = User::factory()->create();

            $browser->loginAs(User::find($user->id));
            $faker = Faker::create();

            $browser->visit(route('staff.patients.edit', [$patient->id]))
                    ->assertSee('Edit Patient Details')
                    ->type('name', $faker->name())
                    ->type('email', $faker->safeEmail())
                    ->press('update')
                    ->assertPathIs('/staff/patients');
        });
    }

    /**
     * @test
     */
    public function can_create_new_bpo_on_patient()
    {
        // $this->actingAs($user);
        $this->browse(function (Browser $browser) {
            $patient = Patient::factory()->create();
            $user = User::factory()->create();

            $browser->loginAs(User::find($user->id));
            $faker = Faker::create();

            $browser->visit(route('staff.bpo.create', ['id' => $patient->id]))
                    ->assertSee('Record Patient Blood Pressure')
                    ->type('systole', rand(80,120))
                    ->type('diastole', rand(40,90))
                    ->press('submit')
                    ->assertPathIs('/staff/bpo');
        });
    }
}
