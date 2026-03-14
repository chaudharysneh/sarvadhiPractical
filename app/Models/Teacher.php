<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    protected $fillable = [
        'unique_id', 'email', 'full_name', 'gender', 'date_of_join', 'salary_per_hour',
    ];

    protected function casts(): array
    {
        return [
            'date_of_join' => 'date',
            'salary_per_hour' => 'decimal:2',
        ];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'role_id')->where('role', 'teacher');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'teacher_student')->withTimestamps();
    }

    public function teachingSessions(): HasMany
    {
        return $this->hasMany(TeachingSession::class, 'teacher_id');
    }
}
