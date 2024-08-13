<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserEmailExistTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testCreateUserEmailExist(): void
    {
         $data  =[
            'name' =>'duplicate email',
            'email' => 'defaultuser@email.com',
            'password'  => '12345678',
            'password_confirmation' =>'12345678'
        ];
        $response = $this->post('/api/v1/user/create', $data);
        $response->assertStatus(302);
    }
}
