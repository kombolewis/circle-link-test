<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use App\Models\Patient;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class BpoTest extends DuskTestCase
{ 
    use DatabaseMigrations;

	/**
	 * @test
	 */
	public function can_create_new_bpo_on_blank()
	{
		$this->browse(function (Browser $browser) {
				$patient = Patient::factory()->create();

				$user = User::factory()->create();

				$browser->loginAs(User::find($user->id));

				$browser->visit(route('staff.bpo.create'))
								->assertSee('Record Patient Blood Pressure')
								->type('id', $patient->id)
								->type('systole', rand(80,120))
								->type('diastole', rand(40,90))
								->press('submit')
								->assertPathIs('/staff/bpo');
		});
	}

	/**
	 * @test
	 */
	public function can_edit_bpo_details()
	{
		$this->browse(function (Browser $browser) {
			$user = User::factory()->create();

			$patient = Patient::factory()->create();
			$bpo = $patient->bpos()->create([
				'systole' => rand(80,120),
				'diastole' => rand(60,90),
			]);

			$browser->loginAs(User::find($user->id));

			$browser->visit(route('staff.bpo.edit', [$bpo->id]))
							->assertSee('Edit BPO Details')
							->type('systole', rand(80,120))
							->type('diastole', rand(40,90))
							->press('update')
							->assertPathIs('/staff/bpo');
		});
	}

	/**
	 * @test
	 */
	public function can_remove_bpo() {
		$this->browse(function (Browser $browser) {
			$user = User::factory()->create();
			$patient = Patient::factory()->create();
			$patient->bpos()->create([
				'systole' => rand(80,120),
				'diastole' => rand(60,90),
			]);
			$browser->ensurejQueryIsAvailable();
			$browser->loginAs(User::find($user->id));

			$browser->visit(route('staff.bpo.index'));
			$browser->script('$("#bpo-delete").click();');
			$browser->assertDialogOpened('Are you sure you want to remove this record?');
			$browser->acceptDialog();
		});
	}


}




