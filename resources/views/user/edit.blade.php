

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit / User
            </h2>
             <a href="{{route("user.index")}}" class="bg-slate-700 text-sm rounded-md px-2 py-2 text-white">
            back    
            </a>
        </div>
    </x-slot>
 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route("user.update" ,['id'=>$user->id]) }}" method="POST">
                        @csrf
                        
                        <div >
                            <label for="" class="font-medium" >Name</label>
                            <div class="mb-3">
                                <input value="{{$user->name}}" placeholder="enter name " type="text" name="name" id="" class="border-gray-300 shadow-sw w-1/2 rounded-lg">
                            </div>
                            @error('name')
                            <p class="text-red-400 font-medium">{{$message}}</p>
                                
                            @enderror
                           
                            <div class="mb-3">
                                <input value="{{$user->email}}" placeholder="enter name " type="text" name="email" id="" class="border-gray-300 shadow-sw w-1/2 rounded-lg">
                            </div>
                            @error('email')
                            <p class="text-red-400 font-medium">{{$message}}</p>
                                
                            @enderror
                           
                            <div class="grid grid-cols-4 mb-3">
                               
                           @if ($role->isNotEmpty())
                               @foreach ($role as $roles)
                               
                               <div class="mb-3">
                       <input type="checkbox"
                       {{($hasroles->contains($roles->id)) ? 'checked' : ''}} type="checkbox"
                      
                        id="role-{{$roles->id}}" 
                        name="role[]" value="{{$roles->name}}" 
                        class="rounded" >
                            
                      
                                        
                        <label for="role-{{$roles->id}}">{{$roles->name}}</label> 
                            
                            </div>
   
                               @endforeach
                               
                               @endif
                                
                              
                            </div>
      
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white hover:bg-slate-700"> update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
