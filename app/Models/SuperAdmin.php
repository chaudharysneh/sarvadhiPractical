<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SuperAdmin extends Model
{
    protected $fillable = ['email', 'full_name'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'role_id')->where('role', 'super_admin');
    }
}
