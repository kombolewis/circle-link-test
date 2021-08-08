<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Exports\DatatableExport;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LivewireDatatables extends LivewireDatatable
{


	public $model = User::class;
	public $exportable = false;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		if(Gate::allows('export-staff')) {
			$this->exportable = true;
		}
	}

	public function columns() {
		return [
			NumberColumn::name('id')->sortBy('id'),
			Column::name('name'),
			Column::name('email'),
			Column::callback(['id'], fn($id) => $this->roles($id))->label('Roles'),
			DateColumn::name('created_at')->format('Y-m-d H:i:s'),
			Column::callback(['id', 'name'], fn ($id, $name) => $this->actions($id, $name))
		];
	}

	private function roles(int $id) :string {
		$roles = User::find($id)->roles()->get()->pluck('name')->toArray();
		return implode(', ', $roles);
	}

	private function actions(int $id, string $name) {
		return view('livewire.livewire-datatables', ['id' => $id, 'name' => $name]);
	}

	public function destroy(User $user) {
		if(Gate::denies('delete-users')) return redirect()->route('admin.users.index');
		$user->roles()->detach();
		$user->delete();
	}
	public function export()
	{
		return Excel::download(new DatatableExport($this->getQuery(true)->get()), 'Staff.csv');
	}

}
