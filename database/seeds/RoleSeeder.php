<?php

use Illuminate\Database\Seeder;
use Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Role();
        $d = new Role();
        $b = new Role();
        $u = new Role();

        $a->name = 'admin';
        $d->name = 'developer';
        $b->name = 'banned';
        $u->name = 'unverified';

        $a->display_name = 'Administrator';
        $d->display_name = 'Developer';
        $b->display_name = 'Banned';
        $u->display_name = 'Unverified';

        $a->save();
        $d->save();
        $b->save();
        $u->save();
    }
}
