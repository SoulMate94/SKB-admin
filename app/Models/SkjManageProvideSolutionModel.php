<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkjManageProvideSolutionModel  extends Model
{

    protected $table = 'skj_manage_provide_solution';

    protected $fillable = ['product','features','quantity','unit','price'];

    public function belongsToManage()
    {
        return $this->belongsTo(SkjManageSolutionModel::class, 'suggestion_id');
    }
}
