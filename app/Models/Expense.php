<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_id',
        'building_id',
        'expense_type',
        'date',
        'parent_id',
    ];

    /**
     * Get the ExpenseType associated with the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }
    public function ExpenseDetails()
    {
        return $this->hasMany(ExpenseDetail::class, 'expense_id', 'id');
    }
}
