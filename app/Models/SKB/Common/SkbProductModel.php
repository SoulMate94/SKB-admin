<?php

namespace App\Models\SKB\Common;

use Illuminate\Database\Eloquent\Model;
use App\Models\SKB\Common\SkbProductCateModel;

class SkbProductModel extends Model
{
    protected $table = 'skb_product';

    public function skb_product_cate()
    {
        return $this->hasOne(SkbProductCateModel::class,'id', 'product_cate_id');
    }

}
