<?php

namespace App\Models\SKB\Master;

use Illuminate\Database\Eloquent\Model;
use App\Models\SkbUsersModel as SkbUsers;

class SkbMasterVerifyModel  extends Model
{
    protected $table = 'skb_master_verify';

    protected $casts = [
        'work_area'         => 'json',
        'id_card_img'       => 'json',
        'product_type_id'   => 'json',
        'service_type_id'   => 'json',
    ];

    public function skb_user()
    {
        return $this->hasOne(SkbUsers::class,'id','mid');
    }

    public function skb_product_detail()
    {
        return $this->hasOne();
    }

    public function getServiceStaTimeAttribute($value)
    {
        return date('H:i:s',$value);
    }

    public function getServiceEndTimeAttribute($value)
    {
        return date('H:i:s',$value);
    }
}
