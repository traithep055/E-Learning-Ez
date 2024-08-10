<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    // A package can have many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // A package can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
