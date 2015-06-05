<?php
$role = ['manage', 'member'];
$factory('App\User', [
    'name' => $faker->name,
    'email' => $faker->email,
    'password' => \Hash::make('abcde'),
    'role' => $role[array_rand($role, 1)]
]);

$factory('App\Task', [
    'name' => $faker->name,
    'user_id' => rand(1, 20),
    'description' => $faker->text(),
    'status' => rand(0, 1),
    'project_id' => 3
]);

$factory('App\Project', [
    'name' => $faker->name,
    'description' => $faker->text()
]);

$factory('App\Module', [
    'name' => $faker->name,
    'description' => $faker->text()
]);
