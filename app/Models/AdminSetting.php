<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'admin_name',
        'admin_address',
        'admin_phone',
        'admin_email',
        'city',
        'postal_code',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
