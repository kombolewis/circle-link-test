<?php

namespace App\Http\Controllers\Staff;

use App\Models\BPO;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BpObservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('staff.bpo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
			if($request->id) {
				return view('staff.bpo.create-from-patient')->with(['patient' => Patient::find($request->query('id'))]);
			}
			return view('staff.bpo.create-blank');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      // dd($request);
			$request->validate([
				'systole' => 'required|integer|max:200',
				'diastole' => 'required|integer|max:200',
				'id' => 'required|int'
			]);
		
			$patient = Patient::find($request->id);

			$patient->bpos()->create([
				'systole' => $request->systole,
				'diastole' => $request->diastole,
			]);
  
			return redirect()->route('staff.bpo.index')->with('success', 'Record created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BPO  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(BPO $bpo) {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BPO  $bpo
     * @return \Illuminate\Http\Response
     */
    public function edit(BPO $bpo) {
			return view('staff.bpo.edit')->with(['bpo' => $bpo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BPO  $bpo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BPO $bpo) {
			$request->validate([
				'systole' => 'required|integer|max:200',
				'diastole' => 'required|integer|max:200',
			]);
		
      $bpo->systole = $request->systole;
      $bpo->diastole = $request->diastole;
      $bpo->save();
  
			return redirect()->route('staff.bpo.index')->with('success', 'Record created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BPO  $bpo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BPO $bpo)
    {
        //
    }
}
