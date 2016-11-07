<?php

use App\ElectionLevel;
use App\ClientEvent;
use App\Question;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ModelsTest extends TestCase
{
	use DatabaseTransactions;


	public function test_it_create_client_event_class()
    {
        $event = new ElectionLevel();

        $this->assertEquals($event->GetTableName(), "election_levels");
    }

    public function test_it_create_client_events_in_db()
    {
				$prevCount = count(ClientEvent::current()->get());

				factory(ClientEvent::class, 3)->create();

				$newCount = count(ClientEvent::current()->get());

        $this->assertEquals($newCount, $prevCount + 3);
    }

    public function test_it_check_last_added_client_event()
    {
        $event = factory(ClientEvent::class)->create();

        $lastEvent = ClientEvent::lastAdded()->get();
				
        $this->assertEquals($event->id, $lastEvent->first()->id);
    }

    public function test_it_create_question_record()
    {
        $event = factory(Question::class)->create();

        $events = Question::all();

        $this->assertEquals($event->id, $events->last()->id);
    }
}
