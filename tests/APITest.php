<?php

use App\ElectionLevel;
use App\ClientEvent;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Response;

class APITest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function test_add_elecation_level()
    {
         $response = $this->call('POST', 
            '/event/13/level/add', 
            [
                'level' => '1', 
                'election_id' => '1'
            ]);
             
            $this->assertEquals(200, $response->status());
    }

    public function test_add_elecation_level_with_wrong_election_id()
    {
         $response = $this->call('POST', 
            '/event/13/level/add', 
            [
                'level' => '1', 
                'election_id' => '0'
            ]);
             
            $this->assertEquals(500, $response->status());
    }

    public function test_add_question()
    {
         $response = $this->call('POST', 
            '/event/13/question/add', 
            [
                'text' => 'Test Question',
                'client_event_id' => 13,
                'rate' => 1,
                'status' =>1
            ]);
             
            $this->assertEquals(200, $response->status());
    }

    public function test_qet_all_questions()
    {
         $response = $this->call('GET', '/event/13/questions');
             
            $this->assertEquals(200, $response->status());

            $this->get('/event/13/questions')
             ->seeJsonStructure([
                 '*' => [
                     'id', 'text', 'rate'
                 ]
             ]);
    }
}
