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
        $event = factory(ClientEvent::class, 3)->create();

        $events = ClientEvent::current()->get();

        $this->assertCount(3, $events);
    }
	
    public function test_it_check_last_added_client_event()
    {
        $event = factory(ClientEvent::class)->create();

        $events = ClientEvent::current()->get();

        $this->assertEquals($event->id, $events->first()->id);
    }

    public function test_it_create_question_record()
    {
        $event = factory(Question::class)->create();

        $events = Question::all();

        $this->assertEquals($event->id, $events->last()->id);
    }
} 