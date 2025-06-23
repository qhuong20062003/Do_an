<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Exception;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    use DeleteModelTrait;
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
    public function index(){
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        $users = $this->user->all();  
        $roles = ['admin', 'customer'];
        // lấy tất cả user
    // Hoặc nếu bạn muốn lấy role:
    // $roles = $this->user->select('role')->distinct()->pluck('role');
    return view('admin.user.add', compact('roles'));
    }
    public function store(Request $request){
        
        try{
            DB::beginTransaction();
            $user = $this->user->create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'role'=> $request->role
            
        ]);
        DB::commit();
        return redirect()->route('users.index');
        } catch(Exception $exception){
            DB::rollBack();
            Log::error('Loi:' . $exception->getMessage() . 'Line : ' . $exception->getLine());
        }
    }
    public function edit($id){
        $roles = ['admin', 'customer'];
        $user = $this->user->find($id);
        return view('admin.user.edit',compact('roles','user'));
    }
    public function update(Request $request,$id){
        try{
            DB::beginTransaction();
            $this->user->find($id)->update([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'role'=> $request->role
            
        ]);
        DB::commit();
        return redirect()->route('users.index');
        } catch(Exception $exception){
            DB::rollBack();
            Log::error('Loi:' . $exception->getMessage() . 'Line : ' . $exception->getLine());
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->user);

    }

}
