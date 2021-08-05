<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			Schema::disableForeignKeyConstraints();
			User::truncate();
			DB::table('role_user')->truncate();
			Schema::enableForeignKeyConstraints();

			$faker =  Faker::create();

			$adminRole = Role::where('name', 'admin')->first();
			$nurseRole = Role::where('name', 'nurse')->first();
			$doctorRole = Role::where('name', 'doctor')->first();

			$allRoles = [$adminRole, $nurseRole, $doctorRole];

			foreach(range(1,100) as $i) {
				$user = User::Create([
					'name' => $faker->name(),
					'email' => $faker->unique()->safeEmail(),
					'password' => Hash::make('password'),
					'email_verified_at' => now(),
					'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
					'remember_token' => Str::random(10),
					'created_at' => now(),
					'updated_at' => now(),
				]);
				$user->roles()->attach($allRoles[rand(0, 2)]);

			}

			$admin = User::Create([
				'name'  => 'Admin User',
				'email' => 'admin@admin.com',
				'password' => Hash::make('password')
			]);
			$admin->roles()->attach($adminRole);





    }
}
