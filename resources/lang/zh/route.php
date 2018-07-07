<?php
/**
 * luffy-restaurant-order
 * route.php.
 * @author luffyzhao@vip.126.com
 */

return [
    'POST:base/admin' => '添加后台用户',
    'DELETE:base/admin/{admin}' => '删除后台用户',
    'PUT:base/admin/{admin}' => '后台用户更新',
    'PUT:base/auth' => '重新获取登录token',
    'POST:base/auth' => '用户登录',
    'DELETE:base/auth' => '退出登录',
    'DELETE:base/auth/lock' => '解除锁定',
    'PUT:base/auth/photo' => '更新头像',
    'PUT:base/auth/user ' => '修改个人资料',
    'POST:base/file' => '文件上传',
    'POST:base/permission' => '添加权限&菜单',
    'DELETE:base/permission/{permission}' => '删除权限&菜单',
    'PUT:base/permission/{permission}' => '修改权限&菜单',
    'POST:base/role' => '添加后台角色',
    'PUT:base/role/{role}' => '修改后台角色',
    'DELETE:base/role/{role}' => '删除后台角色',
    'POST:base/role/{role}/permission' => '给后台角色分配权限&菜单',
    'PUT:base/auth/message/{message}' => '查看未读通知'
];