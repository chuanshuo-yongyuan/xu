<?php

namespace app\index\controller;

use app\common\Api;
use app\common\Oauth;

class Index extends Api
{
    use Oauth;

    public function index()
    {
        $json = '[{"id":3,"module_id":5,"pid":0,"has_level":0,"name":"controller_suffix","title":"\u63a7\u5236\u5668\u7c7b\u540e\u7f00","description":"\u63a7\u5236\u5668\u7c7b\u540e\u7f00","type":1,"info":"Controller","sort":0,"status":1,"original_output":0,"create_time":"2018-11-16 17:19:33","update_time":"2018-11-22 10:05:05"},{"id":4,"module_id":5,"pid":0,"has_level":0,"name":"empty_controller","title":"\u9ed8\u8ba4\u7684\u7a7a\u63a7\u5236\u5668\u540d","description":"\u9ed8\u8ba4\u7684\u7a7a\u63a7\u5236\u5668\u540d","type":1,"info":"Error","sort":0,"status":1,"original_output":0,"create_time":"2018-11-16 17:23:23","update_time":"2018-11-22 09:39:27"},{"id":5,"module_id":5,"pid":0,"has_level":1,"name":"log","title":"\u65e5\u5fd7","description":"\u65e5\u5fd7","type":0,"info":null,"sort":0,"status":1,"original_output":0,"create_time":"2018-11-16 17:30:08","update_time":"2018-11-16 17:59:20"},{"id":7,"module_id":5,"pid":5,"has_level":0,"name":"type","title":"\u65e5\u5fd7\u8bb0\u5f55\u65b9\u5f0f","description":"\u65e5\u5fd7\u8bb0\u5f55\u65b9\u5f0f\uff0c\u5185\u7f6e file socket \u652f\u6301\u6269\u5c55","type":1,"info":"File","sort":0,"status":1,"original_output":0,"create_time":"2018-11-16 17:41:14","update_time":"2018-11-21 18:03:23"},{"id":8,"module_id":5,"pid":5,"has_level":0,"name":"path","title":"\u65e5\u5fd7\u4fdd\u5b58\u76ee\u5f55","description":"\u65e5\u5fd7\u4fdd\u5b58\u76ee\u5f55","type":0,"info":"RUNTIME_PATH . \'api_log\' . DS","sort":0,"status":1,"original_output":1,"create_time":"2018-11-16 18:00:29","update_time":"2018-11-21 18:24:26"},{"id":9,"module_id":5,"pid":5,"has_level":0,"name":"level","title":"\u65e5\u5fd7\u8bb0\u5f55\u7ea7\u522b","description":"\u65e5\u5fd7\u8bb0\u5f55\u7ea7\u522b","type":0,"info":"[]","sort":0,"status":1,"original_output":1,"create_time":"2018-11-16 18:00:47","update_time":"2018-11-20 09:46:30"},{"id":10,"module_id":5,"pid":5,"has_level":0,"name":"file_size","title":"\u65e5\u5fd7\u6587\u4ef6\u5927\u5c0f","description":"\u65e5\u5fd7\u6587\u4ef6\u5927\u5c0f","type":0,"info":"10240000","sort":0,"status":1,"original_output":0,"create_time":"2018-11-16 18:01:07","update_time":"2018-11-16 18:01:07"},{"id":11,"module_id":5,"pid":5,"has_level":0,"name":"apart_level","title":"apart_level","description":"apart_level","type":0,"info":"[\'error\', \'log\', \'sql\']","sort":0,"status":1,"original_output":1,"create_time":"2018-11-16 18:01:28","update_time":"2018-11-19 16:55:14"},{"id":12,"module_id":5,"pid":0,"has_level":1,"name":"mimeList","title":"mime\u5217\u8868","description":"mime\u5217\u8868","type":0,"info":null,"sort":0,"status":1,"original_output":0,"create_time":"2018-11-16 18:02:06","update_time":"2018-11-16 18:02:06"},{"id":13,"module_id":5,"pid":12,"has_level":0,"name":"doc","title":"doc","description":"doc","type":0,"info":"application\/msword","sort":0,"status":1,"original_output":0,"create_time":"2018-11-16 18:02:32","update_time":"2018-11-16 18:02:32"},{"id":15,"module_id":5,"pid":0,"has_level":1,"name":"cloud_config","title":"\u4e91\u7aef\u914d\u7f6e","description":"\u4e91\u7aef\u914d\u7f6e","type":0,"info":null,"sort":0,"status":1,"original_output":0,"create_time":"2018-11-19 11:22:41","update_time":"2018-11-19 11:22:41"},{"id":16,"module_id":5,"pid":15,"has_level":0,"name":"host_res","title":"res\u57df\u540d","description":"res\u57df\u540d","type":0,"info":"http:\/\/cloudres.cc","sort":0,"status":1,"original_output":0,"create_time":"2018-11-19 11:23:05","update_time":"2018-11-19 11:23:05"},{"id":17,"module_id":5,"pid":15,"has_level":0,"name":"host_upload","title":"upload\u57df\u540d","description":"upload\u57df\u540d","type":0,"info":"http:\/\/cloudres.cc","sort":0,"status":1,"original_output":0,"create_time":"2018-11-19 11:23:41","update_time":"2018-11-19 11:23:41"},{"id":18,"module_id":5,"pid":15,"has_level":0,"name":"upload_path","title":"upload_path","description":"upload_path","type":0,"info":"\"Upload\" . DS","sort":0,"status":1,"original_output":1,"create_time":"2018-11-19 11:24:03","update_time":"2018-11-19 15:49:51"},{"id":19,"module_id":5,"pid":12,"has_level":0,"name":"docx","title":"docx","description":"docx","type":0,"info":"application\/vnd.openxmlformats-officedocument.wordprocessingml.document","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:56:24","update_time":"2018-11-21 16:56:24"},{"id":20,"module_id":5,"pid":12,"has_level":0,"name":"xls","title":"xls","description":"xls","type":0,"info":"[\'application\/excel\', \'application\/vnd.ms-excel\', \'application\/x-excel\', \'application\/x-msexcel\']","sort":0,"status":1,"original_output":1,"create_time":"2018-11-21 16:56:43","update_time":"2018-11-21 16:56:43"},{"id":21,"module_id":5,"pid":12,"has_level":0,"name":"xlsx","title":"xlsx","description":"xlsx","type":0,"info":"application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:57:01","update_time":"2018-11-21 16:57:01"},{"id":22,"module_id":5,"pid":12,"has_level":0,"name":"ppt","title":"ppt","description":"ppt","type":0,"info":"[\'application\/mspowerpoint\', \'application\/powerpoint\', \'application\/vnd.ms-powerpoint\', \'application\/x-mspowerpoint\']","sort":0,"status":1,"original_output":1,"create_time":"2018-11-21 16:57:23","update_time":"2018-11-21 16:57:23"},{"id":23,"module_id":5,"pid":12,"has_level":0,"name":"pptx","title":"pptx","description":"pptx","type":0,"info":"application\/vnd.openxmlformats-officedocument.presentationml.presentation","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:57:41","update_time":"2018-11-21 16:57:41"},{"id":24,"module_id":5,"pid":12,"has_level":0,"name":"pdf","title":"pdf","description":"pdf","type":0,"info":"application\/pdf","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:57:59","update_time":"2018-11-21 16:57:59"},{"id":25,"module_id":5,"pid":12,"has_level":0,"name":"txt","title":"txt","description":"txt","type":0,"info":"text\/plain","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:58:12","update_time":"2018-11-21 16:58:12"},{"id":26,"module_id":5,"pid":12,"has_level":0,"name":"xml","title":"xml","description":"xml","type":0,"info":"application\/xml","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:58:26","update_time":"2018-11-21 16:58:26"},{"id":27,"module_id":5,"pid":12,"has_level":0,"name":"apk","title":"apk","description":"apk","type":0,"info":"application\/vnd.android.package-archive","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:58:51","update_time":"2018-11-21 16:58:51"},{"id":28,"module_id":5,"pid":12,"has_level":0,"name":"ipa","title":"ipa","description":"ipa","type":0,"info":"application\/iphone-package-archive","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:59:10","update_time":"2018-11-21 16:59:10"},{"id":29,"module_id":5,"pid":12,"has_level":0,"name":"rar","title":"rar","description":"rar","type":0,"info":"application\/x-rar","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:59:28","update_time":"2018-11-21 16:59:28"},{"id":30,"module_id":5,"pid":12,"has_level":0,"name":"zip","title":"zip","description":"zip","type":0,"info":"application\/zip","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 16:59:54","update_time":"2018-11-21 16:59:54"},{"id":31,"module_id":5,"pid":12,"has_level":0,"name":"tar","title":"tar","description":"tar","type":0,"info":"application\/x-tar","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 17:00:11","update_time":"2018-11-21 17:00:11"},{"id":32,"module_id":5,"pid":12,"has_level":0,"name":"gz","title":"gz","description":"gz","type":0,"info":"application\/x-gzip","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 17:00:24","update_time":"2018-11-21 17:00:24"},{"id":33,"module_id":5,"pid":12,"has_level":0,"name":"7z","title":"7z","description":"7z","type":0,"info":"application\/x-7z-compressed","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 17:00:40","update_time":"2018-11-21 17:00:40"},{"id":34,"module_id":5,"pid":12,"has_level":0,"name":"bz","title":"bz","description":"bz","type":0,"info":"application\/x-bzip","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 17:00:52","update_time":"2018-11-21 17:00:52"},{"id":35,"module_id":5,"pid":12,"has_level":0,"name":"bz2","title":"bz2","description":"bz2","type":0,"info":"application\/x-bzip2","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 17:01:06","update_time":"2018-11-21 17:01:06"},{"id":36,"module_id":5,"pid":12,"has_level":0,"name":"tgz","title":"tgz","description":"tgz","type":0,"info":"application\/x-gzip","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 17:01:23","update_time":"2018-11-21 17:01:23"},{"id":38,"module_id":5,"pid":36,"has_level":0,"name":"tbz","title":"tbz","description":"tbz","type":0,"info":"application\/x-bzip2","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 17:24:04","update_time":"2018-11-21 17:24:04"},{"id":39,"module_id":5,"pid":0,"has_level":0,"name":"dfv","title":"sdfg","description":"sdfg","type":0,"info":"sdfg","sort":0,"status":1,"original_output":0,"create_time":"2018-11-21 18:52:13","update_time":"2018-11-21 18:52:13"}]';
        $arr = json_decode($json, true);
        dd($arr);
    }

    public function hello($name = 'ThinkPHP5')
    {
        return view();
    }

    public function info()
    {
        return [
            'code'    => 200,
            'data'    => [
                'roles'        => ['dev', 'editor'],
                'introduction' => '超级管理员',
                'avatar'       => 'https://avatars1.githubusercontent.com/u/18454614?s=88&v=4',
                'name'         => 'admin',
            ],
            'message' => 'OK',
        ];
    }

    public function login()
    {
        return [
            'code'    => 200,
            'data'    => [
                'roles'        => ['dev', 'editor'],
                'introduction' => '超级管理员',
                'avatar'       => 'https://avatars1.githubusercontent.com/u/18454614?s=88&v=4',
                'name'         => 'admin',
            ],
            'message' => 'OK',
        ];
    }

    public function isLogin()
    {
        return [
            'code'    => 404,
            'data'    => true,
            'message' => 'OK',
        ];
    }

    public function router()
    {
        return [
            'code'    => 200,
            'data'    => [
                'paht'      => '/home',
                'component' => 'layout/Layout',
            ],
            'message' => 'ok',
        ];
    }
}
