<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    // create function that return users
    public function index($name)
    {
        $users = [
            [
                'name' => 'ahmed',
                'age' => 22,
                'role' => 'admin',
            ],
            [
                'name' => 'mohamed',
                'age' => 22,
                'role' => 'admin',
            ],
            [
                'name' => 'ebrahim',
                'age' => 22,
                'role' => 'admin',
            ],

        ];
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['name'] == $name) {
                return response()->json([
                    'users' => $users[$i],
                ]);
            }
        }

    }

    //
}
