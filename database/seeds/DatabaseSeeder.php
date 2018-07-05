<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\BaseRole::class, 25)->create()->each(function($u) {
            $u->users()->saveMany(factory(App\Model\BaseAdmin::class, 10)->make());
        });
    }
}
