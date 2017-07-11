<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>瑞和家商城管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
 	<link href="/Public/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="/Public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />   
    <!-- jQuery 2.1.4 -->
    <script src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="/Public/js/global.js"></script>
    <script src="/Public/js/myFormValidate.js"></script>    
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script src="/Public/js/myAjax.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    //全选
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['90%', '90%'],
            content: $(obj).attr('data-url'), 
        });
    }
    
    function delAll(obj,name){
    	var a = [];
    	$('input[name*='+name+']').each(function(i,o){
    		if($(o).is(':checked')){
    			a.push($(o).val());
    		}
    	})
    	if(a.length == 0){
    		layer.alert('请选择删除项', {icon: 2});
    		return;
    	}
    	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
    			$.ajax({
    				type : 'get',
    				url : $(obj).attr('data-url'),
    				data : {act:'del',del_id:a},
    				dataType : 'json',
    				success : function(data){
    					if(data == 1){
    						layer.msg('操作成功', {icon: 1});
    						$('input[name*='+name+']').each(function(i,o){
    							if($(o).is(':checked')){
    								$(o).parent().parent().remove();
    							}
    						})
    					}else{
    						layer.msg(data, {icon: 2,time: 2000});
    					}
    					layer.closeAll();
    				}
    			})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);	
    }
    </script>        
  </head>
  <body style="background-color:#ecf0f5;">
 

<link href="/Public/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="/Public/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="/Public/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<div class="wrapper">
    <div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

    <section class="content ">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
            	
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 添加团购活动</h3>
                </div>
                <div class="panel-body ">   
                    <!--表单数据-->
                    <form method="post" id="handleposition" action="<?php echo U('Admin/Promotion/groupbuyHandle');?>">                    
                        <!--通用信息-->
                    <div class="tab-content col-md-10">                 	  
                        <div class="tab-pane active" id="tab_tongyong">                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="col-sm-2">团购标题：</td>
                                    <td class="col-sm-6">
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo ($info["title"]); ?>" >
                                        <span id="err_attr_name" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                    <td class="col-sm-4">请填写团购标题</td>
                                </tr>
                                <tr>
                                    <td>开始时间：</td>
                                    <td>
                               			<input type="text" class="form-control" id="start_time" name="start_time" value="<?php echo ($info["start_time"]); ?>">
                                    </td>
                                    <td class="col-sm-4">团购开始时间</td>
                                </tr>                                
                                <tr>
                                    <td>结束时间：</td>
                                    <td>
                      					<input type="text" class="form-control" id="end_time" name="end_time" value="<?php echo ($info["end_time"]); ?>">   
                                    </td>
                                    <td class="col-sm-4">团购结束时间</td>
                                </tr>
                                  
                                <tr>
                                    <td>设置团购商品：</td>
                                    <td>
                                    	<div class="col-xs-9">
                             			<input type="text" id="goods_name" name="goods_name" class="form-control" value="<?php echo ($info["goods_name"]); ?>">
                             			</div>
                             			<div class="col-xs-3">
                             			<input type="hidden" id="goods_id" name="goods_id" value="<?php echo ($info["goods_id"]); ?>">
                             			<input class="btn btn-primary" type="button" onclick="selectGoods()" value="选择商品">
                             			</div>
                                    </td>
                                    <td class="col-sm-4">请选择加入团购的商品</td>
                                </tr>
                                <tr>
                                    <td>团购价格：</td>
                                    <td>
                                    	<div class="col-xs-4">
	                      					<input type="text" class="form-control" id="price" name="price" value="<?php echo ($info["price"]); ?>"  onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onchange="changeRebate(this)" />
	                      					<input type="hidden" id="goods_price" name="goods_price" value="<?php echo ($info["goods_price"]); ?>">
                      					</div>
                      					<span id="price_html"></span>
                                    </td>
                                    <td class="col-sm-4">商品团购价格(默认是商品价格)</td>
                                </tr>
                                <tr>
                                    <td>商品折扣：</td>
                                    <td>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="rebate" name="rebate" value="<?php echo ($info["rebate"]); ?>"  onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onchange="change_g_price(this)" />
                                        </div>
                                    </td>
                                    <td class="col-sm-4">相对于原来价格的折扣(例如[0.75]代表75折，此项只作为前台显示，不参与内部计算)</td>
                                </tr>
                                <tr>
                                    <td>参团数量：</td>
                                    <td>
                      					<input type="text" class="form-control" id="goods_num" name="goods_num" value="<?php echo ($info["goods_num"]); ?>"  onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" />
                                    </td>
                                    <td class="col-sm-4">请填写自然数，参与团购的商品数量</td>
                                </tr> 
                                <tr>
                                    <td>虚拟购买数：</td>
                                    <td>
                      					<input type="text" class="form-control" name="virtual_num" value="<?php echo ($info["virtual_num"]); ?>"  onpaste="this.value=this.value.replace(/[^\d]/g,'')" onkeyup="this.value=this.value.replace(/[^\d]/g,'')"/>
                                    </td>
                                    <td class="col-sm-4">虚拟已购买参团人数</td>
                                </tr>
                                <tr>
                                    <td>团购介绍：</td>
                                    <td>
                                    	<textarea class="form-control" rows="4" placeholder="请输入团购介绍" name="intro"><?php echo ($info["intro"]); ?></textarea>
                                    </td>
                                    <td class="col-sm-4">团购描述介绍</td>
                                </tr>
                                <tr>
                                    <td>团购排序：</td>
                                    <td>
                                        <input type="text" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>">
                                    </td>
                                    <td class="col-sm-4">团购商品排序</td>
                                </tr>                                 
                                </tbody> 
                                <tfoot>
                                	<tr>
                                	<td><input class="btn btn-default" type="reset" value="重置">
                                		<input type="hidden" name="act" value="<?php echo ($act); ?>">
                                		<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                                	</td>
                                	<td class="col-sm-4"></td>
                                	<td class="text-right"><input class="btn btn-primary" type="button" onclick="adsubmit()" value="保存"></td></tr>
                                </tfoot>                               
                                </table>
                        </div>                           
                    </div>              
			    	</form><!--表单数据-->
                </div>
            </div>
        </div>
    </section>
</div>
<script>

function adsubmit(){
	if($('#title').val() ==''){
		layer.msg('团购标题不能为空');return;
	}
	if($('#price').val() ==''){
		layer.msg('团购价格不能为空');return;
	}
	if($('#group_num').val() ==''){
		layer.msg('限购数量不能为空');return;
	}
	$('#handleposition').submit();
}

$(document).ready(function() {
	$('#start_time').daterangepicker({
		format:"YYYY-MM-DD HH:mm:ss",
		singleDatePicker: true,
		showDropdowns: true,
		minDate:'<?php echo ($min_date); ?>',
		maxDate:'2030-01-01',
		startDate:'<?php echo ($min_date); ?>',
		timePicker : true, //是否显示小时和分钟  
        timePickerIncrement:1,//time选择递增数
		timePicker12Hour : false, //是否使用12小时制来显示时间                
	    locale : {
            applyLabel : '确定',
            cancelLabel : '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
            monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
            firstDay : 1
        }
	});
	
	$('#end_time').daterangepicker({
		format:"YYYY-MM-DD HH:mm:ss",
		singleDatePicker: true,
		showDropdowns: true,
		minDate:'<?php echo ($min_date); ?>',
		maxDate:'2030-01-01',
		startDate:'<?php echo ($min_date); ?>',
		timePicker : true, //是否显示小时和分钟  
        timePickerIncrement:1,//time选择递增数
		timePicker12Hour : false, //是否使用12小时制来显示时间                
	    locale : {
            applyLabel : '确定',
            cancelLabel : '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
            monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
            firstDay : 1
        }
	});

});

function selectGoods(){
    var url = "<?php echo U('Promotion/search_goods',array('tpl'=>'select_goods'));?>";
    layer.open({
        type: 2,
        title: '选择商品',
        shadeClose: true,
        shade: 0.2,
        area: ['75%', '75%'],
        content: url, 
    });
}

function call_back(goods_id,goods_name,store_count,goods_price){
	$('#goods_id').val(goods_id);
	$('#goods_name').val(goods_name);
	$('#group_num').val(store_count);
    $('#goods_price').val(goods_price);
    //给折扣加上商品原价 为折扣改变时候 算出团购卖价
    $("#rebate").attr('goods_price',goods_price);
    //默认团购价格等于原来价格，为了房间算出折扣，具体自己填写
    $("#price").val(goods_price);
    //更新折扣
    $("#rebate").val(parseInt($("#price").val())/parseInt(goods_price));
	layer.closeAll('iframe');
}
//修改价格后改变折扣
function changeRebate(obj){
    var c_val = $(obj).val();
    var g_pirce = $('#goods_price').val();
    if (!g_pirce) {
        alert('请选择加入团购的商品');
        return;
    }
    $("#rebate").val(parseInt(c_val)/parseInt(g_pirce));
}
//修改折扣后 改变团购价格
function change_g_price(obj){
    var t_rebate = parseFloat($(obj).val());
    var g_pirce = parseInt($(obj).attr('goods_price'));

    $("#price").val(t_rebate*g_pirce);
}
</script>
</body>
</html>