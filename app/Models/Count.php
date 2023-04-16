<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Count extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'type',
        'date',
        'foreign_key_id',
        'created_at'
    ];

    public function link()
    {
        return $this->belongsTo(Link::class, 'foreign_key_id',  'id');
    }

    public function getLinkNameAttribute()
    {
        return $this->link->name;
    }
}
