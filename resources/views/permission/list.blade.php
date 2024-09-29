<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('permission-list') }}
        </h2>
        @can('create permissions')
        <a href="{{route("permission.create")}}" class="bg-slate-700 text-sm rounded-md px-2 py-2 text-white">
            creat permission
        </a>    
        @endcan
        
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
                        <th class="px-6 py-3 text-left">permission</th>
                         <th class="px-6 py-3 text-left">created</th>
                          <th class="px-6 py-3 text-center">action</th>
                    </tr>
                   </thead> 
                   <tbody class="bg-white">
                           
                   {{-- @if ($permissions->isNotEmpty()) --}}
                       @foreach ($permissions  as $permission )
                       @php
                         
                       @endphp
                       <tr class="border-b">
                        <td class="px-6 py-3 text-left" width="60">{{ $permission->id }}</td>
                       <td class="px-6 py-3 text-left" >{{ $permission->name }}</td>
                       <td class="px-6 py-3 text-left"  >{{ \Carbon\Carbon::parse($permission->id)->format('d M,Y') }}</td>
                      
                       <td class="px-6 py-3 text-center" >
                      @can('update permissions')
                      <a href="{{route('permission.edit', ['id' => $permission->id])}} " class="bg-slate-700 text-sm rounded-md px-4 py-2 mr-2 text-white hover:bg-slate-600">
                        edit  </a>   
                      @endcan
                        
                      @can('delete permissions')
                        <a href="{{ route('permission.delete',['id'=>$permission->id]) }}"
                        class="bg-red-600 text-sm rounded-md px-4 py-2 text-white hover:bg-red-500">
                            delete</a> 
  
                      @endcan
                        
                       </td>
                   </tr>       
                       @endforeach
                 
                    
            </tbody>   
                </table>
             <div>
                {{-- {{ $permission->links() }} --}}
            </div> 
            </div>
        </div>
    </div>
    <x-slot name="script ">
  <script type="text/javascript">
        function hello()
       {
        console.log("hi");
        
       }
           
  </script>
    </x-slot>  
</x-app-layout>
