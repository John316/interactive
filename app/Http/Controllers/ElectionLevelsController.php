<?php

namespace App\Http\Controllers;

use App\ElectionLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers;
use App\Http\Requests;
use Pusher;

class ElectionLevelsController extends Controller
{

    /**
     * @return Pusher
     */
    public function initPusher()
    {
        $options = array(
            'encrypted' => true
        );
        $pusher = new Pusher(
            '75c1ec166f3486e363b8',
            'e1aac03ae60ea5b6807b',
            '261149',
            $options
        );
        return $pusher;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function add(Request $request)
    {
        ElectionLevel::create($request->all());

        $pusher = $this->initPusher();

        $data['message'] = $request->all();
        $pusher->trigger('level_channel', 'add_event', 'info added');

        return $data['message'];
    }
}
