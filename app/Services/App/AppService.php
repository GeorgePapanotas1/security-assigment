<?php

namespace App\Services\App;

use Carbon\Carbon;

class AppService
{
    public function getPasswordSince(){
        $password_since = auth()->user()->password_since;
        if(!$password_since){
            $password_since = auth()->user()->created_at;
        }
        return $password_since->diffInDays(Carbon::now());
    }
}
