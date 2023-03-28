<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Provider\Text;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_incrementing_works(): void
    {
        $firstCountryCode = Text::toUpper(Text::randomLetter() . Text::randomLetter());
        $secondCountryCode = Text::toUpper(Text::randomLetter() . Text::randomLetter());

        $initialCount = $this->get('/api/visits');
        $this->post('/api/visits', ['country' => $firstCountryCode]);
        $this->post('/api/visits', ['country' => $secondCountryCode]);
        $this->post('/api/visits', ['country' => $firstCountryCode]);

        $response = $this->get('/api/visits');

        $response->assertStatus(200);
        static::assertEquals(
            $response->json($firstCountryCode),  $initialCount->json($firstCountryCode) + 2
        );
        static::assertEquals(
            $response->json($secondCountryCode),  $initialCount->json($secondCountryCode) + 1
        );
    }

}
