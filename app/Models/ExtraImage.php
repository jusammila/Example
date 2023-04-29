<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraImage extends Model
{
    protected $table = 'extra_images';
    protected $primaryKey= 'id';

   //  protected $casts = [
   //     'role'=>'object',
   // ];
    
   protected $guarded = [];
}
