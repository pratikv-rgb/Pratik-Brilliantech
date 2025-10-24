<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Vendor;
use App\Models\Store;
use App\Models\Zone;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class VendorLoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test data
        $this->zone = Zone::factory()->create();
        $this->module = Module::factory()->create();
        
        $this->vendor = Vendor::factory()->create([
            'email' => 'vendor@test.com',
            'password' => bcrypt('password123'),
            'status' => 1
        ]);
        
        $this->store = Store::factory()->create([
            'vendor_id' => $this->vendor->id,
            'zone_id' => $this->zone->id,
            'module_id' => $this->module->id,
            'status' => 1,
            'store_business_model' => 'commission'
        ]);
    }

    public function test_vendor_owner_login_success()
    {
        $response = $this->postJson('/api/v1/auth/vendor/login', [
            'email' => 'vendor@test.com',
            'password' => 'password123',
            'vendor_type' => 'owner'
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'token',
                    'zone_wise_topic',
                    'module_type'
                ]);
    }

    public function test_vendor_login_invalid_credentials()
    {
        $response = $this->postJson('/api/v1/auth/vendor/login', [
            'email' => 'vendor@test.com',
            'password' => 'wrongpassword',
            'vendor_type' => 'owner'
        ]);

        $response->assertStatus(401)
                ->assertJsonStructure([
                    'errors' => [
                        '*' => [
                            'code',
                            'message'
                        ]
                    ]
                ]);
    }

    public function test_vendor_login_missing_vendor_type()
    {
        $response = $this->postJson('/api/v1/auth/vendor/login', [
            'email' => 'vendor@test.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(403)
                ->assertJsonStructure([
                    'errors'
                ]);
    }

    public function test_vendor_login_invalid_vendor_type()
    {
        $response = $this->postJson('/api/v1/auth/vendor/login', [
            'email' => 'vendor@test.com',
            'password' => 'password123',
            'vendor_type' => 'invalid_type'
        ]);

        $response->assertStatus(403)
                ->assertJsonStructure([
                    'errors'
                ]);
    }

    public function test_vendor_login_missing_email()
    {
        $response = $this->postJson('/api/v1/auth/vendor/login', [
            'password' => 'password123',
            'vendor_type' => 'owner'
        ]);

        $response->assertStatus(403)
                ->assertJsonStructure([
                    'errors'
                ]);
    }

    public function test_vendor_login_invalid_email_format()
    {
        $response = $this->postJson('/api/v1/auth/vendor/login', [
            'email' => 'invalid-email',
            'password' => 'password123',
            'vendor_type' => 'owner'
        ]);

        $response->assertStatus(403)
                ->assertJsonStructure([
                    'errors'
                ]);
    }
}
