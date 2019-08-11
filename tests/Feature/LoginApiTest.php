<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request; 

class LoginApiTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = factory(User::class)->create();
    }


    /**
     * @test
     */
    public function should_登録済みのユーザーを認証して返却する()
    {   
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response
            ->assertJson(['name' => $this->user->name])
            ->assertStatus(200);
            

        $this->assertAuthenticatedAs($this->user);
    }
}
