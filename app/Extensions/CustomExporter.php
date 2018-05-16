<?php

namespace App\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;

class CustomExporter extends AbstractExporter
{
    protected $titles;
    protected $field;
    protected $filename;
    protected $sheetname;
    protected $value;
    protected $callback;
    protected $ids;

    public function __construct(
        $titles,
        $field,
        $filename = 'Filename',
        $sheetname = 'Sheetname',
        $value=[],
        $callback = null
    ) {
        parent::__construct();
        $this->titles    = $titles;
        $this->field     = $field;
        $this->filename  = $filename;
        $this->sheetname = $sheetname;
        $this->value     = $value;
        $this->callback  = $callback;
    }

    public function export()
    {
        Excel::create($this->filename, function($excel) {
            $this->ids = [];

            $excel->sheet($this->sheetname, function(LaravelExcelWorksheet $sheet) {

                $this->chunk(function ($records) use ($sheet) {

                    $rows = $records->map(function ($item) {
                        array_push($this->ids, $item->id);
                        $array = $this->set_field_format($item->toArray());
                        return array_only($array, $this->field);
                    });

                    $sheet->rows([$this->titles]);
                    $sheet->rows($rows);

                });
            });

            $callback_fun = $this->callback;
            if(is_callable($callback_fun)){
                $callback_fun($this->ids);
            }

        })->export('xls');
    }

    /**
     * 转化key值
     * 模型关联操作的会转化为
     * belongsToMany => belongs_to_many_id
     * belongsToMany => belongs_to_many_name
     * has_one       => has_one_id
     */
    public function set_field_format($data){
        $array  = [];
        $arr    = [];
        $arr1   = [];
        $arr2   = [];
        foreach ($data as $key => $value) {
            if(is_array($value)){
                if(count($value) == count($value,1)){
                    foreach ($value as $ke => $val) {
                        $arr1[$key.'_'.$ke] = $val;
                    }
                }else{
                    foreach ($value as $ke => $val) {
                        foreach ($val as $k => $v) {
                            if(!is_array($v)){
                                $arr[$key.'_'.$k][] = $val[$k];
                            }
                        }
                    }
                    foreach ($arr as $k => $v) {
                        $arr2[$k] = implode(',', $v);
                    }
                }
            }else{
                $array[$key] = $data[$key];
            }
        }
        $array = array_merge($array, $arr1, $arr2);
        $res = $this->transform_key($array);

        return $res;
    }

    //转化对应的key
    public function transform_key($array){
        foreach ($array as $key => $value) {
            if(!in_array($key, $this->field)){
                unset($array[$key]);
            }else{
                $array[$key] = $this->is_key_exists($key, $value);
            }
        }
        return $array;
    }

    //返回对应的key的value 没有设置则返回传过来的value
    public function is_key_exists($key, $value){
        if(array_key_exists($key, $this->value)){
            if(is_int($value)){
                $value = isset($this->value[$key][$value])
                    ? $value
                    : ($value > 0 ? 1 : 0);
            }
            $value   =  isset($this->value[$key][$value]) ? $this->value[$key][$value] : $value;
        }

        return $value;
    }
}
