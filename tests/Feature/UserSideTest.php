<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserSideTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    
    public function test_example(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    
    public function guest_cant_see_dashboard(){
        $response = $this->get("/dashboard");
        $response->assertRedirect("/login");
    }

    public function test_user_can_see_dashboard(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/dashboard");
        $response->assertStatus(200);
        $response->assertSee('dashboard');
    }

}
