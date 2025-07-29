<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFacility extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'building_id',
        'member_id',
        'address',
        'facility_id',
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
     * Get the Facility associated with the BookingFacility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Facility()
    {
        return $this->hasOne(Facility::class, 'id', 'facility_id');
    }
    /**
     * Get the BookingDetail associated with the BookingFacility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function BookingDetail()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id', 'id');
    }


}
