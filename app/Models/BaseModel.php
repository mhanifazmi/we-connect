<?php

namespace App\Models;

use App\Traits\HasHashIdAttribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;

class BaseModel extends Model
{
    protected $dateFormat = 'U';

    protected $dates = [
        'created_at',
        'update_at',
    ];
}
