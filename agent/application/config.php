<?php

return [

    // +----------------------------------------------------------------------
    // | auth配置
    // +----------------------------------------------------------------------
    'auth_config'  => [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => 'cms_auth_group', // 用户组数据不带前缀表名
        'auth_group_access' => 'cms_auth_group_access', // 用户-用户组关系不带前缀表
        'auth_rule'         => 'cms_auth_rule', // 权限规则不带前缀表
        'auth_user'         => 'cms_admin', // 用户信息不带前缀表
    ],

    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------
    'url_route_on' => true,     //开启路由功能
    'route_config_file' =>  ['api'],   // 设置路由配置文件列表
    'url_route_must'         =>  false,
    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'app_trace' =>  false,      //开启应用Trace调试
    'trace' => [
        'type' => 'html',       // 在当前Html页面显示Trace信息,显示方式console、html
    ],
    'sql_explain' => false,     // 是否需要进行SQL性能分析
    'extra_config_list' => ['database', 'route', 'validate'],//各模块公用配置
    'app_debug' => true,
	'default_module' => 'admin',//默认模块
    //'default_filter' => ['strip_tags', 'htmlspecialchars'],

    //默认错误跳转对应的模板文件
    'dispatch_error_tmpl' => APP_PATH.'admin/view/public/error.tpl',
    //默认成功跳转对应的模板文件
    'dispatch_success_tmpl' => APP_PATH.'admin/view/public/success.tpl',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------
    'log'       => [
        'type'  => 'test',// 日志记录方式，内置 file socket 支持扩展
        'path'  => LOG_PATH,// 日志保存目录
        'level' => [],// 日志记录级别
    ],


    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------
    'cache' => [
        'type'   => 'file',// 驱动方式
        'host'       => '127.0.0.1',
        'port'       => 6379,
        'REDIS_RW_SEPARATE' => true,
        'password'   => '123456',
        'select'     => 11,
        'persistent' => true,
        'prefix'     => ''
    ],
//    'db2' => [
//        'type'           => 'mysql',	     // 数据库类型
//        'hostname'       => 'rm-2ze70f797xc35g2no1o.mysql.rds.aliyuncs.com',     // 服务器地址
//        'database'       => 'pdklogin',    // 数据库名
//        'username'       => 'jnqp_read',	         // 用户名
//        'password'       => 'jnqp_2020',	         // 密码
//        'hostport'       => '3306',	         // 端口
//        'dsn'            => '',	             // 连接dsn
//        'params'         => [],	             // 数据库连接参数
//        'charset'        => 'utf8',	         // 数据库编码默认采用utf8
//        'prefix'         => '',	     // 数据库表前缀
//        'debug'          => true,	         // 数据库调试模式
//        'deploy'         => 0,	             // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
//        'rw_separate'    => false,	         // 数据库读写是否分离 主从式有效
//        'master_num'     => 1,	             // 读写分离后 主服务器数量
//        'slave_no'       => '',	             // 指定从服务器序号
//        'fields_strict'  => true,	         // 是否严格检查字段是否存在
//        'resultset_type' => 'array',	     // 数据集返回类型 array 数组 collection Collection对象
//        'auto_timestamp' => false,	         // 是否自动写入时间戳字段
//        'sql_explain'    => false,	         // 是否需要进行SQL性能分析
//    ],

    'db2' => [
        'type'           => 'mysql',	     // 数据库类型
        'hostname'       => '192.168.1.112',     // 服务器地址
        'database'       => 'jnqp_login',    // 数据库名
        'username'       => 'xiaojie',	         // 用户名
        'password'       => 'xiaojie',	         // 密码
        'hostport'       => '3306',	         // 端口
        'dsn'            => '',	             // 连接dsn
        'params'         => [],	             // 数据库连接参数
        'charset'        => 'utf8',	         // 数据库编码默认采用utf8
        'prefix'         => '',	     // 数据库表前缀
        'debug'          => true,	         // 数据库调试模式
        'deploy'         => 0,	             // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        'rw_separate'    => false,	         // 数据库读写是否分离 主从式有效
        'master_num'     => 1,	             // 读写分离后 主服务器数量
        'slave_no'       => '',	             // 指定从服务器序号
        'fields_strict'  => true,	         // 是否严格检查字段是否存在
        'resultset_type' => 'array',	     // 数据集返回类型 array 数组 collection Collection对象
        'auto_timestamp' => false,	         // 是否自动写入时间戳字段
        'sql_explain'    => false,	         // 是否需要进行SQL性能分析
    ],
    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------
    'session'            => [
        'id'             => '',
        'var_session_id' => '',// SESSION_ID的提交变量,解决flash上传跨域
        'prefix'         => 'foot',// SESSION 前缀
        'type'           => '',// 驱动方式 支持redis memcache memcached
        'auto_start'     => true,// 是否自动开启 SESSION
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'        => [
        'prefix'    => '',// cookie 名称前缀
        'expire'    => 0,// cookie 保存时间
        'path'      => '/',// cookie 保存路径
        'domain'    => '',// cookie 有效域名
        'secure'    => false,//  cookie 启用安全传输
        'httponly'  => '',// httponly设置
        'setcookie' => true,// 是否使用 setcookie
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],


    // +----------------------------------------------------------------------
    // | 数据库设置
    // +----------------------------------------------------------------------
    'data_backup_path'     => '../data/',   //数据库备份路径必须以 / 结尾；
    'data_backup_part_size' => '20971520',  //该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M
    'data_backup_compress' => '1',          //压缩备份文件需要PHP环境支持gzopen,gzwrite函数        0:不压缩 1:启用压缩
    'data_backup_compress_level' => '9',    //压缩级别   1:普通   4:一般   9:最高


    // +----------------------------------------------------------------------
    // | 验证类型
    // +----------------------------------------------------------------------
    'verify_type' => '1',   //验证码类型：0拖动滑块验证， 1数字验证码
    'auth_key' => 'JUD6FCtZsqrmVXc2apev4TRn3O8gAhxbSlH9wfPN', //默认数据加密KEY
    'pages'    => '10',//分页数
    'salt'     => 'wZPb~yxvA!ir38&Z',//加密串

];
