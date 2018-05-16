<?php

namespace App\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
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
            $excel->sheet($this->filename, function($sheet) {
                // 这段逻辑是从表格数据中取出需要导出的字段
                $head = $this->title;
                $body = $this->fields;


                //设置每一栏的宽度
                $a = [10, 0];
                $b = [20, 0];
                $c = [30, 0];

                $sheet->setSize([
                    'B1'=>$a,
                    'C1'=>$a,
                    'D1'=>$c,
                    'E1'=>$a,
                    'F1'=>$a,
                    'G1'=>$a,
                    'H1'=>$b,
                    'I1'=>$b,
                    'J1'=>$b,
                    'K1'=>$b,
                    'L1'=>$c,
                ]);

                $bodyRows = collect($this->getData())->map(function ($item)use($body) {
                    foreach ($body as $keyName){
                        $arr[] = array_get($item, $keyName);
                    }
                    return $arr;
                });

                $rows = collect([$head])->merge($bodyRows);
                $sheet->rows($rows);
            });
        })->export('xls')->setSize(30);
    }
}