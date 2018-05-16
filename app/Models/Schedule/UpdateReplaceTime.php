<?php

namespace App\Models\Schedule;

use Illuminate\Support\Facades\DB;

class UpdateReplaceTime
{
    public function UpdateTime()
    {
        // TODO
        DB::table('after_sale_list')->where('filter_level_1_countdown', '>', 0)->decrement('filter_level_1_countdown', 1);
        DB::table('after_sale_list')->where('filter_level_2_countdown', '>', 0)->decrement('filter_level_2_countdown', 1);
        DB::table('after_sale_list')->where('filter_level_3_countdown', '>', 0)->decrement('filter_level_3_countdown', 1);
        DB::table('after_sale_list')->where('filter_level_4_countdown', '>', 0)->decrement('filter_level_4_countdown', 1);
        DB::table('after_sale_list')->where('filter_level_5_countdown', '>', 0)->decrement('filter_level_5_countdown', 1);

        return true;
    }

}