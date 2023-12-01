<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_user_can_registered(){
        $response = $this->post('/register', [
            'name' => 'Test User',
            'alamat' => 'ajdkfjaldsk',
            'email' => 'ysas@outlook.com',
            'password' => '123456',
         ]);

        $response->assertRedirect('/login-user');

    }

    public function test_registration_requires_all_fields()
    {
        $response = $this->post('/register', []);
        $response->assertSessionHasErrors(['name','alamat', 'email', 'password']); // Pastikan error untuk field yang diperlukan
        // Anda dapat menambahkan lebih banyak asser untuk validasi spesifik lainnya
    }

    public function test_email_must_be_unique()
{
    // Register pengguna pertama kali
    $response = $this->post('/register', [
        'name' => 'Test User',
        'alamat' => 'ajdkfjaldsk',
        'email' => 'ari@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // Coba register pengguna dengan email yang sama
    $response = $this->post('/register', [
        'name' => 'Another User',
        'alamat' => 'ajdkfjaldsk',
        'email' => 'ari@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);
    $response->assertSessionHasErrors(['email']); // Pastikan terdapat pesan error untuk email yang tidak unik
}
}
