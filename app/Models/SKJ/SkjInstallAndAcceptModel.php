<?php

namespace App\Models\SKJ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkjInstallAndAcceptModel extends Model
{
    use SoftDeletes;

    protected $table = 'skj_install_and_accept';
}
