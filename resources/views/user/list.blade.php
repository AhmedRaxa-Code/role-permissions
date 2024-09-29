<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users-list') }}
        </h2>
        <a href="{{route("create.user")}}"class="bg-slate-700 text-sm rounded-md px-2 py-2 text-white">
            create user   
            </a>

           
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         
            @if (Session::has('success'))
<div class="bg-green-200 border-green-600 p-4 mb-3 sm:rounded-lg shadow-sm ">
{{Session::get('success')}}
  

    </div>
@endif

@if (Session::has('error'))
<div class="bg-green-200 border-green-600 p-4 mb-3 sm:rounded-lg shadow-sm ">
{{Session::get('error')}}
</div>
@endif

          

          
        </div>
        <div class="py-12">
             <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Roles</th>

                    <th class="px-6 py-3 text-left">created</th>
                          <th class="px-6 py-3 text-center">action</th>
                    </tr>
                   </thead> 
                   <tbody class="bg-white">
               
    
                    @foreach ($users  as $users )
                      
                       <tr class="border-b">
                        <td class="px-6 py-3 text-left" width="60">{{ $users->id }}</td>
                       <td class="px-6 py-3 text-left" >{{ $users->name }}</td>
                       <td class="px-6 py-3 text-left" >{{ $users->email }}</td>
                       <td class="px-6 py-3 text-left" >{{ $users->roles->pluck('name')->implode(', ') }}</td>
                      
         <td class="px-6 py-3 text-left"  >{{ \Carbon\Carbon::parse($users->created_at)->format('d M,Y') }}</td>
             
         @can('update users')
             
         
                     <td class="px-6 py-3 text-center" >
                        <a href="{{route('user.edit',['id'=>$users->id])}}" class="bg-slate-700 text-sm rounded-md px-4 py-2 mr-2 text-white hover:bg-slate-600">
                            edit  </a>
                         
                            @endcan
                            
                            @can('delete users')
                            <a href="{{ route('user.delete',['id'=>$users->id]) }}" class="bg-red-600 text-sm rounded-md px-4 py-2 text-white hover:bg-red-500">
                                delete  </a>
                            @endcan
                           

                       </td> 
                   </tr>       
                       @endforeach
                 



            </tbody>       
                </table>
             <div class="my-3">
                {{-- {{ $roles->links() }} --}}
            </div> 
            </div>
        </div>
    </div>
    <x-slot name="script">
      <script type="text/javascript">
      
    //   function roledestroy(id)
    //   {
    //       if(confirm('are you want to delete')){
    //    $.ajax({
    //            url : {{route("role.delete")}} ,
    //           type : 'delete' ,
    //            data : {id:id},
    //             dataType :  json,
    //             header:{
    //                 'x-csrf-token' : {{csrf_token()}}
    //              },
    //            success:function(response)
    //             {
    //                window.location.href = {{route("role.list")}};
    //          }
    //         });
    
    // }}
    
    // 
     </script>
     
    </x-slot>
</x-app-layout>
