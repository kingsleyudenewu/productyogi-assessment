<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'content',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearchPost(Builder $query, Request $request): Builder
    {
        return $query->orderBy('created_at', 'desc')
            ->when($request->has('title'), function($query) use ($request) {
                return $query->where('title', 'like', "%{$request->title}%");
            })
            ->when($request->has('content'), function($query) use ($request) {
                return $query->where('content', 'like', "%{$request->content}%");
            });
    }
}
