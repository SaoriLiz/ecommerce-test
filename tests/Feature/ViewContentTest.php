<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Role;
use App\Product;
use Laravel\Passport\Passport;

class ViewContentTest extends TestCase
{
    /**
     * 
     * @test
     */
    public function can_view_default_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 
     * @test
     */
    public function can_view_products_pagination()
    {   

        for ($i=1; $i <=25 ; $i++) { 
            $product = Product::create([
                'name' => 'Product '.$i,
                'description' => 'Description for product '.$i,
                'price' => 12345,
                'slug'  => 'Product '.$i.' slug',
            ]);
        }

        $response = $this->get('/api/products?page=1');
        $response->assertSee("Product 25");
        $response = $this->get('/api/products?page=2');
        $response->assertSee("Product 11");
        $response = $this->get('/api/products?page=3');
        $response->assertSee("Product 1");
    }

    /**
     * 
     * @test
     */
    public function can_view_register_page()
    {
        $response = $this->get('/api/users/register');

        $response->assertStatus(200);
    }

    /**
     * 
     * @test
     */
    public function can_view_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * 
     * @test
     */
    public function can_user_login()
    {
        $user = ['username' => 'admin',
                'password' => 'Secret123'];

        $response = $this->post('/api/users/login',$user)->assertStatus(200);
    }


    /**
     * 
     * @test
     */
    public function can_view_users_page()
    {
        $response = $this->get('/admin/users/');

        $response->assertStatus(200);
    }

    /**
     * 
     * @test
     */
    public function can_view_users_pagination()
    {   
        $this->withoutExceptionHandling();

        for ($i=0; $i <=15 ; $i++) { 
            factory(User::class)->create([
                'role_id'  => '2',
                'password' => 'Secret123',
                'username' => 'user-'.$i
            ]);

        }

        $response = $this->get('/api/users/details');

        $response->assertStatus(200);
    }
}
