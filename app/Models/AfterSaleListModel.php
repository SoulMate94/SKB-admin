<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AfterSaleListModel extends Model
{
    protected $table = 'after_sale_list';

    protected $fillable = ['id', 'apply_name', 'apply_mobile','apply_addr', 'service_type', 'service_cate_id',
        'clean_type_id'];

    public function skb_service_cate_model(){
        return $this->belongsTo(SkbServiceCateModel::class, 'service_cate_id','id');
    }

    public function skb_clean_type_model(){
        return $this->belongsTo(SkbCleanTypeModel::class, 'clean_type_id','id');
    }
}
