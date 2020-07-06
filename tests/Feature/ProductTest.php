<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Product;
use Laravel\Passport\Passport;

class ProductTest extends TestCase
{   

    /**
     * A test when an anauthenticated try to create a new product it should return an error.
     *
     * @test
     */
    public function can_unauthenticated_create_product()
    {   

        $response = $this->post('/api/products',[
            'name' => 'Product 1',
            'description' => 'Description for product 1',
            'price' => '1500',
            'slug'  => 'Product slug',
        ]);

        $response->assertOk();
        $response->assertSee('Product 1');
    }

    /**
     * A test when an authenticated try to create a new product it should be successful.
     *
     * @test
     */
    public function can_authenticated_create_product()
    {   
         Passport::actingAsClient(
           factory(User::class)->create([
            'role_id'  => '1',
            'email' => 'diana.garcia@gmail.com',
            'name' => 'Diana',
            'password' => 'diana12345',
            'username' => 'dgarcia'
            ]),['products']
        );

        $product = Product::create([
             'name' => 'Product 2',
            'description' => 'Description for product 2',
            'price' => '12300',
            'slug'  => 'Product 2 slug',
        ]);

        $response = $this->get('/api/products');

        $response->assertSeeText('Product 2');
    }

    /**
     * A test when an authenticated try to create a new product but sends a string on the price.
     *
     * @test
     */
    public function can_authenticated_create_product_check_price()
    {

        Passport::actingAsClient(
           factory(User::class)->create([
            'role_id'  => '1',
            'email' => 'vanessa.haros@gmail.com',
            'name' => 'Vanesa',
            'password' => 'vanesa12345',
            'username' => 'vharos'
            ]),['products']
        );

        $product = Product::create([
            'name' => 'Product 3',
            'description' => 'Description for product 3',
            'price' => "Hello im a string",
            'slug'  => 'Product 3 slug',
        ]);

        $response = $this->get('/api/products');

        $response->assertSeeText('Product 3');
    }

    /** 
    * 
    * @test 
    */
    public function edit_product()
    {   
        $product = Product::create([
                'name' => 'Product-for-edit',
                'description' => 'Description for product-edit',
                'price' => 5200,
                'slug'  => 'Product-for-edit slug',
        ]);

        $product->update([
            'name' => 'Product-edit',
            'price' => 8000,
        ]); 

        $response = $this->get('/api/products?page=1');

        $response->assertSee("Product-edit");
        $response->assertSee('8000');
    }

     /** 
    * 
    * @test 
    */
    public function delete_product()
    {   
        $product = Product::create([
                'name' => 'Product-for-delete',
                'description' => 'Description for product-delete',
                'price' => 2500,
                'slug'  => 'Product-for-delete slug',
        ]);

        $product->delete();

        $response = $this->get('/api/products?page=1');

        $response->assertDontSee("Product-for-delete");
    }
}
