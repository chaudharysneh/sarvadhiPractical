<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionDocument extends Model
{
    protected $fillable = ['teaching_session_id', 'file_name', 'file_path'];

    public function teachingSession(): BelongsTo
    {
        return $this->belongsTo(TeachingSession::class);
    }
}
