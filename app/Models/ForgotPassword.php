<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    protected $table = 'forgotpassword';
    protected $fillable = ['id', 'email', 'code'];
}
