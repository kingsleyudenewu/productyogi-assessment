<?php

namespace App\Actions;

use App\Models\User;

class LoginAction
{
    /**
     * Generate a new token for the user.
     *
     * @param array $data
     *
     * @return array
     */
    public function execute(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        return (new GenerateTokenAction())->execute($user);
    }
}
