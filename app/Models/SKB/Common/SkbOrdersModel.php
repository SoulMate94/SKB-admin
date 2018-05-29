<?php

namespace App\Models\SKB\Common;

use Illuminate\Database\Eloquent\Model;
use App\Models\SkbUsersModel as SkbUsers;

class SkbOrdersModel extends Model
{
    protected $table = 'skb_orders';

    protected $casts = [
        'product_info' => 'json',
    ];

    public function skb_user()
    {
        return $this->hasOne(SkbUsers::class,'id', 'uid');
    }
    public function skb_master()
    {
        return $this->hasOne(SkbUsers::class,'id', 'mid');
    }


    public function getAppointTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
}
