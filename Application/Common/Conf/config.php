<?php
return array(
//=======================基本设置===========================
	'SHOW_PAGE_TRACE'   =>  false,                        //关闭Trace信息
    'TAGLIB_BUILD_IN'        =>  'Cx,Common\Tag\My',           //加载自定义标签
    'LOAD_EXT_CONFIG'     =>  'db,webconfig,oauth',         //加载网站设置文件
    'TMPL_PARSE_STRING'  =>  array(                        //定义常用路径
	    '__HOME_CSS__'     		=>  __ROOT__.trim(TMPL_PATH,'.').'Home/Public/css',
	    '__HOME_JS__'      			=>  __ROOT__.trim(TMPL_PATH,'.').'Home/Public/js',
	    '__HOME_IMAGE__'  		=>  __ROOT__.trim(TMPL_PATH,'.').'Home/Public/image',
	    '__ADMIN_CSS__'     		=>  __ROOT__.trim(TMPL_PATH,'.').'Admin/Public/css',
	    '__ADMIN_JS__'     		=>  __ROOT__.trim(TMPL_PATH,'.').'Admin/Public/js',
	    '__ADMIN_IMAGE__'   	=>  __ROOT__.trim(TMPL_PATH,'.').'Admin/Public/image',
    ),
//=======================SESSION===========================
	'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
	'SESSION_OPTIONS'     	 	=>  array(
        'name'              	 		=>  'MYTPBLOGSESSION',                 //设置session名
        'expire'           				=>  24*3600*15,                   //SESSION保存15天
        'use_trans_sid'        		=>  1,                           	 //跨页传递
	), 
	'SESSION_TYPE'         	 	=>  '', // session hander类型 默认无需设置 除非扩展了session hander驱动
	'SESSION_PREFIX'    		    =>  '', // session 前缀
	
	
);