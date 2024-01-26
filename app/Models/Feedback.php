<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelLike\Traits\Likeable;

class Feedback extends Model
{
    use HasFactory, Likeable, SoftDeletes;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'is_public',
        'is_reported',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function isPublic()
    {
        return $this->is_public;
    }

    public function isPrivate()
    {
        return !$this->isPublic();
    }

    public function makePublic()
    {
        $this->is_public = true;
        $this->save();
    }

    public function makePrivate()
    {
        $this->is_public = false;
        $this->save();
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

}
