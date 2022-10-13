<?php

namespace App\Actions;

use App\Actions\Contracts\ActionAbleContract;
use App\Actions\Contracts\ActionContract;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction implements ActionAbleContract
{

    public function handle(array $data, ?\Closure $closure = null)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $data['user'] = $user;

        return $closure ? $closure($data) : $user;
    }
}
