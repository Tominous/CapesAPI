<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new CapesAPI\Role();
        $d = new CapesAPI\Role();
        $b = new CapesAPI\Role();
        $u = new CapesAPI\Role();

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
