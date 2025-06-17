<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\User;
use App\Models\OrderItem;
use \Spatie\Permission\Models\Role;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view users')->only('index');
        $this->middleware('permission:edit users')->only('edit');
        $this->middleware('permission:create users')->only('create');
        $this->middleware('permission:delete users')->only('destroy');
    }

    function list()
    {
        return User::all();
    }

    public function addUser(Request $request){

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }   
        else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->email = $request->phone;
            $user->email = $request->password;
           if($user->save()){
               return ["result"=>"Data has been saved"];
           }else{
               return ["result"=>"Operation failed"];
           } 
        }

     

    }
    public function updateUser(Request $request){
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email = $request->phone;
        $user->email = $request->password;
       if($user->save()){
           return ["result"=>"Data has been saved"];
       }else{
           return ["result"=>"Operation failed"];
       } 

    }

    public function deleteUser($id){
       $user = User::destroy($id);
         if($user){
              return ["result"=>"User has been deleted"];
            }else{  
              return ["result"=>"Operation failed"];
            }
    }

    public function searchUser($name){
        $user = User::where("name","like","%".$name."%")->get();
        if($user){
            return $user;
        }else{
            return ["result"=>"Operation failed"];
        }

    }

    public function profile()
    {
        return view('admin.users.profile'); // Profile के लिए Blade file load करें
    }
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('admin.users.list', compact('users'));
    }


    public function account_orders()
    {
    $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(10);
    return view('user.orders',compact('orders'));
    }

    public function account_order_details($order_id)
    {
       $order = Order::where('user_id',Auth::user()->id)->find($order_id);        
       $orderItems = OrderItem::where('order_id',$order_id)->orderBy('id')->paginate(12);
       $transaction = Transaction::where('order_id',$order_id)->first();
        return view('user.order-details',compact('order','orderItems','transaction'));
    }

    public function account_cancel_order(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = "canceled";
        $order->canceled_date = Carbon::now();
        $order->save();
        return back()->with("status", "Order has been cancelled successfully!");
    }   
    
    
    // public function list()
    // {
    //     $data['getRecord']= User::getRecord();
    //     return view("admin.users.list",$data);
    // }


    public function create(){
     
        $roles = Role::orderBy('name','ASC')->get() ;
        return view('admin.users.create',[
            'roles'=>$roles 
        ]);
    }


    public function edit(string $id){
      
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name','ASC')->get();

        $hasRoles= $user->roles->pluck('id');
        return view('admin.users.edit',[
            'user'=> $user,
            'roles'=>$roles,
            'hasRoles'=>$hasRoles

        ]);
    }
    public function store(Request $request)
    {  
      
        // dd($request->role); // Debug करें कि roles आ रहे हैं या नहीं
      
        

        $validator = Validator::make($request->all(),[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password' =>'required|min:6|same:confirm_password',
            'confirm_password'=>'required',
        ]);
        
        if($validator->fails()){
           return redirect()->route('admin.users.create')->withInput()->withErrors($validator);
        }
        $user=new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password=Hash::make($request->password);

        $user->save();

        $user->syncRoles($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User added successfully');

       }

       public function update($id,Request $request)
       {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(),[
                'name'=>'required|min:3',
                'email'=>'required|email|unique:users,email,'.$id.',id'
            ]);
            
            if($validator->fails()){
               return redirect()->route('admin.users.edit',$id)->withInput()->withErrors($validator);
            }

            $user->name= $request->name;
            $user->email= $request->email;
            $user->save();

            $user->syncRoles($request->role);
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');


          }

          public function destroy(Request $request){
            $user = User::find($request->id);

                if ($user == null) {
                    session()->flash('error', 'User not found');
                    return response()->json([
                        'status' => false
                    ]);
                }

                $user->delete();

                session()->flash('success', 'User deleted successfully');
                return response()->json([
                    'status' => true
                ]);

          }

    }
