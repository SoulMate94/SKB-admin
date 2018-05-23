<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SKB\Master\SkbMasterVerifyModel;

class SkbUsersModel extends Model
{
    use SoftDeletes;

    protected $table = 'skb_users';
    protected $fillable = ['username', 'password', 'username', 'nickname',];

    public function masterVerify()
    {
        return $this->belongsTo(SkbMasterVerifyModel::class);
    }
}
