<?php

namespace App\Models\SKB\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkbArticleModel extends Model
{
    use SoftDeletes;

    protected $table = 'skb_article';
}
