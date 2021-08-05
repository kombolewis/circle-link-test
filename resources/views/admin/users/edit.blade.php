<x-app-layout>
  <x-slot name="header">

    <div class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
      {{ __('Admin Area -- Edit Staff Members') }}
      <span >
       Extra Admin Navigation
      </span>
    </div>

  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">

                <h2 class="text-3xl font-bold mb-10 text-purple-700 content-center">Edit Roles - {{$user->name}}</h2>
                
                <form action="{{ route('admin.users.update', $user)}}" class="space-y-5" method="POST">
                  @method('PATCH')
                  @csrf
                  <div>
                    <label for="name" class="block mb-1 font-bold text-gray-500">Name</label>
                    <input type="text" name="name"  class="w-full border-gray-400 p-3 rounded outline-none focus:border-purple-500" value="{{$user->name}}">
                  </div>

                  <div>
                    <label for="email" class="block mb-1 font-bold text-gray-500"></label>
                    <input type="email" name="email"  class="w-full border-gray-400 p-3 rounded outline-none focus:border-purple-500" value="{{$user->email}}">
                  </div>
                  @foreach ($roles as  $role)
                    <div class="flex items-center">
                      <input type="checkbox" name="roles[]" value="{{$role->id}}"
                        @if ($user->roles->pluck('id')->contains($role->id)) checked @endif
                      >
                      <label for="agree" class="ml-2 text-gray-700 text-sm"> {{$role->name}} </label>
                    </div>
                  @endforeach
                  <button class="block bg-purple-400 hover:bg-purple-300 p-4 rounded text-purple-900 transition duration-300">Update</button>
                </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

