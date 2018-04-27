<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {
    public function __construct()
    {
        $this->middleware('auth',[
           'except'=>['show','create','store','index']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }


    public function index()
    {
        $users=User::paginate(10);
        return view('users.index',compact('users'));
    }

    public function create(Request $req) {

		return view('users.create');
	}
	public function show(User $user) {

        $statuses=$user->statuses()->orderBy('created_at','desc')->paginate(30);

		return view('users.show', compact('user','statuses'));
	}

	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|max:50',
			'email' => 'required|unique:users|max:255',
			'password' => 'required|confirmed|min:6',
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);
		Auth::login($user);

		session()->flash('success', '恭喜你注册成功');

		return redirect()->route('users.show', [$user->id]);
	}

    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
	}

    public function update(User $user,Request $request)
    {
        $this->validate($request,[
           'name'=>'required|max:50',
           'password'=>'required|confirmed:min6'
        ]);

        $this->authorize('update',$user);

        $data=[];
        $data['name'] = $request->name;
        if ($request->password){
            $data['password']=bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success','更新成功');

        return redirect()->route('users.show',$user->id);
    }

    public function destory(User $user)
    {
        $this->authorize('destory',$user);
        $user->delete();
        session()->flash('success','删除成功');
        return back();
    }





}

