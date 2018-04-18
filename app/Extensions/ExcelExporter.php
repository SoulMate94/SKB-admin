<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExporter extends AbstractExporter
{
    private $title;     //导出表头字段
    private $filename;  //导出的文件名
    private $fields;    //导出的数据库中字段
    public function __construct(String $filename, Array $title, Array $fields)
    {
        parent::__construct();
        $this->filename = $filename;
        $this->title    = $title;
        $this->fields   = $fields;
    }

    public function export()
    {
        Excel::create($this->filename, function($excel) {

            $excel->sheet($this->filename, function(LaravelExcelWorksheet $sheet) {

                //设置第一行
                $sheet->row(1, $this->title);

                // 这段逻辑是从表格数据中取出需要导出的字段
                $rows = collect($this->getData())->map(function ($item) {
                    return array_only($item, $this->fields);
                });

                $sheet->rows($rows);

            });

        })->export('xls');
    }
}