<x-app-layout>
  <x-slot name="header">

    <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
      {{ __('Staff Area - New Blood Pressure Observation') }}
      <span >
       Extra Staff Navigation
      </span>
    </div>

  </x-slot>





  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="flex items-center">
                <h2 class="text-3xl font-bold mb-10 content-center">Record Patient Blood Pressure {{ - $patient->name ?? ''}}</h2>
              </div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('staff.bpo.store') }}">
                    @csrf
                  @if ($patient)
                    <!-- Name -->

                    <div>
                      <x-label for="name" :value="__('Name')" />
                      <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$patient->name}}" readonly autofocus />
                    </div>
                    <div>
                      <x-input type="hidden" name="id" value="{{$patient->id}}" />
                    </div>
                  @else
                    <livewire:patient-model-select
                      name="patient_model_id"  
                      placeholder="Choose a Patient"
                      :searchable="true"
                    />
                  @endif




                    <!-- Systole Address -->
                    <div class="mt-4">
                        <x-label for="systole" :value="__('Systole')" />
                        <x-input id="systole" class="block mt-1 w-full" type="text" name="systole" :value="old('systole')" required />
                    </div>

                    <!-- Systole Address -->
                    <div class="mt-4">
                      <x-label for="diastole" :value="__('Diastole')" />
                      <x-input id="diastole" class="block mt-1 w-full" type="text" name="diastole" :value="old('diastole')" required />
                    </div>



                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
