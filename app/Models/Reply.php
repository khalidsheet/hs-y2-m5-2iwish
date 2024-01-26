<?php

namespace App\Models;

use App\Jobs\ReplyCreated;
use App\Jobs\SendReplyCreatedEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'feedback_id',
        'message',
        'is_public',
        'is_reported',
    ];

    public static function booted(): void
    {
        static::created(function ($reply) {
            event(new ReplyCreated($reply));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeIsShowable(Builder $builder): Builder
    {
        return $builder->where('is_public', true)->where('is_reported', false);
    }

    public function feedback(): BelongsTo
    {
        return $this->belongsTo(Feedback::class);
    }
}
