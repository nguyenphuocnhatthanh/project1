<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
         TestDummy::times(20)->create('App\Project');
    }
}
