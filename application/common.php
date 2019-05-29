<?php
/**
 * FileName: common.php
 * ==============================================
 * Copy right 2016-2018
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2018/9/3 15:59
 */
// 除了 E_NOTICE，报告其他所有错误
error_reporting(E_ALL ^ E_NOTICE);

/*
*获取html指定标签的相关属性
*@param string $content 要解析HTML内容
*@param string $attr 指定要获取的标签属性
*@param string $tag  指定解析标签
*@return  array
*/

function get_html_attr_by_tag($content = "", $attr = "src", $tag = "img")
{
    $arr = [];
    $attr = explode(',', $attr);
    $tag = explode(',', $tag);
    foreach ($tag as $i => $t) {
        foreach ($attr as $a) {
            preg_match_all("/<\s*" . $t . "\s+[^>]*?" . $a . "\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i", $content, $match);
            foreach ($match[2] as $n => $m) {
                $arr[ $t ][ $n ][ $a ] = $m;
            }
        }
    }

    return $arr;//array
}

if ( ! function_exists('str2arr')) {
    /**
     * 字符串转换为数组，主要用于把分隔符调整到第二个参数
     *
     * @param  string $str  要分割的字符串
     * @param  string $glue 分割符
     *
     * @return array
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function str2arr($str, $glue = ',')
    {
        return explode($glue, $str);
    }
}
if ( ! function_exists('arr2str')) {
    /**
     * 数组转换为字符串，主要用于把分隔符调整到第二个参数
     *
     * @param  array  $arr  要连接的数组
     * @param  string $glue 分割符
     *
     * @return string
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function arr2str($arr, $glue = ',')
    {
        return implode($glue, $arr);
    }
}
if ( ! function_exists('msubstr')) {
    /**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     *
     * @param string $str     需要转换的字符串
     * @param string $start   开始位置
     * @param string $length  截取长度
     * @param string $charset 编码格式
     * @param string $suffix  截断显示字符
     *
     * @author : 永 | <chuanshuo_yongyuan@163.com>
     * @return string
     */
    function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr")) {
            $slice = mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
            if (false === $slice) {
                $slice = '';
            }
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[ $charset ], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }

        return $suffix ? $slice . '...' : $slice;
    }
}

if ( ! function_exists('list_sort_by')) {
    /**
     * 对查询结果集进行排序
     * @access public
     *
     * @param array  $list   查询结果
     * @param string $field  排序的字段名
     * @param array  $sortby 排序类型
     *                       asc正向排序 desc逆向排序 nat自然排序
     *
     * @author 永 | chuanshuo_yongyuan@163.com
     * @return array
     */
    function list_sort_by($list, $field, $sortby = 'asc')
    {
        if (is_array($list)) {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
                $refer[ $i ] = &$data[ $field ];
            switch ($sortby) {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc':// 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
                $resultSet[] = &$list[ $key ];

            return $resultSet;
        }

        return false;
    }
}
if ( ! function_exists('list_to_tree')) {
    /**
     * 把返回的数据集转换成Tree
     *
     * @param array  $list  要转换的数据集
     * @param string $pid   parent标记字段
     * @param string $level level标记字段
     *
     * @return array
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[ $data[ $pk ] ] =& $list[ $key ];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[ $pid ];
                if ($root == $parentId) {
                    $tree[] =& $list[ $key ];
                } else {
                    if (isset($refer[ $parentId ])) {
                        $parent =& $refer[ $parentId ];
                        $parent[ $child ][] =& $list[ $key ];
                    }
                }
            }
        }

        return $tree;
    }
}
if ( ! function_exists('tree_to_list')) {
    /**
     * 将list_to_tree的树还原成列表
     *
     * @param  array  $tree  原来的树
     * @param  string $child 孩子节点的键
     * @param  string $order 排序显示的键，一般是主键 升序排列
     * @param  array  $list  过渡用的中间数组，
     *
     * @return array        返回排过序的列表数组
     * @author yangweijie <yangweijiester@gmail.com>
     */
    function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array())
    {
        if (is_array($tree)) {
            foreach ($tree as $key => $value) {
                $reffer = $value;
                if (isset($reffer[ $child ])) {
                    unset($reffer[ $child ]);
                    tree_to_list($value[ $child ], $child, $order, $list);
                }
                $list[] = $reffer;
            }
            $list = list_sort_by($list, $order, $sortby = 'asc');
        }

        return $list;
    }
}
if ( ! function_exists('format_bytes')) {
    /**
     * 格式化字节大小
     *
     * @param  number $size      字节数
     * @param  string $delimiter 数字和单位分隔符
     *
     * @return string            格式化后的带单位的大小
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function format_bytes($size, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;

        return round($size, 2) . $delimiter . $units[ $i ];
    }
}
if ( ! function_exists('set_redirect_url')) {
    /**
     * 设置跳转页面URL
     * 使用函数再次封装，方便以后选择不同的存储方式（目前使用cookie存储）
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function set_redirect_url($url)
    {
        cookie('redirect_url', $url);
    }
}
if ( ! function_exists('get_redirect_url')) {
    /**
     * 获取跳转页面URL
     * @return string 跳转页URL
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function get_redirect_url()
    {
        $url = cookie('redirect_url');

        return empty($url) ? __APP__ : $url;
    }
}
if ( ! function_exists('get_url')) {
    /**
     * 获取当前页面完整URL地址
     * @return string
     * @author 永 | <chuanshuo_yongyuan@163.com>
     */
    function get_url()
    {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);

        return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
    }
}
if ( ! function_exists('time_format')) {
    /**
     * 时间戳格式化
     *
     * @param int $time
     *
     * @return string 完整的时间显示
     * @author huajie <banhuajie@163.com>
     */
    function time_format($time = null, $format = 'Y-m-d H:i:s')
    {
        $time = $time === null ? NOW_TIME : intval($time);

        return $time ? date($format, $time) : '无';
    }
}
if ( ! function_exists('create_dir_or_files')) {
    /**
     * 基于数组创建目录和文件
     *
     * @param $files
     *
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function create_dir_or_files($files)
    {
        foreach ($files as $key => $value) {
            if (substr($value, -1) == '/') {
                mkdir($value);
            } else {
                @file_put_contents($value, '');
            }
        }
    }
}
if ( ! function_exists('array_under_reset')) {
    /**
     * 返回以原数组某个值为下标的新数据
     *
     * @param array  $array
     * @param string $key
     * @param int    $type 1一维数组2二维数组
     *
     * @return array
     * @author 永 | chuanshuo_yongyuan@163.com
     */
    function array_under_reset($array, $key, $type = 1)
    {
        if (is_array($array)) {
            $tmp = array();
            foreach ($array as $v) {
                if ($type === 1) {
                    $tmp[ $v[ $key ] ] = $v;
                } elseif ($type === 2) {
                    $tmp[ $v[ $key ] ][] = $v;
                }
            }

            return $tmp;
        } else {
            return $array;
        }
    }
}

if ( ! function_exists('unique_array2d')) {
    /**
     * 二维数组去重
     *
     * @param      $array2D  需要去重的二维数组
     * @param bool $stkeep   是否保留一级数组的键名
     * @param bool $ndformat 是否保留二级数组的键名
     *
     * @return mixed
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function unique_array2d($array2D, $stkeep = false, $ndformat = true)
    {
        // 判断是否保留一级数组键 (一级数组键可以为非数字)
        if ($stkeep) $stArr = array_keys($array2D);
        // 判断是否保留二级数组键 (所有二级数组键必须相同)
        if ($ndformat) $ndArr = array_keys(end($array2D));
        //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
        foreach ($array2D as $v) {
            $v = join(",", $v);
            $temp[] = $v;
        }
        // 去掉重复的字符串,也就是重复的一维数组
        $temp = array_unique($temp);
        // 再将拆开的数组重新组装
        foreach ($temp as $k => $v) {
            if ($stkeep) $k = $stArr[ $k ];
            if ($ndformat) {
                $tempArr = explode(",", $v);
                foreach ($tempArr as $ndkey => $ndval) $output[ $k ][ $ndArr[ $ndkey ] ] = $ndval;
            } else $output[ $k ] = explode(",", $v);
        }

        return $output;
    }
}

if ( ! function_exists('priceFormat')) {
    /**
     * 价格格式化
     *
     * @param int $price
     *
     * @return string    $price_format
     */
    function priceFormat($price)
    {
        $price_format = number_format($price, 2, '.', '');

        return $price_format;
    }
}
if ( ! function_exists('getSystemYearArr')) {
    /**
     * 获得系统年份数组
     * @return array
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function getSystemYearArr()
    {
        $year_arr = array('2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020', '2021' => '2021', '2022' => '2022', '2023' => '2023', '2024' => '2024', '2025' => '2025');

        return $year_arr;
    }
}
if ( ! function_exists('getSystemMonthArr')) {
    /**
     * 获得系统月份数组
     * @return array
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function getSystemMonthArr()
    {
        $month_arr = array('1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06', '7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11', '12' => '12');

        return $month_arr;
    }
}
if ( ! function_exists('getSystemWeekArr')) {
    /**
     * 获得系统周数组
     * @return array
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function getSystemWeekArr()
    {
        $week_arr = array('1' => '周一', '2' => '周二', '3' => '周三', '4' => '周四', '5' => '周五', '6' => '周六', '7' => '周日');

        return $week_arr;
    }
}
if ( ! function_exists('getMonthLastDay')) {
    /**
     * 获取某月的最后一天
     *
     * @param $year  需要获取的年
     * @param $month 需要获取年的月
     *
     * @return false|int
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function getMonthLastDay($year, $month)
    {
        $t = mktime(0, 0, 0, $month + 1, 1, $year);
        $t = $t - 60 * 60 * 24;

        return $t;
    }
}
if ( ! function_exists('getMonthWeekArr')) {
    /**
     * 获得系统某月的周数组，第一周不足的需要补足
     *
     * @param $current_year  需要获取的年
     * @param $current_month 需要获取的月份
     *
     * @return array
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function getMonthWeekArr($current_year, $current_month)
    {
        //该月第一天
        $firstday = strtotime($current_year . '-' . $current_month . '-01');
        //该月的第一周有几天
        $firstweekday = (7 - date('N', $firstday) + 1);
        //计算该月第一个周一的时间
        $starttime = $firstday - 3600 * 24 * (7 - $firstweekday);
        //该月的最后一天
        $lastday = strtotime($current_year . '-' . $current_month . '-01' . " +1 month -1 day");
        //该月的最后一周有几天
        $lastweekday = date('N', $lastday);
        //该月的最后一个周末的时间
        $endtime = $lastday - 3600 * 24 * $lastweekday;
        $step = 3600 * 24 * 7;//步长值
        $week_arr = array();
        for ($i = $starttime; $i < $endtime; $i = $i + 3600 * 24 * 7) {
            $week_arr[] = array('key' => date('Y-m-d', $i) . '|' . date('Y-m-d', $i + 3600 * 24 * 6), 'val' => date('Y-m-d', $i) . '~' . date('Y-m-d', $i + 3600 * 24 * 6));
        }

        return $week_arr;
    }
}
if ( ! function_exists('getWeek_SdateAndEdate')) {
    /**
     * 获取本周的开始时间和结束时间
     *
     * @param $current_time
     *
     * @return mixed
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function getWeek_SdateAndEdate($current_time)
    {
        $current_time = strtotime(date('Y-m-d', $current_time));
        $return_arr['sdate'] = date('Y-m-d', $current_time - 86400 * (date('N', $current_time) - 1));
        $return_arr['edate'] = date('Y-m-d', $current_time + 86400 * (7 - date('N', $current_time)));

        return $return_arr;
    }
}
if ( ! function_exists('get_client_ip')) {
    /**
     * 获取用户访问IP
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function get_client_ip()
    {
        return request()->ip();
    }
}
if ( ! function_exists('in_array_case')) {
    /**
     * 不区分大小写的in_array实现
     *
     * @param $value
     * @param $array
     *
     * @return bool
     * @author: 永 | <chuanshuo_yongyuan@163.com>
     */
    function in_array_case($value, $array)
    {
        return in_array(strtolower($value), array_map('strtolower', $array));
    }
}