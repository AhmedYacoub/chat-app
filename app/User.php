<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'unread_messages_counter'
    ];

    /** Relations */
    public function messages()
    {
        return $this->hasMany(Message::class, 'from');
    }

    /** Mutators */
    public function getUnreadMessagesCounterAttribute()
    {
        $counter = Message::getUserMessages($this->id, false)
                ->count();

        return $this->attributes['unread_messages_counter'] = $counter;
    }

    // check if profile_image field is null or empty to give it default value
    public function getProfileImageAttribute($value)
    {
        return is_null($value) || empty($value) ? 'img/male.png' : $value;
    }
}
