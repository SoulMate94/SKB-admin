<?php

namespace App\Models\China;

use Illuminate\Database\Eloquent\Model;

class SkbAreaModel extends Model
{
    protected $table   = 'skb_area';
    public $timestamps = false;

    public function scopeProvince()
    {
        return $this->where('type', 0);
    }

    public function scopeCity()
    {
        return $this->where('type', 1);
    }

    public function scopeDistrict()
    {
        return $this->where('type', 2);
    }

    public function parent()
    {
        return $this->belongsTo(SkbAreaModel::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(SkbAreaModel::class, 'parent_id');
    }

    public function brothers()
    {
        return $this->parent->children();
    }

    public static function options($id)
    {
        if (! $self = static::find($id)) {
            return [];
        }

        return $self->brothers()->pluck('name', 'id');
    }

}