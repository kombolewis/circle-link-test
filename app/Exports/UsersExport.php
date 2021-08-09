<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection, WithHeadings
{
	public $collection;
	private array $selectedIds;

	public function __construct(array $selectedIds = []) {
		$this->selectedIds = $selectedIds;
		if(!empty($this->selectedIds)) {
			$this->collection = User::select('id','name','email')->find($this->selectedIds);
		}else {
			$this->collection = User::select('id','name','email')->get();
		}
		$this->modifyColumns();
	}
	/**
	* @return \Illuminate\Support\Collection
	*/
	public function collection() {
		return $this->collection;
	}

	private function modifyColumns(){
		$this->collection = $this->collection->map(function($user, $key) {
			$roles = $user->roles()->get()->pluck('name')->toArray();
			$roles = implode(', ', $roles);
			$user->gen_roles = $roles;
			return $user;
		});
	}

	public function map($user) :array {
		return [
			$user->id,
			$user->name,
			$user->email,
			$user->gen_roles
		];
	}

	public function headings(): array {
		return [
			'ID',
			'Name',
			'Email',
			'Roles'
		];
	}
}
