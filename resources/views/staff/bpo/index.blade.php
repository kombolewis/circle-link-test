<x-app-layout>
  <x-slot name="header">

    <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
      {{ __('Staff Area - All BP Observations') }}
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
                        <x-dropdown-link :href="route('staff.bpo.create')">
                            {{ __('Create New BPO ') }}
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
                {{-- <div class="flex items-center justify-end ">
                    <button wire:click="test()" class="bg-transparent hover:bg-green-300 text-green-500 font-thin  uppercase text-xs  py-2 px-4 border border-green-500 hover:border-transparent rounded-md">
                        <div class="flex items-center ">
                          {{ __('EXPORT') }} 
                          <img src="https://img.icons8.com/windows/20/26e07f/file-excel.png" class="pl-1"/>
                        </div>
                    </button>
                </div> --}}
                <livewire:patients-bpos-datatable  />
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
