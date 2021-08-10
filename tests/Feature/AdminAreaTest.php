<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAreaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function admin_area_renders_correctly() {
        $role = Role::Create(['name' => 'admin']);

        $user = User::factory()->create();
        $user->roles()->attach($role);
        $this->actingAs($user);

        $response = $this->get(route('admin.users.index'));
        $response->assertSee('Admin Area - All Staff Members ');
        $response->assertSee('roles');
        $response->assertSee('name');
        $response->assertSee('id');
    }
}
