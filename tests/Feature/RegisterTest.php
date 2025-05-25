<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'nik', 'nama', 'tempat_lahir', 'tanggal_lahir',
                'jenis_kelamin', 'pendidikan', 'alamat', 'no_telepon',
                'status', 'foto', 'tanggal_daftar', 'email', 'password',
            ]);
    }

    /** @test */
    public function it_creates_register_successfully()
    {
        // $user = User::factory()->create();

        $data = [
            'nik'            => '12345678901234567890',
            'nama'           => 'John Doe',
            'tempat_lahir'   => 'Jakarta',
            'tanggal_lahir'  => '01/01/2000',
            'jenis_kelamin'  => 'Laki-laki',
            'pendidikan'     => 'SD',
            'alamat'         => 'Jl. Sudirman No. 1',
            'no_telepon'     => '+62 81234567890',
            'status'         => 'Pelajar',
            'foto'           => UploadedFile::fake()->image('photo.jpg'),
            'tanggal_daftar' => '01/01/2025',
            'email'          => 'johndoe@example.com',
            'password'       => 'password123',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Register Successfully!'
            ]);
    }
}
