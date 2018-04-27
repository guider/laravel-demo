<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

//    public function index()
//    {
//        return 'index';
//
//    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);

        return redirect()->back();

    }

    public function destory(Status $status)
    {
        $this->authorize('destory',$status);
        $status->delete();
        session()->flash('success','微博已删除');
        return redirect()->back();

    }

}
