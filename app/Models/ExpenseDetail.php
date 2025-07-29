<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_id',
        'date',
        'amount',
        'bill_type',
        'parent_id',
    ];
    /**
     * Get the BillType associated with the ExpenseDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ExpenseType()
    {
        return $this->hasOne(ExpenseType::class, 'id', 'bill_type');
    }
}
