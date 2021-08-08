<?php

namespace App\Http\Livewire;

use App\Models\BPO;
use App\Models\Patient;
use Illuminate\Support\Facades\Gate;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PatientsBposDatatable extends LivewireDatatable
{
  public $model = BPO::class;

	public $exportable = false;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		if(Gate::allows('export-bpos')) {
			$this->exportable = true;
		}
	}
  public function columns() {
		return [
			Column::checkbox(),
			NumberColumn::name('id')->sortBy('id'),
			Column::callback(['patient_id'], fn ($id) => $this->patient($id))->label('NAME'),
			Column::name('systole'),
			Column::name('diastole'),
			DateColumn::name('created_at')->format('Y-m-d H:i:s'),
			Column::callback(['id', 'patient_id'], fn ($id,$patient_id) => $this->actions($id,$patient_id))
		];
  }
  

	private function actions(int $id, int $patient_id) {
		return view('livewire.patients-bpos-datatable', ['id' => $id, 'patient_id' => $patient_id]);
  }
  

	private function patient(int $id) {
		return Patient::find($id)->name;
	}
	public function destroy(BPO $bpo) {
		$bpo->delete();
	}
}
