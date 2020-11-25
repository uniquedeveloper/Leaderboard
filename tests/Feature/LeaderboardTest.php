<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Employee;

class LeaderboardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/employees');

        $response->assertStatus(200);
    }

    // test for negetive points
    public function editEmployeePoints()
    {
        $response = $this->call('POST', '/employees/edit/1', ['points' => -8]);
        $response->assertResponseOk();
    }

    // test for empty request
    public function noEmployeePoints()
    {
        $response = $this->call('POST', '/employees/edit/1', []);
        $response->assertResponseOk();
    }

    
}
