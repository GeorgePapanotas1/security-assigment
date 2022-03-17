<?php

namespace App\Services\Auth;

use App\Http\Traits\ShouldLog;
use App\Models\LoginAttempts;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthService
{
    use ShouldLog;

    public function login(): String {

        $attempts = LoginAttempts::where('ip_address', request()->ip())
            ->where('successful', false)
            ->where('created_at', ">=", Carbon::now()->subMinutes(5))->count();

        if($attempts > 4 ) {
            $latest_attempt = $this->getLatestAttempt();
            if ($latest_attempt && Carbon::now()->lte($latest_attempt->created_at->addMinutes(5))) return 'too_many_attempts';
        }

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            $this->log(false);
            return '';
        } else {
            $this->log(true);
            return $token;
        }
    }

    public function me(): Authenticatable
    {
        return auth()->user();
    }

    public function logout(): void {
        auth()->logout();
    }

    public function refresh(): String {
        return auth()->refresh();
    }

    public function getLatestAttempt(): LoginAttempts {
        return LoginAttempts::where('ip_address', request()->ip())
            ->where('successful', false)
            ->where('created_at', ">=", Carbon::now()->subMinutes(5))
            ->latest()
            ->first();
    }
}
