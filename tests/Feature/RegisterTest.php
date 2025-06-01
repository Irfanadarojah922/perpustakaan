<?php
namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    #[Test]
    public function it_validates_required_fields(): void
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'nik', 'nama', 'tempat_lahir', 'tanggal_lahir',
                'jenis_kelamin', 'pendidikan', 'alamat', 'no_telepon',
                'status', 'foto', 'tanggal_daftar', 'email', 'password',
            ]);
    }

    #[Test]
    public function it_creates_register_successfully(): void
    {
        $faker = Factory::create("id_ID");
        $data = [
            'nik'            => $faker->nik(),
            'nama'           => 'John Doe',
            'tempat_lahir'   => 'Jakarta',
            'tanggal_lahir'  => Factory::create("id_ID")->date(),
            'jenis_kelamin'  => 'Laki-laki',
            'pendidikan'     => 'SD',
            'alamat'         => 'Jl. Sudirman No. 1',
            'no_telepon'     => '+62 81234567890',
            'status'         => 'Pelajar',
            'foto'           => UploadedFile::fake()->image('photo.jpg'),
            'tanggal_daftar' => Factory::create("id_ID")->date(),
            'email'          => $faker->email,
            'password'       => 'password123',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Register Successfully!',
            ]);
    }
}
