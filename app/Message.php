<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['from', 'to', 'read', 'text'];

    protected $appends = [
        'sent_at'
    ];

    /**
     * Change `created_at` format and append it as `send_date`
     *
     * @return void
     */
    public function getSentAtAttribute()
    {
        return $this->attributes['sent_at'] = Carbon::parse($this->created_at)->format('M,d h:m:s A');
    }

    /** Relations */
    public function owner()
    {
        return $this->belongsTo(User::class, 'from');
    }

    /**
     * Get the messages between an authenticated user and a selected user
     *
     * @param int $id   selected user id
     * @return collection All messages between the 2 users.
     */
    public static function getMessages($id) 
    {
        return static::where('from', auth()->id())
                        ->where('to', $id)
                        ->orWhere('from', $id)
                        ->where('to', auth()->id());
    }

    /**
     * Get the messages between authenticated user and another.
     *
     * @param int $user_id
     * @param [type] $is_read
     * @return collection
     */
    public static function getUserMessages($user_id, $is_read = 0) 
    {
        return static::where('read', $is_read)
                        ->where('from', $user_id)
                        ->where('to', auth()->id());
    }


    public static function markAsRead($contact_id)
    {
        return static::where('to', auth()->id())
                        ->where('from', $contact_id)
                        ->where('read', 0)
                        ->update([
                            'read'  =>  1
                        ]);
    }
}
