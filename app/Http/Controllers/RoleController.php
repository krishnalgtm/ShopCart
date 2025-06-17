<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\User;
use App\Models\Setting;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission; // यहाँ गलत namespace था
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view roles')->only('index');
        $this->middleware('permission:edit roles')->only('edit');
        $this->middleware('permission:create roles')->only('create');
        $this->middleware('permission:delete roles')->only('destroy');
    }
    public function index()
    {
        // Index logic (अगर कुछ दिखाना है तो यहाँ लिख सकते हैं)
        $roles = Role::orderBy('name','ASC')->paginate(10);
        return view('admin.roles.list',[
                'roles' => $roles
        ]);
        

    }

    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get(); 

        return view('admin.roles.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)  {
        $validator = Validator:: make($request->all(),[
            'name'=>'required|unique:roles|min:3'
        ]);
        
        if($validator->passes()){
           $role= Role::create(['name'=>$request->name]);

           if(!empty($request->permission)){
            foreach($request->permission as $name){
                $role->givePermissionTo($name);
            }
           }
            return redirect()->route('admin.roles.index')->with('success','Role added successfully');
        }
        else{
            return redirect()->route('admin.roles.create')->withInput()->withErrors($validator);
        }
    }
        
        public function edit($id){
            $role = Role::findOrFail($id);
            $hasPermissions = $role->permissions()->pluck('name');
            $permissions = Permission::orderBy('name', 'ASC')->get(); 

            return view('admin.roles.edit',[
            'permissions' => $permissions,
            'hasPermissions'=>$hasPermissions,
            'role'=>$role 
        ]);
        }

        public function update($id,Request $request){

            $role = Role::findOrFail($id);

            $validator = Validator:: make($request->all(),[
                'name'=>'required|unique:roles,name,'.$id.',id'
            ]);
            
            if($validator->passes()){
                $role->name = $request->name;
                $role->save;

                   if(!empty($request->permission)){
                    $role->syncPermissions($request->permission);
               }
               else {
                $role->syncPermissions([]);
               }
                return redirect()->route('admin.roles.index')->with('success','Role Update successfully');
            }
            else{
                return redirect()->route('admin.roles.edit',$id)->withInput()->withErrors($validator);
            }
        }

            public function destroy($id){
                $role = Role::find($id);

                if($role == null){
                    session()->flash('error', ' Role Not Found');

                    return response()->json([
                        'status' =>false
                    ]);
                }
                $role->delete();
                session()->flash('success', ' Role Delete Successfully');
                return response()->json([
                    'status'=>true
                ]);

            }
        
 
}
