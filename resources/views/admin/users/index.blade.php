<x-app-layout>
  <x-slot name="header">

    <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
      {{ __('Admin Area - All Staff Members') }}
      <span >
       Extra Admin Navigation
      </span>
    </div>

  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <livewire:livewire-datatables searchable="name, email, "/>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
