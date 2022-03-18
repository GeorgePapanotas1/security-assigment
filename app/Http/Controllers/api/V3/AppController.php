<?php

namespace App\Http\Controllers\api\V3;

use App\Http\Controllers\Controller;
use App\Services\App\AppService;
use Illuminate\Http\Request;

class AppController extends Controller
{
    protected $appService;
    public function __construct()
    {
        $this->appService = new AppService();
        $this->middleware('auth:api');
    }

    public function password(){
        $days = $this->appService->getPasswordSince();

        if($days > 30) {
            $result = ['result' => "$days passed since you changed your password. To keep your account safe, please consider changing it."];
        }else{
            $change_in = 30 - $days;
            $result = ['result' => "$days passed since the last password change. Please consider changing it in $change_in days to ensure protection."];

        }
        return response()->json($result);
    }
}
