<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PatientsRecordsDatatable extends LivewireDatatable
{


    public $model = Patient::class;


    public function columns() {
		return [
			NumberColumn::name('id')->sortBy('id'),
			Column::name('name'),
			Column::name('email'),
      DateColumn::name('created_at')->format('Y-m-d H:i:s'),
			Column::callback(['id', 'name'], fn ($id, $name) => $this->actions($id, $name))
      
		];
  }
  

	private function actions(int $id, string $name) {
		return view('livewire.patients-records-datatable', ['id' => $id, 'name' => $name]);
  }
  
  
}
