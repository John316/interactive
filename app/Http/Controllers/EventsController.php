<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\ClientEvent;
use App\Question;
//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\EventRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Pusher;


class EventsController extends Controller
{
    public function __construct()
    {
        $this->pusher = $this->initPusher();
    }

    public function getPusher(){

        return $this->pusher;

    }

    protected $event;

    protected $pusher;

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
        if (Auth::check()) {
          return view('pages.createEvent');
        }
        return redirect('/login');
    }

    /**
     * @param EventRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EventRequest $request)
    {
        if (Auth::check()) {
          $input = $request->only('name', 'desc', 'status', 'active_from', 'active_to');
          $event = ClientEvent::create($input);
          $user = Auth::user();
          $user->events()->attach($event);
        }
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
     * @param ClientEvent $clientEvent
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function slides($id)
    {
        $event = $this->getCurrentEvent($id);

        return view('pages.slides', compact('event'));
    }

    public function delete($id)
    {
        Storage::disk('public')->delete("events/$id/slides/".$id.".jpg");

        return redirect()->action(  
          'EventsController@slides', ['id' => $id]
        ); 
    }

    public function upload($id){

      if(Input::hasFile('file')){ 

        $file = Input::file('file');        

        Storage::disk('public')->putFileAs("events/$id/slides/", $file, $file->getClientOriginalName());
      }     

      return redirect()->action(  
        'EventsController@slides', ['id' => $id]
      );  
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
        $pusher = $this->getPusher();

        $pusher->trigger('event_channel', 'start_event', true);

        $clientEvent = $this->getCurrentEvent($id);
        $clientEvent->update(['status' => '2']);
        $clientEvent->saveOrFail();

        return "status: ". $clientEvent->status;
    }

    public function stop($id)
    {

        $pusher = $this->getPusher();

        $pusher->trigger('event_channel', 'stop_event', true);

        $clientEvent = $this->getCurrentEvent($id);
        $clientEvent->update(['status' => '0']);
        $clientEvent->saveOrFail();
        return "status: ". $clientEvent->status;
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function addQuestion($id, Request $request)
    {
        $data = [];
        $data['text'] = $request->only('text');
        $data['client_event_id'] = 12;
        $user = Auth::user();
        if($user){
            $data['user_id'] = 1;
        }else{
            $data['user_id'] = 1;
        }

        Question::create($data);

        $question = new Question();
        $question->text = $request->only('text');
        $question->user_id = $data['user_id'];
        $question->save();

        $question->events()->sync([$id],false);

        $pusher = $this->getPusher();
        $pusher->trigger('event_channel', 'question_event', $request['text']);

        return $data;
    }

    public function getAllQuestions($id, Request $request)
    {
        return Question::getByEventId($id);
    }

    public function mainStat($id)
    {
        $event = $this->getCurrentEvent($id);
        $data = $event->getStatistic();

        return $data;
    }

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
}
