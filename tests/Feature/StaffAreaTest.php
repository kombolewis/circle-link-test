<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffAreaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function staff_area_renders_correctly() {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('staff.patients.index'));

        $response->assertSuccessful();
        $response->assertSee('Staff Area - All Registered Patients');
        $response->assertSee('id');
        $response->assertSee('name');
        $response->assertSee('email');
    }
}
