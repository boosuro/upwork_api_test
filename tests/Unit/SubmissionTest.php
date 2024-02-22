<?php

namespace Tests\Unit;

use Faker\Factory;
use Tests\TestCase;
use Faker\Generator;
use App\Models\Submission;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class SubmissionTest extends TestCase
{

    use DatabaseMigrations;

    private Generator $faker;
    private $payload;

    public function setUp(): void {
        
        parent::setUp();
        $this->faker = Factory::create();
        Artisan::call('migrate:refresh');

        $this->payload = [
                'name' => $this->faker->name,
                'email'  => $this->faker->email,
                'message' => $this->faker->text
            ];
    }


    public function test_submission_is_created_successfully(): void {

        $this->postJson('api/v1/submit', $this->payload)
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(
                 [
                     'data' => [
                         'name',
                         'email',
                         'message'
                     ],
                    'message',
                    'success'
                 ]
             );
        $this->assertDatabaseHas('submissions', $this->payload);
    }

    public function test_submission_creation_fails_when_validation_fails(): void {

        $this->postJson('api/v1/submit', [
            'email'  => $this->faker->email,
            'message' => $this->faker->text
        ])->assertStatus(422);

        $this->assertDatabaseMissing('submissions', $this->payload);
    }
    
}
