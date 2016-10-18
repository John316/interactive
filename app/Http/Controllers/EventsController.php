<?php

namespace App\Http\Controllers;

use App\ClientEvent;
use Illuminate\Http\Request;
use App\Http\Requests;

class EventController extends Controller
{
    protected $event;

    /**
     *
     * @param $id
     * @return ClientEvent
     */
    public function getCurrentEvent($id)
    {
        if(!$this->event instanceof ClientEvent){
            if($id){
                $this->event = ClientEvent::find($id);
            }
        }

        return $this->event;
    }

    public function setCurrentEvent($event)
    {
        if($event instanceof ClientEvent){
            $this->event = $event;
        }
    }

    /**
     * @param ClientEvent $clientEvent
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show( ClientEvent $clientEvent)
    {
        $this->event = $clientEvent;
        return view('pages.event', compact('clientEvent'));
    }

    /**
     * @param $id
     * @return string
     */
    public function status($id)
    {
        $event = $this->getCurrentEvent($id);
        return $event->status;
    }

    /**
     * @return string
     */
    public function start()
    {
        $isActive = fopen("isActive.txt", "w") or die("Unable to open file!");
        $status = "active";
        fwrite($isActive, $status);
        fclose($isActive);

        return $status;
    }

    /**
     * @return string
     */
    public function stop()
    {
        $isActive = fopen("isActive.txt", "w") or die("Unable to open file!");
        $status = "not active";
        fwrite($isActive, $status);
        fclose($isActive);

        return $status;
    }

    public function mainStat($id)
    {
        $event = $this->getCurrentEvent($id);
        $data = $event->getMainStatistic();

        return $data;
    }
}
