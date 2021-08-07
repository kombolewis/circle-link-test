<x-app-layout>
  <x-slot name="header">

      <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
        {{ __('Staff Area - Register New Staff') }}
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
                          <x-dropdown-link :href="route('admin.users.index')">
                              {{ __('All Registered Staff') }}
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
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('admin.users.store') }}">
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
        
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />
        
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>
        
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
        
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>

                    <!-- List of roles -->
                    <div class="block mt-4">
                        @foreach ($roles as  $role)
                            <div class="flex items-center">
                                <input id="roles" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="roles[]"
                                    value="{{$role->id}}"
                                >
                                <label for="roles" class="inline-flex items-center">
                                    <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                                </label>
                            </div>
                        @endforeach


                    </div>
        
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Register Staff') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
