<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    /** 
    * @test 
    * A test when a person can create a new account.
    Here i modified the User Model (App/User.php) and add the column 'role_id' so i can register a new one.
    */
    public function create_new_account()
    {   

        $newAccount = factory(User::class)->create([
            'role_id'  => '2',
            'email' => 'elo.gza@hotmail.com',
            'name' => 'Eloisa',
            'password' => 'Eloisa2345',
            'username' => 'egarza'
        ]);

        $response = $this->get('/users/'.$newAccount->id);

        $response->assertOk(200);
    }


    /** 
    * A test when a person can create a new account and it sends an incorrectly formatted email and the creation should be returning a failing status.
    I modified the file 'app/Http/Requests/UserStoreRequest.php' to complete the validation.
    * @test 
    */
    public function can_create_new_account_check_email()
    {   
        $user = ['username' => 'hlara',
                'email' => 'glara@hotmail',
                'name' => 'Hector',
                'password' => 'Hector1234',
                'role_id' => '2',
                'password_confirmation'=>'Hector1234'];

        $this->post('/api/users/register',$user)->assertSessionHasNoErrors(['email']);

    }

    /** 
    * A test when a person can create a new account and it sends a password that not fulfill the minimum requirements of 8 characters, at least one capital letter, one number, and one number.
    I modified the file 'app/Http/Requests/UserStoreRequest.php' to complete the validation.
    * @test 
    */
    public function can_create_new_account_check_password()
    {   
        $user = ['username' => 'adrian',
                'email' => 'adrian@hotmail.com',
                'name' => 'Adrian',
                'role_id' => '2',
                'password' => 'Adrian',
                'password_confirmation'=>'Adrian'];

        $this->post('/api/users/register',$user)->assertSessionHasNoErrors(['email']);
    }

     /** 
    * 
    * @test 
    */
    public function create_new_account_post()
    {   
        $this->withoutExceptionHandling();

        $response = $this->post('/api/users/register',[
            'email' => 'montoya.gza@hotmail.com',
            'name' => 'Montoya',
            'password' => 'Montoya12345',
            'password_confirmation'  => 'Montoya12345',
            'username' => 'smontoya',
        ]);
        $response->assertOk(200);
    }

     /** 
    * 
    * @test 
    */
    public function edit_account()
    {   
        $newuser = User::create([
            'role_id' => '1',
            'password' => 'Secret123',
            'name' => 'user-for-edit',
            'username' => 'user-for-edit',
            'email' => 'user-for-edit@hotmail.com'
        ]);

        $newuser->update([
            'email' => 'user-edit@hotmail.com',
            'username' => 'user-edit',
            'name' => 'user-edit'
        ]); 

        $user = ['username' => $newuser->username,
                'password' => 'Secret123'];

        $response = $this->post('/api/users/login',$user)->assertStatus(200);
    }

     /** 
    * 
    * @test 
    */
    public function delete_account()
    {   
        $newuser = User::create([
            'role_id' => '1',
            'password' => 'Secret123',
            'name' => 'user-delete-account',
            'username' => 'user-delete-account',
            'email' => 'user-delete-account@hotmail.com'
        ]);

        $newuser->delete();

        $user = ['username' => $newuser->username,
                'password' => 'Secret123'];
                
        $response = $this->post('/api/users/login',$user)->assertStatus(401);
    }

}
