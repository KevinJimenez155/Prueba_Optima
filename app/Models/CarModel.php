<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'car_id'
    ];

    public function car(){
        return $this->belongsTo(Car::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
