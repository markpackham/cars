<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description'];

    // hidden is good for hidding session data and passwords
    // protected $hidden = ['update_at'];

    // visable is used for white listing items, handy if outputting Json for APIs
    // protected $visable = ['name', 'founded', 'description'];
}
