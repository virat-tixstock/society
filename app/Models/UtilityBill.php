<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_id',
        'bill_type',
        'amount',
        'date',
        'due_date',
        'document',
        'status',
        'parent_id',
    ];

    /**
     * Get the Building associated with the UtilityBill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    /**
     * Get the BillType associated with the UtilityBill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function BillType()
    {
        return $this->hasOne(BillType::class, 'id', 'bill_type');
    }
}
