<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 

class Customer extends Authenticatable
{
    protected $table = 'customers';
         protected $primaryKey= 'id';

        //  protected $casts = [
        //     'role'=>'object',
        // ];
         
        protected $guarded = [];
}
