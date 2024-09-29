<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('create/permission') }}
            </h2>
            {{-- <a href="{{route("permissison.list")}}" class="bg-slate-700 text-sm rounded-md px-2 py-2 text-white">
               back
            </a> --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permission.update',['id'=>$permission->id]) }}" method="POST">
                        @csrf
                        
                        <div >
                            <label for="" class="font-medium" >Name</label>
                            <div class="mb-3">
                                <input value="{{ $permission->name}}" placeholder="enter name " type="text" name="name" id="" class="border-gray-300 shadow-sw w-1/2 rounded-lg">
                          
                            </div>
                            @error('name')
                            <p class="text-red-400 font-medium">{{$message}}</p>
                                
                            @enderror
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white"> update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
