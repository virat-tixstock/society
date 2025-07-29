<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_id',
        'floor_id',
        'unit_number',
        'parking',
        'area',
        'type',
        'status',
        'parent_id',
    ];

    public static $status = [
        'Unsold' => 'Unsold',
        'Occupied' => 'Occupied',
        'Available For Rent' => 'Available For Rent',
        'Rented' => 'Rented',
    ];

    /**
     * Get the Building associated with the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    /**
     * Get the Floor associated with the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Floor()
    {
        return $this->hasOne(Floor::class, 'id', 'floor_id');
    }

    /**
     * Get the Parking associated with the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Parking()
    {
        return $this->hasMany(Parking::class, 'id', 'parking');
    }
    /**
     * Get the Member associated with the Floor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Member()
    {
        return $this->hasOne(Member::class, 'unit_id', 'id');
    }
}
