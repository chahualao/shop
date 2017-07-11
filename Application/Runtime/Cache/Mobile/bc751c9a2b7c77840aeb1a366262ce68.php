<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="TPSHOP v1.1" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>系统提示</title>
  <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
  <meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
  <link href="/Public/static/vendor/mui/mui.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
  <link rel="stylesheet" href="/Public/static/mobile/css/public.css" /> 
  <script src="/Public/static/vendor/jquery/jquery.min.js"></script>
  <script src="/Public/static/vendor/mui/mui.min.js"></script>
  </head>

<body>
<?php $msg = $message ? $message : $error; ?>
<script type="text/javascript">
  
  $(function(){
    mui.init();
    mui.confirm('<?php echo ($msg); ?>','提示',['确定'],function(e){
                  if (e.index == 0) {
                     location.href = "<?php echo ($jumpUrl); ?>";
                  }else{
                    //location.href = window.location.href;
                  }
                },'div');
  })
  
</script>
</body>
</html>