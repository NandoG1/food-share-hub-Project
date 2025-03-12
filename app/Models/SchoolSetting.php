<?php

// app/Models/SchoolSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'school_name',
        'school_address',
        'school_phone',
        'school_email',
        'principal_name',
        'school_level',
        'city',
        'postal_code',
        'program_coordinator',
        'coordinator_phone',
        'coordinator_email',
    ];

    /**
     * Get the user that owns the school settings.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
