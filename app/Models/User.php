<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasHashIdAttribute;
use Vinkla\Hashids\Facades\Hashids;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasHashIdAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url'
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'links',
    ];

    protected $appends = [
        'hash_id',
    ];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getHashIdAttribute()
    {
        $len = strlen(get_class($this));
        if (strlen(get_class($this)) > 99) {
            $len = 99;
        }
        return Hashids::encode($this->id . sprintf('%02d', $len));
    }
}
