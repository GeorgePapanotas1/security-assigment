<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginAttempts extends Model
{
    use HasFactory;

    protected $table="logging";

    protected $fillable = [
        "ip_address",
        "user_id",
        "successful"
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
