<?php

namespace Silvanite\Brandenburg\Test;

use Carbon\Carbon;
use Silvanite\Brandenburg\Role;

class RolesTest extends TestCase
{
    public function testRolesCanBeCreated()
    {
        $this->createRoles();

        $this->assertSame('editor', Role::first()->slug);
        $this->assertSame('Contributor', Role::find(2)->name);
    }

    public function testRolesCanBeAssigned()
    {
        $this->createRoles();

        User::first()->assignRole('editor');

        $this->assertSame(1, User::first()->roles()->where('slug', 'editor')->count());
    }

    public function testRolesCanBeRemoved()
    {
        $this->createRoles();

        User::first()->assignRole('editor');
        $this->assertSame(1, User::first()->roles()->where('slug', 'editor')->count());

        User::first()->removeRole('editor');
        $this->assertSame(0, User::first()->roles()->where('slug', 'editor')->count());
    }

    public function testRolesCanBeSynced()
    {
        $this->createRoles();

        User::first()->assignRole('editor');
        User::first()->setRolesById([2]);

        $this->assertSame(1, User::first()->roles()->where('slug', 'contributor')->count());
        $this->assertSame(0, User::first()->roles()->where('slug', 'editor')->count());
    }

    private function createRoles()
    {
        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
        ]);

        Role::create([
            'name' => 'Contributor',
            'slug' => 'contributor',
        ]);
    }
}
