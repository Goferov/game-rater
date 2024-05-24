<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        return view('user.list');
    }

    public function show(int $userId)
    {
        $faker = Factory::create();
        $user = [
            'id' => $userId,
            'name' => $faker->name,
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'city' => $faker->city,
            'age' => $faker->numberBetween(12, 40),
            'html' => '<b>test</b>'
        ];
        return view('user.show', [
            'user' => $user
        ]);
    }
}
