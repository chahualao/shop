<?php
		return array(
			'VIEW_PATH'       =>'./Template/mobile/', // 改变某个模块的模板文件目录
			'DEFAULT_THEME'    =>'v1', // 模板名称
			'TMPL_PARSE_STRING'  =>array(
		//                '__PUBLIC__' => '/Common', // 更改默认的/Public 替换规则
					'__STATIC__'     => '/Template/mobile/new/Static', // 增加新的image  css js  访问路径  后面给 php 改了
					'__MOBILE_STATIC__'=>'/Public/static',//新增的
			   ),
			   //'DATA_CACHE_TIME'=>60, // 查询缓存时间
			);
		?>