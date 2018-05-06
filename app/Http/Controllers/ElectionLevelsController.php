<?php

namespace App\Http\Controllers;

use App\ElectionLevel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Pusher;

class ElectionLevelsController extends Controller
{
    private $userId = 1;

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
     * @param Request $id
     * @return string
     */
    public function add(Request $request)
    {
        $user = Auth::user();

        if($user){
            $this->userId = $user->id;
        }

        $level = $request->input('level');
        $electionId = $request->input('level');

        ElectionLevel::create([
            'level' => $level,
            'election_id' => $electionId,
            'user_id' => $this->userId,
            'active_slide' => 1
        ]);

        $pusher = $this->initPusher();

        $data['message'] = $request->all();
        $pusher->trigger('level_channel', 'add_event', 'info added');

        return $data['message'];
    }
}
