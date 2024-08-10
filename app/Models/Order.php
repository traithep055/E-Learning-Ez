<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // An order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An order belongs to a package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
