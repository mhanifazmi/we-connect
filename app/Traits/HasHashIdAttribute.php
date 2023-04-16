<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasHashIdAttribute
 * @package App\Traits
 * @property string $hash_id
 */
trait HasHashIdAttribute
{
    public function getHashIdAttribute()
    {
        $len = strlen(get_class($this));
        if (strlen(get_class($this)) > 99) {
            $len = 99;
        }
        return Hashids::encode($this->id . sprintf('%02d', $len));
    }

    public function getRouteKeyName()
    {
        $key = parent::getRouteKeyName();

        return ($key == parent::getKeyName()) ? 'hash_id' : $key;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $value = self::decodeHashId($value);

        return $this->where('id', $value)->firstOrFail();
    }

    public static function decodeHashId($value)
    {
        $value = Hashids::decode($value);
        $value = reset($value);
        return substr($value, 0, -2);
    }

    public static function findByHash($hashId)
    {
        $id = self::decodeHashId($hashId);

        return self::find($id);
    }
}
