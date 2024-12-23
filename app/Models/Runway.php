<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Runway extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $guarded = [];


    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function userBalance(): HasMany
    {
        return $this->hasMany(UserBalance::class);
    }


    protected static function booted(): void
    {
        static::creating(function (Runway $runway) {
            $runway->user_id = auth()->id();
        });

        static::addGlobalScope(function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

}
