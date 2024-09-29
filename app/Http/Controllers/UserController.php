<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    //
    
   public static function middleware():array
   {
       return[
               new Middleware('permission:view users', only:['index']),
               new Middleware('permission:update users', only:['edit']),
              //  new Middleware('permission:create permissions', only:['create']),
              //  new Middleware('permission:delete permissions', only:['delete']),
       
       
       
           ];
   }



        public function index()

        {
               $users = User::get();
               return view('user.list',[
                'users'=>$users
               ]) ;
            
        }

          public function create()
          {
               $role =   Role::get();

             return view('user.create',[
              'role' => $role 
             ]);



          }
   
    public function store(Request $request)
    {
            

      $validator=Validator::make($request->all(),[
        'name'=>'required|min:3',
        'email'=>'required|unique:users,email,',
          'password'=>'required|min:5|same:confirm_password',
          'confirm_password'=>'required',

      ]);
    
      if($validator->fails())
  {
      return redirect()->route('create.user')->withInput()->withErrors($validator);
  }

  $user = new  User();
  $user->name = $request->name;
  $user->email =$request->email;
  $user->password= Hash::make($request->password);
  $user->save();

  
  $user->syncRoles($request->role);

  return redirect()->route('user.index')->with('success',"user added successfully");
}

     
    

  
  
  
  
  
  
  
    public function edit($id)
  {
    $user= User::findorFail($id);
     $role =   Role::get();
     $hasRoles = $user->roles->pluck('id');
//  dd($hasRoles);
    return view('user.edit',[
   'user'=>$user,
   'role'=>$role,
   'hasroles'=>$hasRoles

    ]);

    

  }

  public function update(Request $request,$id)
  {
    
    $user=User::findorFail($id);

            $validator=Validator::make($request->all(),[
              'name'=>'required|min:3',
              'email'=>'required|email|unique:users,email,'.$id.',id'
            ]);
            if($validator->fails())
        {
            return redirect()->route('user.edit',$id)->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        $user->email =$request->email;
        $user->save();

        
        $user->syncRoles($request->role);

        return redirect()->route('user.index')->with('success',"user updated successfully");
  }
 public function delete($id)
 {

    $user = User::findorFail($id);
    $user->delete();
   return redirect()->route('user.index')->with('success','user deleted successfully');

 }


}
