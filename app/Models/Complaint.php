<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'nature',
        'title',
        'category',
        'member_id',
        'date',
        'document',
        'status',
        'note',
        'parent_id',
    ];

    /**
     * Get the Member associated with the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id');
    }

    /**
     * Get the ComplaintCategory associated with the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ComplaintCategory()
    {
        return $this->hasOne(ComplaintCategory::class, 'id', 'category');
    }

    public static $status = [
        'Open' => 'Open',
        'Closed' => 'Closed',
        'On Hold' => 'On Hold',
        'Scheduled' => 'Scheduled',
        'Completed' => 'Completed',
        'Under Review' => 'Under Review',
    ];
}
