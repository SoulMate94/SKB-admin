<?php

namespace App\Models\AfterSale;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkbCleanTypeModel extends Model
{
    use SoftDeletes;

    protected $table = 'skb_clean_type';

    protected $fillable = ['product_name'];

    public function after_sale_list_model(){
        return $this->hasMany(AfterSaleListModel::class, 'clean_type_id', 'id');
    }
}
