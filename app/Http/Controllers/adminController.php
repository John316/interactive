<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class adminController extends Controller
{
    public function show(){
        return view('admin.index');
    }
}
