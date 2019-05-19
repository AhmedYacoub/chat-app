<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['from', 'to', 'text'];

    protected $appends = [
        'send_date'
    ];

    public function getSendDateAttribute()
    {
        return $this->attributes['send_date'] = Carbon::parse($this->created_at)->format('M,d h:m:s A');
    }

    /** Relations */
    public function user()
    {
        return $this->belongsTo(User::class, 'to');
    }

    public static function getMessages($id) 
    {
        return static::where('from', auth()->id())
                        ->where('to', $id)
                        ->orWhere('from', $id)
                        ->where('to', auth()->id());
    }
}
