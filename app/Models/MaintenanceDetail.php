<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceDetail extends Model
{
    use HasFactory;
    /**
     * Get the MaintenanceType associated with the MaintenanceDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function MaintenanceType()
    {
        return $this->hasOne(MaintenanceType::class, 'id', 'type');
    }
}
