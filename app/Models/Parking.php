<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_id',
        'parent_id',
        'parking_slot',
        'vehicle_type',
        'building_id',
        'unit_id',
        'vehicle_number',
        'vehicle_model',
        'description',
    ];

    /**
     * Get the Unit associated with the Parking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
    /**
     * Get the Building associated with the Parking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    /**
     * Get the ParkingSlot associated with the Parking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ParkingSlot()
    {
        return $this->hasOne(ParkingSlot::class, 'id', 'parking_slot');
    }
}
