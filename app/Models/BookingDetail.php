<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;
    /**
     * Get the Facility associated with the BookingDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Facility()
    {
        return $this->hasOne(Facility::class, 'id', 'facility');
    }
}
