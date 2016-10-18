<?php

namespace App\Http\Controllers;

use App\ClientEvent;
//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\EventRequest;
use Carbon\Carbon;
use Request;

class EventsController extends Controller
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.createEvent');
    }

    /**
     * @param EventRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EventRequest $request)
    {
        ClientEvent::create($request->all());
        return redirect('/');
    }

    /**
     * @param ClientEvent $clientEvent
     * @param EventRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update( ClientEvent $clientEvent, EventRequest $request)
    {
        $clientEvent->update($request->all());
        return redirect('/');
    }

    /**
     * @param ClientEvent $clientEvent
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( ClientEvent $clientEvent)
    {
        return view('pages.editEvent', compact('clientEvent'));
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

    public function start($id)
    {
        $clientEvent = $this->getCurrentEvent($id);
        $clientEvent->update(['status' => '2']);
        $clientEvent->saveOrFail();

        return $clientEvent->status;
    }

    public function stop($id)
    {
        $clientEvent = $this->getCurrentEvent($id);
        $clientEvent->update(['status' => '0']);
        $clientEvent->saveOrFail();

        return $clientEvent->status;
    }

    public function mainStat($id)
    {
        $event = $this->getCurrentEvent($id);
        $data = $event->getMainStatistic();

        return $data;
    }
}
