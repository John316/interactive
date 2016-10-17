<?php

namespace App\Http\Controllers;

use App\ClientEvent;
use App\GeneralEvent;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function index(){

        $listOfCurrentEvents = ClientEvent::all();
        $listOfFutureEvents = [['id' => 1, 'name' => 'Future1'], ['id' => 2, 'name' => 'Future2'], ['id' => 3, 'name' => 'Future3']];

        return view('pages.home', compact('listOfCurrentEvents', 'listOfFutureEvents'));
    }

    public function about(){

        return view('pages.about');

    }

    public function contact(){

        return view('pages.contact');

    }

}

