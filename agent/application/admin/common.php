<?php
use think\Db;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
 * 将字符解析成数组
 * @param $str
 */
function parseParams($str)
{
    $arrParams = [];
    parse_str(html_entity_decode(urldecode($str)), $arrParams);
    return $arrParams;
}


/**
 * 子孙树 用于菜单整理
 * @param $param
 * @param int $pid
 */
function subTree($param, $pid = 0)
{
    static $res = [];
    foreach($param as $key=>$vo){

        if( $pid == $vo['pid'] ){
            $res[] = $vo;
            subTree($param, $vo['id']);
        }
    }

    return $res;
}


/**
 * 记录日志
 * @param  [type] $uid         [用户id]
 * @param  [type] $username    [用户名]
 * @param  [type] $description [描述]
 * @param  [type] $status      [状态]
 * @return [type]              [description]
 */
function writelog($uid,$username,$description,$status)
{
    $data['admin_id'] = $uid;
    $data['admin_name'] = $username;
    $data['description'] = $description;
    $data['status'] = $status;
    $data['ip'] = request()->ip();
    $data['add_time'] = time();
    $log = Db::name('Log')->insert($data);

}


/**
 * 整理菜单树方法
 * @param $param
 * @return array
 */
function prepareMenu($param)
{
    $parent = []; //父类
    $child = [];  //子类

    foreach($param as $key=>$vo){

        if($vo['pid'] == 0){
            $vo['href'] = '#';
            $parent[] = $vo;
        }else{
            $vo['href'] = url($vo['name']); //跳转地址
            $child[] = $vo;
        }
    }

    foreach($parent as $key=>$vo){
        foreach($child as $k=>$v){

            if($v['pid'] == $vo['id']){
                $parent[$key]['child'][] = $v;
            }
        }
    }
    unset($child);
    return $parent;
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }
    return $size . $delimiter . $units[$i];
}

/**
 * 导数据
 */
function dc_execl($title,$headers,$datas,$filename){
    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();
    //设置工作表标题名称
    $worksheet->setTitle($title);
    //表头
    //设置单元格内容
    $worksheet->setCellValueByColumnAndRow(1, 1, $title);
    foreach ($headers as $key=>$v){
        $worksheet->setCellValueByColumnAndRow($key+1, 2, $v);
    }
//    $worksheet->setCellValueByColumnAndRow(2, 2, '注册人数');
//    $worksheet->setCellValueByColumnAndRow(3, 2, '活跃用户数');
//    $worksheet->setCellValueByColumnAndRow(4, 2, '玩牌用户数');
//    $worksheet->setCellValueByColumnAndRow(5, 2, '玩牌总局数');
//    $worksheet->setCellValueByColumnAndRow(6, 2, '玩牌小局数');
//    $worksheet->setCellValueByColumnAndRow(7, 2, '钻石消耗');
//    $worksheet->setCellValueByColumnAndRow(8, 2, '钻石剩余');

//合并单元格
    $worksheet->mergeCells('A1:H1');

    $styleArray = [
        'font' => [
            'bold' => true
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
    ];
//设置单元格样式
    $worksheet->getStyle('A1')->applyFromArray($styleArray)->getFont()->setSize(28);

    $worksheet->getStyle('A2:H2')->applyFromArray($styleArray)->getFont()->setSize(12);
    ;

    $len = count($datas);
    $j = 0;
    for ($i=0; $i < $len; $i++) {
        $j = $i + 3; //从表格第3行开始

        $worksheet->setCellValueByColumnAndRow(1, $j, $datas[$i]['tdate']);
        $worksheet->setCellValueByColumnAndRow(2, $j, $datas[$i]['xzdata']);
        $worksheet->setCellValueByColumnAndRow(3, $j, $datas[$i]['hydata']);
        $worksheet->setCellValueByColumnAndRow(4, $j, $datas[$i]['djdata']);
        $worksheet->setCellValueByColumnAndRow(5, $j, $datas[$i]['zjs']);
        $worksheet->setCellValueByColumnAndRow(6, $j, $datas[$i]['xjs']);
        $worksheet->setCellValueByColumnAndRow(7, $j, $datas[$i]['card_xh']);
        $worksheet->setCellValueByColumnAndRow(8, $j, $datas[$i]['card_sy']);
    }

    $styleArrayBody = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '666666'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
    ];
    $total_jzInfo = $len + 2;
//添加所有边框/居中
    $worksheet->getStyle('A1:H'.$total_jzInfo)->applyFromArray($styleArrayBody);

    $filename = $filename.".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

}


