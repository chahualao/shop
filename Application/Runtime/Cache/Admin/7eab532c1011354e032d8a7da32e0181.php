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
 

<div class="wrapper">
  <div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

    <section class="content">
    <!-- Main content -->
    <div class="container-fluid">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> 订单价格修改</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo U('Admin/Order/editprice',array('order_id'=>$order['order_id']));?>" method="post" id="edit_price">
                    <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <div class="row">
                                <td class="text-right col-sm-2">商品总价：</td>
                                <td class="text-left" colspan="3">
                                    <p class="text-info"><?php echo ($order["goods_price"]); ?></p>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <td class="text-right col-sm-2">物流运费：</td>
                                <td colspan="3">
                                        <input type="text" name="shipping_price" class="input-sm" value="<?php echo ($order["shipping_price"]); ?>" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" onpaste="this.value=this.value.replace(/[^\d.]/g,'')">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <td class="text-right col-sm-2">订单价格微调：</td>
                                <td colspan="3">
                                    <input type="text" value="<?php echo ($order["discount"]); ?>" name="discount" onkeyup="this.value=this.value.replace(/[^-?\d.]/g,'')" onpaste="this.value=this.value.replace(/[^-?\d.]/g,'')" class="input-sm">
                                    <p class="text-warning">请直接输入金额(可负数)</p>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <td class="text-right col-sm-2">订单总金额：</td>
                                <td colspan="3">
                                    <p class="text-info"><?php echo ($order["total_amount"]); ?></p>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <td class="text-right col-sm-2">使用余额：</td>
                                <td colspan="3">
                                    <p class="text-info"><?php echo ($order["user_money"]); ?></p>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <td class="text-right col-sm-2">使用积分：</td>
                                <td colspan="3">
                                   <p class="text-info"><?php echo ($order["integral"]); ?></p>
                                </td>
                            </div>
                        </tr>
                         <tr>
                            <div class="row">
                                <td class="text-right col-sm-2">应付金额：</td>
                                <td colspan="3">
                                    <p class="text-info"><?php echo ($order["order_amount"]); ?></p>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div class="row">
                                <td class="text-right col-sm-2"></td>
                                <td colspan="3">
                                    <button class="btn btn-default" type="button" onclick="javascript:history.go(-1)">取消</button>
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </td>
                            </div>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>   
   </section>
</div>
</body>
</html>