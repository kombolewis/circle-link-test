<x-app-layout>
  <x-slot name="header">

    <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
      {{ __('Staff Area - Create New BPO') }}
      <span >
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>{{  __('Options') }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>


                <x-slot name="content">
                    <!-- Links To Other Pages -->
                    <div>
                        <x-dropdown-link :href="route('staff.bpo.index')">
                            {{ __('BP Observations ') }}
                        </x-dropdown-link>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
      </span>
    </div>

  </x-slot>


  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="flex items-center">
                <h2 class="text-3xl font-bold mb-10 content-center">Record Patient Blood Pressure</h2>
              </div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('staff.bpo.store') }}">
                  @csrf
                  
                  <!-- Name -->
                  <livewire:patient-model-select
                    name="id"  
                    placeholder="Choose a Patient - type to show options"
                    :searchable="true"
                  />

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
                      <x-button class="ml-4" name="submit">
                          {{ __('Submit') }}
                      </x-button>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>

</x-app-layout>
