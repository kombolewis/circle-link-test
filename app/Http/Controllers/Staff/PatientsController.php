<?php

namespace App\Http\Controllers\Staff;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Toastr\Prime\ToastrFactory;

class PatientsController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('staff.patients.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('staff.patients.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, ToastrFactory $flasher) {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:patient',
    ]);

    $user = Patient::create([
        'name' => $request->name,
        'email' => $request->email,
    ]);
    if($user) {
      $flasher->type('success')
      ->message('Patient created successfully')
      ->closeButton(true)
      ->flash();
    }else{
      $flasher->type('error')
      ->message('Patient creation failed')
      ->closeButton(true)
      ->flash();
    }

    return redirect()->route('staff.patients.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function show(Patient $patient)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function edit(Patient $patient) {
    return view('staff.patients.edit')->with(['patient' => $patient]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Patient $patient, ToastrFactory $flasher) {		
    
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
    ]);
    
    $patient->name = $request->name;
    $patient->email = $request->email;
    $ok = $patient->save();

    if($ok) {
      $flasher->type('success')
      ->message('Patient updated successfully')
      ->closeButton(true)
      ->flash();
    }else{
      $flasher->type('error')
      ->message('Patient update failed')
      ->closeButton(true)
      ->flash();
    }
    return redirect()->route('staff.patients.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Patient  $patient
   * @return \Illuminate\Http\Response
   */
  public function destroy(Patient $patient)
  {
      //
  }
}
