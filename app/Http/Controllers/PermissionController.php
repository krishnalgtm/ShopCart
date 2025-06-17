<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view permissions')->only('index');
        $this->middleware('permission:edit permissions')->only('edit');
        $this->middleware('permission:create permissions')->only('create');
        $this->middleware('permission:delete permissions')->only('destroy');
    }
    
    
    public function index(){
        $permissions = Permission::orderBy('created_at' , 'DESC')->paginate(10);
        return view('admin.permissions.list',[
            'permissions' => $permissions
        ]);
       
    }
    public function create(){
        return view('admin.permissions.create');
    }
    public function store(Request $request){
        $validator = Validator :: make($request->all(),[
            'name'=>'required|unique:permissions|min:3'
        ]);
        
        if($validator->passes()){
            Permission::create(['name'=>$request->name]);
            return redirect()->route('admin.permissions.index')->with('success','Permission added successfully');
        }
        else{
            return redirect()->route('admin.permissions.create')->withInput()->withErrors($validator);
        }
    }
    public function edit($id){
        $permission = Permission::findorFail($id);        
        return view('admin.permissions.edit',[
            'permission' =>$permission
        ]);
        

    }

    public function update($id,Request $request){
        $permission = Permission::findorFail($id);   

        $validator = Validator :: make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.'.id'
        ]);
        
        if($validator->passes()){
           $permission->name= $request->name;
           $permission->save;
           return redirect()->route('admin.permissions.index')->with('success','Permission updated successfully');
        }
        else{
            return redirect()->route('admin.permissions.edit',$id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request){
        $id = $request->id;

        $permission = Permission::find($id);

        if($permission==null){
            session()->flash('error','Permission not found');
            return response()->json([
                'status'=> false
            ]);
        }
        $permission->delete();
        session()->flash('success','Permission Delete successfully');
            return response()->json([
                'status'=> true
            ]);
        
    }
}
