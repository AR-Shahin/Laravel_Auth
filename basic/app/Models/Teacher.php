<?php

namespace App\Models;

use App\Notifications\AdminVerifyNotification;
use App\Notifications\TeacherVerifyNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function setPasswordAttribute($v)
    {
        // $v = 'password';
        $this->attributes['password'] = bcrypt($v);
    }


    public function sendEmailVerificationNotification()
    {
        info('notify teacher');
        $this->notify(new TeacherVerifyNotification);
    }
}
