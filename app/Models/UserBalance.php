<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBalance extends Model
{
    use HasFactory;

    /**
     * @var float|mixed|null
     */

    protected $guarded = [];

    public $skipCreatingLogic = false;

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
        return $this->belongsTo(Removebg::class, 'removebg_id');
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
        static::creating(function ($model) {


            $userid = auth()->id();
            // Set the user_id only if it's not already set (useful for webhook calls)
            if (!$model->user_id) {
                $model->user_id = $model->user_id ?: $userid; // Pass `$userid` directly when necessary
            }
        });

        static::addGlobalScope(function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
