<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('admin.users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.users.create')->with(['roles' => Role::all()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, ToastrFactory $flasher)
	{
		$request->validate([
				'name' => 'required|string|max:255',
				'email' => 'required|string|email|max:255|unique:users',
				'password' => ['required', 'confirmed', Rules\Password::defaults()],
				'roles' => 'required|array'
		]);

		$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
		]);
		$user->roles()->sync($request->roles);

		if($user) {
			$flasher->type('success')
			->message('User created successfully')
			->closeButton(true)
			->flash();
		}else{
			$flasher->type('error')
			->message('User creation failed')
			->closeButton(true)
			->flash();
		}

		return redirect()->route('admin.users.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
			//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user) {
		if(Gate::denies('edit-users')) return redirect()->route('admin.users.index');
		return view('admin.users.edit')->with(['user' => $user, 'roles' => Role::all()]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user, ToastrFactory $flasher)
	{
		$user->roles()->sync($request->roles);
		$user->name = $request->name;
		$user->email = $request->email;
		$ok = $user->save();

		if($ok) {
			$flasher->type('success')
			->message('User updated successfully')
			->closeButton(true)
			->flash();
		}else{
			$flasher->type('error')
			->message('User update failed')
			->closeButton(true)
			->flash();
		}

		return redirect()->route('admin.users.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user, ToastrFactory $flasher) {
		if(Gate::denies('delete-users')) return redirect()->route('admin.users.index');
		$user->roles()->detach();
		$ok = $user->delete();
		if($ok) {
			$flasher->type('success')
			->message('User deleted successfully')
			->closeButton(true)
			->flash();
		}else{
			$flasher->type('error')
			->message('User deletion failed')
			->closeButton(true)
			->flash();
		}
		return redirect()->route('admin.users.index');
	}
}
