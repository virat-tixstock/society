<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_id',
        'floor_id',
        'unit_id',
        'phone_no',
        'visitor_name',
        'type',
        'visit_datetime',
        'end_datetime',
        'purpose',
        'parent_id',
    ];

    /**
     * Get the Building associated with the Visitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    /**
     * Get the Floor associated with the Visitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Floor()
    {
        return $this->hasOne(Floor::class, 'id', 'floor_id');
    }

    /**
     * Get the Unit associated with the Visitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    /**
     * Get the VisitorType associated with the Visitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function VisitorType()
    {
        return $this->hasOne(VisitorType::class, 'id', 'type');
    }
}
