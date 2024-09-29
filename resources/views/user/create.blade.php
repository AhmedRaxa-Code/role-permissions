

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    create / User
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
                    <form   action="{{ route('user.store') }}"  method="POST">
                        @csrf
                        
                        <div >
                            <label for="" class="font-medium" >Name</label>
                            <div class="mb-3">
                                <input value="{{old('name')}}" placeholder="enter name " type="text" name="name" id="" class="border-gray-300 shadow-sw w-1/2 rounded-lg">
                            </div>
                            @error('name')
                            <p class="text-red-400 font-medium">{{$message}}</p>
                                
                            @enderror
                           
                            
                            <label for="" class="font-medium" >email</label>
                            <div class="mb-3">
                                <input value="{{ old('email')}}" placeholder="enter email " type="text" name="email" id="" class="border-gray-300 shadow-sw w-1/2 rounded-lg">
                            </div>
                            @error('email')
                            <p class="text-red-400 font-medium">{{$message}}</p>
                                
                            @enderror

                            <label for="" class="font-medium" >Password</label>
                            <div class="mb-3">
                                <input value="" placeholder="enter password " type="password" name="password" id="" class="border-gray-300 shadow-sw w-1/2 rounded-lg">
                            </div>
                            @error('password')
                            <p class="text-red-400 font-medium">{{$message}}</p>
                                
                            @enderror
                           

                            <label for="" class="font-medium" > Confirm Password</label>
                            <div class="mb-3">
                                <input value="" placeholder="enter confirm password " type="password" name=" confirm_password" id="" class="border-gray-300 shadow-sw w-1/2 rounded-lg">
                            </div>
                            @error('confirm password')
                            <p class="text-red-400 font-medium">{{$message}}</p>
                                
                            @enderror
                            


                            <div class="grid grid-cols-4 mb-3">
                               
                           @if ($role->isNotEmpty())
                               @foreach ($role as $roles)
                               
                               <div class="mb-3">
                       <input type="checkbox"
                        type="checkbox"  id="role-{{$roles->id}}" 
                        name="role[]" value="{{$roles->name}}" 
                        class="rounded" >
                            <label for="role-{{$roles->id}}">{{$roles->name}}</label> 
                            
                            </div>
   
                               @endforeach
                               
                               @endif
                                
                              
                            </div>
      
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white hover:bg-slate-700"> create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
