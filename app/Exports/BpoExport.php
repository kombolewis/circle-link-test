<?php

namespace App\Exports;

use App\Models\BPO;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BpoExport implements FromCollection, WithHeadings
{

  public $collection;
	private array $selectedIds;

	public function __construct(array $selectedIds = []) {
		$this->selectedIds = $selectedIds;
		if(!empty($this->selectedIds)) {
			$this->collection = BPO::select('id','systole','diastole')->find($this->selectedIds);
		}else {
			$this->collection = BPO::select('id','systole','diastole')->get();
		}
		$this->modifyColumns();
	}

	/**
	* @return \Illuminate\Support\Collection
	*/
	public function collection() {
		return $this->collection;
	}

	public function map($bpo) :array {
		return [
			$bpo->id,
			$bpo->systole,
			$bpo->diastole,
			$bpo->name,

		];
	}

	private function modifyColumns() {
		$this->collection = $this->collection->map(function($bpo, $key) {
			$bpo->name = BPO::find($bpo->id)->patients->name;
			return $bpo;
		});
	}


	public function headings(): array {
		return [
			'ID',
			'Systole',
			'Diastole',
			'Name',
		];
	}


}
