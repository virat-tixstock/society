<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    public $fillable = [
        'building_id',
        'member_id',
        'month',
        'status',
        'parent_id',
    ];

    /**
     * Get the Member associated with the BookingFacility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }
    /**
     * Get the Building associated with the BookingFacility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }
    
    /**
     * Get all of the Details for the Maintenance
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Details()
    {
        return $this->hasMany(MaintenanceDetail::class, 'maintenance_id', 'id');
    }
}
