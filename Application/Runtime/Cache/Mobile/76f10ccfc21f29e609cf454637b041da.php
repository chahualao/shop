<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>绑定手机</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/rehoming.css"/>
</head>
<body style="background-color: #FBFBFB;">   
	<header class="mui-bar mui-bar-nav">
	    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left pub-head-back"></a>
	    <h1 class="mui-title">绑定手机</h1>
	</header>
	
	<div class="my_pub-content-box">
		<div class="my_pub-content-box-row mui-clearfix" id="first001">
			<span class="my_pub-content-box-row-l">手机号</span>
			<input name="mobile" type="tel" id="my_telverify-txt-tel" placeholder="需要绑定的手机号" maxlength="11"/>			
			<input type="button" id="my_telverify-btn-yz" value="获取验证码" onclick="getVerify();" />
		</div>
		<div class="my_pub-content-box-row mui-clearfix mui-input-row">
			<span class="my_pub-content-box-row-l">验证码</span>
			<input type="text" name="verify" id="my_telverify-txt-vercode" class="mui-input-clear" placeholder="请输入验证码"/>
			
		</div>
	</div>
	
	<input type="button" name="my_telverify-btn-bd" id="my_telverify-btn-bd" class="btn_black_center" onclick="bindMobile();" value="绑定" />
			
    <script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/vendor/jquery/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/vendor/layer/layer.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    	mui.init(); 
    	
    	//获取验证码
    	function getVerify(){
    		var mobile = $('input[name=mobile]').val();
    		if(!checkMobile(mobile)){
	    			mui.confirm('手机号码格式不正确！','提示',['确认'],function (e) {
	                
	                if(e.index==0){
	                   $("#my_telverify-txt-tel").focus();
	                }
	            },'div')
	    			return false;
    		}

    		$.ajax({
                url: '/index.php?m=Mobile&c=User&a=send_validate_code&t=' + Math.random(),
                type: 'post',
                dataType: 'json',
                data: {type: 'mobile', send: mobile},
                success: function (res) {
                    if (res.status == 1) {
                        $("#my_telverify-btn-yz").attr('onclick','');
                        $("#my_telverify-btn-yz").attr("disabled","disabled");
                        var timer = 60;
						//定时开始								
						var t = setInterval(function(){
							if(timer>=0){
								$("#my_telverify-btn-yz").attr("value","获取验证码"+"("+timer+"s)");					    				
								timer--;
							}
							else{ 
								clearInterval(t); 
								timer=10;	
								$("#my_telverify-btn-yz").removeAttr("disabled");
								$("#my_telverify-btn-yz").attr("value","获取验证码")
								$("#my_telverify-btn-yz").attr('onclick','getVerify()');
							}
						},1000)
                    } else {
                    	mui.confirm(res.msg,'提示',['确认'],function (e) {
	                
				                if(e.index==0){
				                   $("#my_telverify-txt-tel").focus();
				                }
				            },'div')
                    	return false;
                    }
                }
            });
    	}

    	function checkMobile(tel) {
		    var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
		    if (reg.test(tel)) {
		        return true;
		    }else{
		        return false;
		    };
		}
		//绑定手机号
		function bindMobile(){
			var mobile = $('input[name=mobile]').val();
			var verify = $('input[name=verify]').val();
			if(checkMobile(mobile) && verify.trim() !=''){
				$.ajax({
					type:'POST',
					url:"<?php echo U('Mobile/User/mobileinfo');?>",
					data:{mobile:mobile,verify:verify},
					dataType: 'json',
					success:function(data){
						if (data.status) {
							mui.confirm(data.msg,'提示',['确认'],function (e) {
	                
				                if(e.index==0){
				                   location.href="<?php echo U('Mobile/User/index');?>";
				                }
				            },'div')
						}else{
							mui.confirm(data.error,'提示',['确认'],function (e) {
	                
				                if(e.index==0){
				                   location.href = Window.location.href;
				                }
				            },'div')
						}
					}
				})
			}else{
				mui.confirm('缺少必须填写的内容','提示',['确认'],function (e) {
	                
				                if(e.index==0){
				                   $("#my_telverify-txt-tel").focus();
				                }
				            },'div')
			}
		}
			  	
    </script>
</body>
</html>