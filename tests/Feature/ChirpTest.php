<?php

namespace Tests\Feature;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChirpTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateChirp(): void
    {
        $chirp = Chirp::factory()->make();
        $user = $chirp->user;

        $attributes = $chirp->only($chirp->getFillable());

        $this->actingAs($user)
            ->post(route('chirps.store'), $attributes)
            ->assertRedirect(route('chirps.index'));

        $this->assertDatabaseHas($chirp->getTable(), $chirp->attributesToArray());

        $this->get(route('chirps.index'))->assertSee([$user->name, $chirp->message]);
    }

    public function testIndexChirp(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('chirps.index'))->assertOk();
    }

    public function testEditChirp(): void
    {
        $chirp = Chirp::factory()->create();
        $user = $chirp->user;

        $this->actingAs($user)
            ->get(route('chirps.edit', $chirp))
            ->assertSee($chirp->message);
    }

    public function testUpdateChirp(): void
    {
        $chirp = Chirp::factory()->create();
        $user = $chirp->user;

        $updateChirp = Chirp::factory()->make(['user_id' => $user->id]);
        $attributes = $updateChirp->only($updateChirp->getFillable());

        $this->actingAs($user)
            ->patch(route('chirps.update', $chirp), $attributes)
            ->assertRedirect(route('chirps.index'));

        $this->assertDatabaseHas($updateChirp->getTable(), $updateChirp->attributesToArray());

        $this->actingAs($user)
            ->get(route('chirps.index'))
            ->assertSee($updateChirp->message);
    }

    public function testDestroyChirp(): void
    {
        $chirp = Chirp::factory()->create();
        $user = $chirp->user;

        $this->actingAs($user)
            ->delete(route('chirps.destroy', $chirp))
            ->assertRedirect(route('chirps.index'));

        $this->assertDatabaseMissing($chirp->getTable(), $chirp->only(['id']));
    }
}
