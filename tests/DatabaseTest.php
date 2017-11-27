<?php

namespace Silvanite\Brandenburg\Test;

use Carbon\Carbon;

class DatabaseTest extends TestCase
{
    /**
     * Check that tests are working
     * @return void
     */
    public function testDatabaseContainsTestUsers()
    {
        $this->assertContains('ellis.briggs@email.localhost', User::find(1)->toArray());
        $this->assertContains('oscar.mitchell@email.localhost', User::find(2)->toArray());
    }
}
