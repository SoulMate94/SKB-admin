<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkbArticleModel extends Model
{
    use SoftDeletes;

    protected $table = 'skb_article';
}
