<?php

namespace App\Http\Controllers;

use App\ClientEvent;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function index(){

//        TODO: use viewComposer here

        $listOfCurrentEvents = ClientEvent::latest('active_from')->current()->get();
        $listOfFutureEvents = ClientEvent::latest('active_from')->future()->get();

        return view('pages.home', compact('listOfCurrentEvents', 'listOfFutureEvents'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(){

        return view('pages.about');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact(){

        return view('pages.contact');

    }

}

