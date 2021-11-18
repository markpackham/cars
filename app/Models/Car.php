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

    // setup relationship method with Car model
    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }

    // define has many through relationship (a Many To Many)
    public function engines()
    {
        return $this->hasManyThrough(
            Engine::class,
            CarModel::class,
            'car_id', // Foreign key on CarModel table
            'model_id', // Foreign key on Engine table
        );
    }
}
