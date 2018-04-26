<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller {
	//
	//

	public function create(Request $req) {

		return view('users.create');
	}
}
