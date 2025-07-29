<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_type',
        'amount',
        'date',
        'due_date',
        'document',
        'status',
        'parent_id',
    ];

    /**
     * Get the BillType associated with the CommonBill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function BillType()
    {
        return $this->hasOne(User::class, 'id', 'bill_type');
    }
}
