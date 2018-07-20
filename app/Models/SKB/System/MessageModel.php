<?php

namespace App\Models\SKB\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageModel extends Model
{
    use SoftDeletes;

    protected $table = 'skb_message';
}