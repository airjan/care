<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
     use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testCreateUser(): void
    {
        $data  =[
            'name' =>'testname',
            'email' => 'testemail@email.com',
            'password'  => '12345678',
            'password_confirmation' =>'12345678'
        ];
        $response = $this->post('/api/v1/user/create', $data);
        $response->assertStatus(200);
        //$this->assertTrue(true);
    }

     public function testCreateUserwithoutEmail(): void
    {
        $data  =[
            'name' =>'testname',
            'password'  => '12345678',
            'password_confirmation' =>'12345678'
        ];
        $response = $this->post('/api/v1/user/create', $data);
        $response->assertStatus(302);
      
    }
}
