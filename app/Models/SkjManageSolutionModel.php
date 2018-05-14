<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkjManageSolutionModel extends Model
{
    use SoftDeletes;

    protected $table = 'skj_manage_solution';

    protected $primaryKey = 'id';

    public function has_many_provide()
    {
        return $this->hasMany(SkjManageProvideSolutionModel::class, 'suggestion_id');
    }

    public function getInstallTimeAttribute($value)
    {
        return date('Y-m-d H:i:s',$value);
    }
}
