<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_name',
        'contact_person',
        'phone_number',
        'email',
        'address',
        'student_count',
        'requested_date',
        'additional_notes',
        'status',
        'rejection_reason',
    ];

    protected $casts = [
        'requested_date' => 'date',
    ];

    /**
     * Get the user that owns the food request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
