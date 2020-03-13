<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * 树结构转化为层级数组,支持无限级父子关系
 * 以parent_id为子节点的父节点ID字段，children为子节点数组
 * @Author xiaoxiong
 * @Datetime 2017-12-13 17:01
 * @Param $data array 树结构数组列表
 * @return array 以parent_id为下标的一级父数组
 */
function tree2array(&$res, $data, $level = 1)
{
    foreach ($data as $d) {
        $d_tmp = $d;
        unset($d_tmp['children']);
        $res[$level][$d_tmp['parent_id']][] = $d_tmp;
        if (isset($d['children'])) {
            tree2array($res, $d['children'], $level + 1);
        }
    }
}


/**
 * 查询数据分页
 * @Author xiaoxiong
 * @Datetime 2018-03-09 12:00
 * @Param $builder object 构建的builder对象
 * @Param $page int 从第几页开始
 * @Param $pageSize int 每页显示数量
 * @Param $start int 开始查询的位置
 * @return $array
 */
function page($builder, $page = 1, $pageSize = 20, $start = 0)
{
    //符合条件的总数
    $total = $builder->count();
    //分页查询
    $start = $start + (--$page) * $pageSize;
    $data = $builder->skip($start)->take($pageSize)->get();
    $thisPageNumber = count($data);
    $totalPage = ceil($total / $pageSize);
    return ['thispagenumber' => $thisPageNumber,
        'totalpage' => $totalPage,
        'data' => $data];
}

/*
 * 实例化module类
 * @param module 逻辑类名
 * @param userinfo 当前登录者信息
 *
 * @return object 实例化以后的对象
 */
function M($module, $userinfo = null)
{
    if ($userinfo && isset($userinfo->structure->detail->store->sign)) {
        $dir = dirname(__FILE__) . "/../Modules/Store/{$userinfo->structure->detail->store->sign}/{$module}.php";
        if (file_exists($dir)) {
            $module = 'Store\\' . $userinfo->structure->detail->store->sign . '\\' . $module;
        }
    }
    $class = "App\Http\Modules\\" . $module;
    return new $class();
}

/**
 * 格式化文章发布时间
 * @param $time
 * @param $precise string 精确度（d-天/h-时/m-分/s-秒）
 * @return false|string
 */
function formatTime($time, $precise = 'd')
{
    $t = time() - $time;
    if (empty($time) || $t < 0) {
        $res = '';
    } elseif ($t < 3600) {
        $res = floor($t / 60) . "分钟前";
    } elseif ($t >= 3600 && $t < 86400) {
        $res = floor($t / 3600) . "小时前";
    } elseif ($t >= 86400 && $t < 864000) {
        $res = floor($t / 86400) . "天前";
    } else {
        switch ($precise) {
            case 'h':
                $res = date('Y-m-d H', $time);
                break;
            case 'm':
                $res = date('Y-m-d H:i', $time);
                break;
            case 's':
                $res = date('Y-m-d H:i:s', $time);
                break;
            default:
                $res = date('Y-m-d', $time);
                break;
        }
    }
    return $res;
}

/**
 * 格式化未来的时间
 * @param $time
 * @param $precise string 精确度（d-天/h-时/m-分/s-秒）
 * @return false|string
 */
function formatTimeAfter($time, $precise = 'd')
{
    $t = $time-time(); 
    if (empty($time) || $t < 0) {
        $res = date('Y-m-d',$time);
    } elseif ($t < 3600) {
        $res = floor($t / 60) . "分钟后";
    } elseif ($t >= 3600 && $t < 86400) {
        $res = floor($t / 3600) . "小时后";
    } elseif ($t >= 86400 && $t < 864000) {
        $res = floor($t / 86400) . "天后";
    } else {
        switch ($precise) {
            case 'h':
                $res = date('Y-m-d H', $time);
                break;
            case 'm':
                $res = date('Y-m-d H:i', $time);
                break;
            case 's':
                $res = date('Y-m-d H:i:s', $time);
                break;
            default:
                $res = date('Y-m-d', $time);
                break;
        }
    }
    return $res;
}

/**
 * 整理日期
 * @param $date
 * @return string
 */
function formatDate($d)
{
    $date = strtotime($d);
    switch ($date) {
        case $date == strtotime(date('Y-m-d')):
            $res = '今天';
            break;
        case $date == strtotime(date('Y-m-d', strtotime('-1 day'))):
            $res = '昨天';
            break;
        case $date == strtotime(date('Y-m-d', strtotime('-2 days'))):
            $res = '前天';
            break;
        default:
            $res = $d;
            break;
    }
    return $res;
}

/**
 * 无限级分类
 * @param $items
 * @return array
 */
function getTree($items)
{
    $tree = array(); //格式化好的树
    foreach ($items as $item) {
        if (isset($items[$item['parent_id']])) {
            $items[$item['parent_id']]['children'][] = &$items[$item['id']];
        } else {
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}

/**
 * 获取周的开始和结束
 * @param $time
 * @return string
 */
function week($time){
    $first = 1;
    if(is_numeric($time)){
        $time = date('Y-m-d');
    }
    $w = date('w', strtotime($time));
    $start = date('Y-m-d', strtotime("$time -".($w ? $w - $first : 6).' days'))." 00:00:00";
    $end   = date('Y-m-d',strtotime("$start +6 days"))." 23:59:59";
    return [$start,$end];
}
/**
 * 获取月的开始和结束
 * @param $time
 * @return string
 */
function monthly($time){
    if(!is_numeric($time)){
        $time = strtotime($time);
    }
    $start = date('Y-m-01', $time)." 00:00:00";
    $end   = date('Y-m-d',strtotime("$start +1 month -1 days"))." 23:59:59";
    return [$start,$end];
}
/**
 * 获取月的数量
 * @param $time
 * @return string
 */
function getMonthNum($date1, $date2 ,$tags='-')
{
    $date1 = explode($tags,date("Y-m-d",$date1));
    $date2 = explode($tags,date("Y-m-d",$date2));
    return abs($date1[0] - $date2[0]) * 12 - $date2[1] + abs($date1[1])+1;
}
