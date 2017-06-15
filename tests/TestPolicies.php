<?php 

namespace Tests;

use Tests\TestCase;

use Silvanite\Brandenburg\Policy;

class TestPolicies extends TestCase
{
    public function testPoliciesAreRegistered()
    {
        $this->assertContains('users_read', Policy::all());
    }
}