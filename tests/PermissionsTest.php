<?php

namespace Silvanite\Brandenburg\Test;

use Carbon\Carbon;
use Silvanite\Brandenburg\Role;
use Silvanite\Brandenburg\Permission;

class PermissionsTest extends TestCase
{
    public function testPermissionsCanBeAssigned()
    {
        $this->createRolesAndAssignPermissions();

        Role::first()->grant('articles_publish');

        $this->assertContains('articles_publish', Role::first()->permissions);
    }

    public function testPermissionsCanBeRevoked()
    {
        $this->createRolesAndAssignPermissions();

        Role::first()->setPermissions([
            'articles_publish',
            'articles_draft',
        ]);

        $this->assertContains('articles_draft', Role::first()->permissions);

        Role::first()->revoke('articles_draft');

        $this->assertNotContains('articles_draft', Role::first()->permissions);
    }

    public function testPermissionsGrantAccess()
    {
        $this->createRolesAndAssignPermissions();

        $this->assertTrue(User::first()->can('articles_publish'));
        $this->assertTrue(User::find(2)->can('articles_draft'));
    }

    public function testPermissionsDenyAccess()
    {
        $this->createRolesAndAssignPermissions();

        $this->assertTrue(User::find(2)->cannot('articles_publish'));
    }

    private function createRolesAndAssignPermissions()
    {
        Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
        ])->grant('articles_publish');

        Role::create([
            'name' => 'Contributor',
            'slug' => 'contributor',
        ]);

        User::first()->assignRole('editor');
        User::find(2)->assignRole('contributor');
    }
}
