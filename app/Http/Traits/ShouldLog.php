<?php

namespace App\Http\Traits;

use App\Models\LoginAttempts;
use App\Models\User;
use phpDocumentor\Reflection\Types\Boolean;

trait ShouldLog
{
    private LoginAttempts $latestLoginAttempt;

    public function log($result): int{
        $email = request(["email"]);
        $user = User::where('email', $email)->first();

        $login = [
            "ip_address" => request()->ip(),
            "user_id" => $user->id ?? null,
            "successful" => $result
        ];

        return LoginAttempts::create($login)->id;

    }

    public function logResult(int $log, $result): void {
        $this->latestLoginAttempt->result = $result;
        $this->latestLoginAttempt->save();
    }
}
