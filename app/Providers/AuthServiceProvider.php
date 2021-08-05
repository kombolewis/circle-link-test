<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
			// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		Gate::define('manage-users', fn($user) => $user->hasAnyRoles(['admin','doctor']));
		Gate::define('export-bpos', fn($user) => $user->hasAnyRoles(['admin','doctor']));
		Gate::define('edit-users', fn($user) => $user->hasRole('admin'));
		Gate::define('export-staff', fn($user) => $user->hasRole('admin'));
		Gate::define('delete-users', fn($user) => $user->hasRole('admin'));


	}
}
