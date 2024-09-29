<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
   //

   public static function middleware():array
   {
       return[
               new Middleware('permission:view permissions', only:['index']),
               new Middleware('permission:update permissions', only:['edit']),
               new Middleware('permission:create permissions', only:['create']),
               new Middleware('permission:delete permissions', only:['delete']),
       
       
       
           ];
   }



      //for show permission page
      public function index()
      {
         $permissions = Permission::orderBy('created_at','DESC')->get();
         //  dd($permissions);
         return view('permission.list',[
            'permissions'=>$permissions
         ]);
      }
  
      //this method create permission page
      public function create()
      {
         return view('permission.create');
      }
  
      // this method insert permission in database 
       public function store(Request $request)
      {
         // dd($request);
         $validator =  Validator::make($request->all(),[
         'name' => 'required|unique:permissions|min:3'
  
         ]);
         if($validator->passes())
         {
             Permission::create(['name' => $request->name]);
             return redirect()->route('permission.list')
            ->with('success','permission added successfully');

         }
         else {
               return redirect()->route('permission.create')->withInput()->withErrors($validator);
         }
      } 

    
      //this method show edit permission
      public function edit($id)
      {
         $permission = Permission::findorFail($id);
         return view('permission.edit',[
            'permission' => $permission
         ]);
  
      }
  
      //this method method update permission
        public function update($id,Request $request)
        {
         $permission = Permission::findorFail($id);
         $validator =  Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
     
            ]);
            if($validator->passes())
            {
               //  Permission::create(['name' => $request->name]);
               $permission->name=$request->name;
               $permission->save();
               return redirect()->route('permission.list')
               ->with('success','permission updated successfully');
   
            }
            else {
                  return redirect()->route('permission.edit')->withInput()->withErrors($validator);
            }   
        }
  
  
        //this method delete permission
        public function destroy($id)
        {
          $permission =  Permission::findorFail($id);
          $permission->delete();
   return redirect()->route('permission.list')->with('success','permission deleted successfully');
        
      }

 
    

}