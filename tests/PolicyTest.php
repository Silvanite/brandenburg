<?php

namespace Silvanite\Brandenburg\Test;

use Silvanite\Brandenburg\Policy;

class PolicyTest extends TestCase
{
    public function testPolicyReturnsGatePolicies()
    {
        $this->assertContains('articles_publish', Policy::all());
        $this->assertContains('articles_draft', Policy::all());
    }
}
