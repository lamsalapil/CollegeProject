<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $table = 'buses';
    // đối nghịch với $fillable
    protected $guarded = [

    ];

    // Display name of driver
    public function users()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function imageBus()
    {
        return $this->hasMany(ImageBus::class, 'bus_id', 'id');
    }
}
