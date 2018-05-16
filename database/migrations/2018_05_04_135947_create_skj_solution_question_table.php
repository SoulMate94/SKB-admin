<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkjSolutionQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skj_solution_question', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->comment('用户姓名');
            $table->string('mobile')->comment('联系方式');
            $table->string('address')->comment('地址');
            $table->tinyInteger('user_demand')->comment('用户需求:1,净水解决方案;2,水路传输解决方案;3,智能卫浴解决方案;4,软净水一体机解决方案;5,全无水质管理解决方案');
            $table->tinyInteger('house_type')->comment('房屋类型:1,套房;2,别墅;3,民房');
            $table->tinyInteger('water_pipe')->comment('原有水管材质:1,不锈钢;2,塑料;3,镀锌管;4其它');
            $table->boolean('is_power_outlet')->comment('电源插座');
            $table->integer('install_floor')->comment('安装楼层');
            $table->boolean('elevator')->comment('是否有电梯');
            $table->float('elevator_width')->comment('宽度')->nullable();
            $table->boolean('is_take_picture')->comment('安装位置拍照');
            $table->boolean('wash_basin_reservation')->comment('洗手盆预留口');
            $table->tinyInteger('wash_basin_material')->comment('洗手盆材质:1,不锈钢;2,石料;3,其它');
            $table->float('water_pressure_flowmeter')->comment('水压流量检测')->nullable();
            $table->float('TDS_test_pen')->comment('TDS测试')->nullable();
            $table->float('PHP_test_pen')->comment('PH测试')->nullable();
            $table->tinyInteger('cohesive_unit')->comment('衔接单位:1,业主;2,公司');
            $table->tinyInteger('water_inlet_pipe_size')->comment('入水口管径:1,4分;2,6分;3,1寸');
            $table->tinyInteger('water_inlet_material')->comment('入水口管材质:1,不锈钢;2,PPR;3,镀锌管');
            $table->boolean('is_floor_warm')->comment('地暖');
            $table->boolean('is_drawing')->comment('施工图纸');
            $table->tinyInteger('heater')->comment('热水器:1,空气能;2,太阳能;3,天然气');
            $table->boolean('is_backwater')->comment('是否加回水');
            $table->string('house_measurement')->comment('户型测量');
            $table->float('monthly_water')->comment('日均水量');
            $table->integer('use_water_people')->comment('用水人数');
            $table->float('building_height')->comment('建筑层高');
            $table->string('is_install_position')->comment('安装位置,如果为空,表示平台用户')->nullable();
            $table->boolean('is_power_supply')->comment('电源');
            $table->integer('bathtub')->comment('浴缸,如果为0,表示没有')->nullable();
            $table->float('long')->comment('长');
            $table->float('width')->comment('宽');
            $table->float('height')->comment('高');
            $table->boolean('is_network')->comment('网络');
            $table->tinyInteger('shower')->comment('沐浴器:1,预埋式;2,普通');
            $table->text('remark')->comment('其他信息备注')->nullable();
            $table->tinyInteger('service_score')->comment('服务满意度:1,非常好;2,好;3,一般;4,不好')->nullable();
            $table->boolean('is_del')->comment('是否删除')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skj_solution_question');
    }
}
