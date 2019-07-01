<?php

namespace Tests\Feature;

use App\Pattern;
use App\Repositories\Patterns\PatternsRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatternsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_pattern_can_be_created() : void
    {
        $attributes = raw(Pattern::class);

        $patternsRepo = resolve(PatternsRepository::class);

        $patternsRepo->create($attributes);

        $this->assertDatabaseHas('patterns', $attributes);
    }
}
