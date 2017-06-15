<?php 

namespace Tests;

use Tests\TestCase;

use Silvanite\Brandenburg\User;

class TestUsers extends TestCase
{
    public function testCanCreateUser()
    {
        $user = User::make([
            'name' => 'Foo',
            'email' => 'foo@bar.baz',
            'password' => 'foobar'
        ]);
        
        $this->assertInstanceOf(User::class, $user);

        $this->assertTrue($user->name === 'Foo');
        $this->assertTrue($user->email === 'foo@bar.baz');
        $this->assertTrue($user->password === 'foobar');
    }
}