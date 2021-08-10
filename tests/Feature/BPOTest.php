<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BPOTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function bpo_area_renders_correctly() {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('staff.bpo.index'));

        $response->assertSuccessful();
        $response->assertSee('Staff Area - All BP Observations');
        $response->assertSee('id');
        $response->assertSee('systole');
        $response->assertSee('diastole');
    }
}
