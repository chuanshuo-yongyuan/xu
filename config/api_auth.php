<?php
/**
 * FileName: api_auth.php
 * ==============================================
 * Copy right 2016-2018
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: 永 | <chuanshuo_yongyuan@163.com>
 * @date  : 2018/9/5 10:39
 */


/**
 * 接口权限认证配置
 */
return [
    'auth_on'           => true,                        // 认证开关
    'auth_type'         => 2,                           // 认证方式，1为实时认证；2为登录认证。
    'auth_group'        => 'auth_group',                // 用户组数据表名
    'auth_group_access' => 'auth_group_access',         // 用户-用户组关系表
    'auth_rule'         => 'auth_rule',                 // 权限规则表
    'auth_user'         => 'admin_member'               // 用户信息表
];