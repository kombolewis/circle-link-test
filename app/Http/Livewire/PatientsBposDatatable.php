<?php

namespace App\Http\Livewire;

use App\Models\BPO;
use App\Models\Patient;
use App\Exports\BpoExport;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PatientsBposDatatable extends LivewireDatatable
{

	public $exportable = false;

	public $selected = [];


	/**
	 * Class constructor.
	 */
	public function __construct() {

		if(Gate::allows('export-bpos')) {
			$this->exportable = true;
		}
	}

	public function builder()
	{
		return BPO::query()
									->select('bpo.id','systole', 'diastole', 'patient_id','patients.name as name','bpo.created_at')
									->join('patients', 'patients.id', '=', 'bpo.patient_id');
	}
  public function columns() {
		return [
			Column::checkbox(),
			NumberColumn::name('id')->sortBy('id'),
			Column::name('patients.name')->searchable(),
			Column::name('systole'),
			Column::name('diastole'),
			DateColumn::name('created_at')->format('Y-m-d H:i:s'),
			Column::callback(['id', 'patient_id'], fn ($id,$patient_id) => $this->actions($id,$patient_id))
		];
  }

	private function actions(int $id, int $patient_id) {
		return view('livewire.patients-bpos-datatable', ['bpo' => BPO::find($id), 'patient_id' => $patient_id]);
  }
  

	public function export() {
		return Excel::download(new BpoExport($this->selected), 'BPO.csv');
	}



}
