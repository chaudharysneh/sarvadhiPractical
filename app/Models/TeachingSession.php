<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeachingSession extends Model
{
    protected $fillable = ['teacher_id', 'start_time', 'end_time', 'notes'];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'teaching_session_student')->withTimestamps();
    }

    public function documents(): HasMany
    {
        return $this->hasMany(SessionDocument::class, 'teaching_session_id');
    }

    public function getDurationHoursAttribute(): float
    {
        return round($this->start_time->diffInMinutes($this->end_time) / 60, 2);
    }
}
