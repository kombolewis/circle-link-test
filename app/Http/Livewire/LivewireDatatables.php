<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Flasher\Toastr\Prime\ToastrFactory;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LivewireDatatables extends LivewireDatatable
{


	public $model = User::class;
	public $exportable = false;
	public $selected = [];

	/**
	 * Class constructor.
	 */
	public function __construct() {
		if(Gate::allows('export-staff')) {
			$this->exportable = true;
		}
	}

	public function builder() {
		return User::query()
							->select('users.id','users.name','email','users.created_at')
							->selectRaw("concat_ws(',', roles.name)")
							->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
							->leftJoin('roles', 'role_user.role_id', '=', 'roles.id');
	}

	public function columns() {
		return [
			Column::checkbox(),
			NumberColumn::name('users.id')->sortBy('users.id'),
			Column::name('users.name')->searchable()->label('Name'),
			Column::name('email')->searchable(),
			Column::name('roles.name')->label('Roles'),
			DateColumn::name('created_at')->format('Y-m-d H:i:s'),
			Column::callback(['users.id', 'name'], fn ($id, $name) => $this->actions($id, $name))
		];
	}


	private function actions(int $id, string $name) {
		return view('livewire.livewire-datatables', ['user' => User::find($id), 'name' => $name]);
	}

	public function export() {
		return Excel::download(new UsersExport($this->selected), 'Staff.csv');
	}

}
