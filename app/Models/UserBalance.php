<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBalance extends Model
{
    use HasFactory;



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function flux(): BelongsTo
    {
        return $this->belongsTo(Flux::class);
    }

    public function removebg(): BelongsTo
    {
        return $this->belongsTo(Removebg::class,'removebg_id');
    }

    public function runway(): BelongsTo
    {
        return $this->belongsTo(Runway::class);
    }

    public function midjourney(): BelongsTo
    {
        return $this->belongsTo(Midjourney::class);
    }

    protected static function booted(): void
    {
        static::creating(function (UserBalance $balance) {
            $balance->user_id = auth()->id();
        });

        static::addGlobalScope(function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
