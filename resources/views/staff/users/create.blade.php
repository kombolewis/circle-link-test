<x-app-layout>
    <x-slot name="header">

        <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
          {{ __('Staff Area -Create New Patient') }}
          <span >
           Extra Staff Navigation
          </span>
        </div>
    
    </x-slot>

  <!-- Validation Errors -->
  <x-auth-validation-errors class="mb-4" :errors="$errors" />

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <form method="POST" action="{{ route('staff.users.store') }}">
                  @csrf

                  <!-- Name -->
                  <div>
                      <x-label for="name" :value="__('Name')" />
                      <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                  </div>

                  <!-- Email Address -->
                  <div class="mt-4">
                      <x-label for="email" :value="__('Email')" />
                      <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                  </div>

                  <div class="flex items-center justify-end mt-4">
                      <x-button class="ml-4">
                          {{ __('Register') }}
                      </x-button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
