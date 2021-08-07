<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Illuminate\Support\Collection;
use Asantibanez\LivewireSelect\LivewireSelect;

class PatientModelSelect extends LivewireSelect
{

	public function __construct() {
		$this->records = Patient::selectRaw('id as value, name as description, email')->get();
	}
    
	public function options($searchTerm = null) : Collection {
		if($searchTerm) {
			return $this->records->filter(fn($value, $key) => strpos($value->description, $searchTerm) !== false);
		}
		return $this->records;
		
	}

	public function selectedOption($value) {
		return (collect($this->records->where('value', $value)->toArray())->first());
	}

	

}