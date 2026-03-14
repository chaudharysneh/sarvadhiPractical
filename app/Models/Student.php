<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        'unique_id', 'full_name', 'parent_contact_number', 'parent_email',
        'dob', 'date_of_join', 'weekly_max_hours', 'daily_max_hours',
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'date_of_join' => 'date',
            'weekly_max_hours' => 'decimal:2',
            'daily_max_hours' => 'decimal:2',
        ];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'role_id')->where('role', 'student');
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_student')->withTimestamps();
    }

    public function teachingSessions(): BelongsToMany
    {
        return $this->belongsToMany(TeachingSession::class, 'teaching_session_student')->withTimestamps();
    }
}
