<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'email',
        'phone',
        'car_model_id',
    ];

    public function car_model()
    {
        return $this->belongsTo(CarModel::class);
    }
}
