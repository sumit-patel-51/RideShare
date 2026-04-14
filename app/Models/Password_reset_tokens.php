<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\table;

class Password_reset_tokens extends Model
{
       protected $table = 'passwort_reset_tokens'; 
}
