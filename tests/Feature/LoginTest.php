<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login'); // Pastikan halaman menampilkan elemen 'Login'
        // Tambahkan asser lain sesuai kebutuhan, seperti validasi field form, dll.
    }

   public function test_registered_user_can_login()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@rocketmain.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }

    public function test_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'invalidpassword',
        ]);

        $this->assertGuest(); // Pastikan tidak ada autentikasi setelah percobaan login yang gagal
        $response->assertSessionHasErrors(['email']); // Pastikan terdapat pesan error untuk kredensial yang salah
    }
}
