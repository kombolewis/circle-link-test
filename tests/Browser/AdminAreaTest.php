<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use App\Models\Patient;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminAreaTest extends DuskTestCase
{
	use DatabaseMigrations;
	use WithFaker;
	

	/**
	 * @test
	 */
	public function can_create_new_staff_member()
	{
		$this->browse(function (Browser $browser) {

			$role = Role::Create(['name' => 'admin']);
			$user = User::factory()->create();
			$user->roles()->attach($role);
			$password =  $this->faker->password;
			$browser->loginAs(User::find($user->id));

			$browser->visit(route('admin.users.create'))
							->assertSee('Staff Area - Register New Staff')
							->type('name', $this->faker->name)
							->type('email',  $this->faker->email)
							->type('password', $password)
							->type('password_confirmation', $password)
							->check('roles[]')
							->press('register')
							->assertPathIs('/admin/users');
		});
	}

	/**
	 * @test
	 */
	public function can_edit_staff_details()
	{
		$this->browse(function (Browser $browser) {
			//create Roles
			$nurseRole = Role::Create(['name' => 'nurse']);
			$adminRole = Role::Create(['name' => 'admin']);

			//create Users
			$user = User::factory()->create();
			$otherUser = User::factory()->create();

			//attach roles
			$user->roles()->attach($adminRole);
			$otherUser->roles()->attach($nurseRole);


			$browser->loginAs(User::find($user->id));


			$browser->visit(route('admin.users.edit', [$otherUser->id]))
							->assertSee('Admin Area - Edit Staff Member')
							->type('name', $this->faker->name)
							->type('email',  $this->faker->email)
							->check('roles[]')
							->press('update')
							->assertPathIs('/admin/users');
		});
	}

	/**
	 * @test
	 */
	public function can_remove_staff() {
		$this->browse(function (Browser $browser) {
			//create Roles
			$nurseRole = Role::Create(['name' => 'nurse']);
			$adminRole = Role::Create(['name' => 'admin']);

			//create Users
			$user = User::factory()->create();
			$otherUser = User::factory()->create();

			//attach roles
			$user->roles()->attach($adminRole);
			$otherUser->roles()->attach($nurseRole);
			
			$browser->ensurejQueryIsAvailable();
			$browser->loginAs(User::find($user->id));

			$browser->visit(route('admin.users.index'));
			$browser->script('$(".delete-user").last().click();');
			$browser->assertDialogOpened('Are you sure you want to remove this record?');
			$browser->acceptDialog();
		});
	}

}
