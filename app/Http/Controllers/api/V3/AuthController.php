<?php

namespace App\Http\Controllers\api\V3;

use App\Http\Controllers\Controller;
use App\Http\Traits\ShouldLog;
use App\Services\Auth\AuthService;
use Carbon\Carbon;
use http\Cookie;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\False_;

class AuthController extends Controller
{
    use ShouldLog;

    protected $authService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authService = new AuthService();
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {

        $token = $this->authService->login();

        if (!$token) {
            return response()->json(['error' => 'Unauthorized', 'type'=>'invalid', 'retries' => $this->authService->getLastAttemptCount()], 401);
        }

        if ($token === 'too_many_attempts') {
            $latest_attempt = $this->authService->getLatestAttempt();
            $secs = Carbon::now()->diffInSeconds($latest_attempt->created_at->addMinutes(5));
            return response()->json(['error' => "Too many attempts. Retry in $secs seconds.", 'type'=>'blocked'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {

        return response()->json($this->authService->me());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->authService->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->authService->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'type'=>'success'
        ]);
    }
}
