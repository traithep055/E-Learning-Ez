<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // A subscription belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A subscription belongs to a package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
