<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $guarded=[];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function imagegenerations(): HasMany
    {
        return $this->hasMany(ImageGeneration::class);
    }

    public function flux(): HasMany{
        return $this->hasMany(Flux::class);
    }

    public function runway(): HasMany{
        return $this->hasMany(Runway::class);
    }

    public function midjourney(): HasMany
    {
        return $this->hasMany(Midjourney::class);
    }

    public function removebg(): HasMany
    {
        return $this->hasMany(Removebg::class);
    }

    public function userbalanace(): HasMany{
        return $this->hasMany(UserBalance::class);
    }

    public function balance(): HasMany{
        return $this->hasMany(Balance::class);
    }



}
