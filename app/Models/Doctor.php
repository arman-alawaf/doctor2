<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'specialty_id',
        'license_number',
        'experience_years',
        'bio',
        'image',
        'phone',
        'address',
        'education',
        'hospital_clinic_name',
        'working_hours',
        'languages',
        'certifications',
        'consultation_fee',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'consultation_fee' => 'decimal:2',
        ];
    }

    /**
     * Get the user that owns the doctor profile
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the specialty of the doctor
     */
    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    /**
     * Get appointments for this doctor
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get posts for this doctor
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
