<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkbServiceCateModel extends Model
{
    protected $table = 'skb_service_cate';

    protected $fillable = ['title'];

    public function after_sale_list_model(){
        return $this->hasOne(AfterSaleListModel::class, 'service_cate_id', 'id');
    }

}
