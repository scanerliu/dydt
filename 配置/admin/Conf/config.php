<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',   //设置数据库类型
	'DB_HOST'=>'localhost',//设置主机
	'DB_NAME'=>'pharmacy',//设置数据库名
	'DB_USER'=>'root',    //设置用户名
	'DB_PWD'=>'root33068',        //设置密码
	'DB_PREFIX'=>'',  //设置表前缀
	'SHOW_PAGE_TRACE'=>false,
       'OUTPUT_ENCODE'=>false,
	
	'TMPL_PARSE_STRING'  =>array(
    '__PUBLIC__' => __ROOT__.'/admin/Tpl/public/', // 更改默认的__PUBLIC__ 替换规则
     )
);
?>