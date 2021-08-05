<x-app-layout>
  <x-slot name="header">

    <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
      {{ __('Staff Area -All Blood Pressure Observations') }}
      <span >
       Extra Staff Navigation
      </span>
    </div>

  </x-slot>



  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                {{-- <div class="flex items-center justify-end ">
                    <button wire:click="test()" class="bg-transparent hover:bg-green-300 text-green-500 font-thin  uppercase text-xs  py-2 px-4 border border-green-500 hover:border-transparent rounded-md">
                        <div class="flex items-center ">
                          {{ __('EXPORT') }} 
                          <img src="https://img.icons8.com/windows/20/26e07f/file-excel.png" class="pl-1"/>
                        </div>
                    </button>
                </div> --}}
                <livewire:patients-bpos-datatable searchable="name, email" />
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
