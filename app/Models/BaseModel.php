<?php

namespace App\Models;

use App\Traits\HasHashIdAttribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;

class BaseModel extends Model
{
    protected $dateFormat = 'U';
    use HasHashIdAttribute;

    protected $appends = [
        'hash_id'
    ];

    public function __construct(array $attributes = [])
    {
        if (!in_array('hash_id', $this->appends)) {
            $this->appends[] = 'hash_id';
        }
        if (method_exists(self::class, 'isRead') && !in_array('is_read', $this->appends)) {
            $this->appends[] = 'is_read';
        }

        parent::__construct($attributes);
    }

    public function scopeSearch($q, $column, $search = false)
    {
        $q->when($search != false, function ($q2) use ($search, $column) {
            foreach ($column as $key => $col) {
                if ($key == 0) {
                    $q2->where($col, 'LIKE', '%' . $search . '%');
                } else {
                    $q2->orWhere($col, 'LIKE', '%' . $search . '%');
                }
            }
        });
    }
}
