<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('admin.start');
    }

    public function add_admin_view(){
        return view('admin.add-admin-view');
    }


    public function new_admin(Request $request){
        // return User::create([
        //     'name' => $request['name'],
        //     'phone' => $request['phone'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        // ]);
    }

    public function delete_admin(Request $request){

    }

    public function update_admin(Request $request){

    }

}
