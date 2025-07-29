<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'image',
        'building_id',
        'floor_id',
        'unit_id',
        'family_details',
        'parent_id',
    ];

    /**
     * Get the Building associated with the Floor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    /**
     * Get the Floor associated with the Floor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Floor()
    {
        return $this->hasOne(Floor::class, 'id', 'floor_id');
    }

    /**
     * Get the Unit associated with the Floor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
