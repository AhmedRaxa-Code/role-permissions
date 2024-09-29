<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller  implements HasMiddleware
{



   public static function middleware():array
   {
       return[
               new Middleware('permission:view roles', only:['index']),
               new Middleware('permission:update roles', only:['edit']),
               new Middleware('permission:create roles', only:['create']),
               new Middleware('permission:delete roles', only:['delete']),
       
       
       
           ];
   }





    //
   public   function index()
{
    $roles = Role::orderBy('created_at','ASC')->get();
    return view('role.list',[
        'roles'=>$roles
     ]);
} 


public function create()
{
    $permissions  =  Permission::orderBy('name','ASC')->get();
    
    return view('role.create',[
        'permissions'=> $permissions
     ]);
   

}

public function store(Request $request)
{ 
    $validator =  Validator::make($request->all(),[
        'name' => 'required|unique:roles|min:3'
 
        ]);
        if($validator->passes())
        {
            
         $role =    Role::create(['name' => $request->name]);
            
            if(!empty($request->permission))
            {
                foreach($request->permission as $name )
                {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('role.list')
           ->with('success','roles added successfully');
    
        }
        else{
            return redirect()->route('role.create')->withInput()->withErrors($validator);

        }
}

public function edit($id)
{
    $role = Role::findorFail($id);
    $haspermission = $role->permissions->pluck('name');
    $permissions = Permission::orderBy('created_at','DESC')->get();
      
    return view('role.edit',[
        'permissions' => $permissions,
        'haspermission' => $haspermission,
        'role' =>$role
    ]);
}


public function update($id,Request $request)
{
    $role = Role::findorFail($id);
    $validator =  Validator::make($request->all(),[
        'name' => 'required|min:3|unique:roles,name,'.$id.',id'

        ]);
        if($validator->passes())
        {
            
        //  $role =    Role::create(['name' => $request->name]);
               $role->name = $request->name;
               $role->save();
            if(!empty($request->permission))
            {
                  $role->syncPermissions($request->permission);
            }
            else {
                $role->syncPermissions([]);
            }
            return redirect()->route('role.list')
           ->with('success','roles added successfully');
    
        }
        else{
            return redirect()->route('role.create',$id)->withInput()->withErrors($validator);

        }

}


    public function destroy($id)
    {
            $role =Role::findorFail($id);
            $role->delete();
   return redirect()->route('role.list')->with('success','user deleted successfully');


    }

}
