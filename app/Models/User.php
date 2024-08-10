<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'firstname',
        'lastname',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function teacher() 
    {
       return $this->hasOne(Teacher::class);     
    }

    public function purchasedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_purchaes', 'user_id', 'course_id');
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    // A user can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // A user can have many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
