<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
</head>
<body>
<div class="bannerList">
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left; line-height:26px;" colspan="9">
        <form action="" method="get" name="form">
          <div style="float:left"><a href="/admin.php/productManagement/productList">上一级目录></a> 消费记录 -- <?php echo ($title); ?>-总销售金额:<?php echo ($total_price); ?>-总销售数量:<?php echo ($product_num); ?></div>
          <script type="text/javascript" src="/admin/Tpl/public/js/laydate.js"></script>
            <div style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开始时间：</div>
          <li class="inline laydate-icon" id="start" style="width:100px; margin-right:10px; float:left"><?php echo ($_GET['begtime']); ?></li>
          <input name="begtime" type="hidden" value="" />
          <div style="float:left">结束时间：</div>
          <li class="inline laydate-icon" id="end" style="width:100px; float:left"><?php echo ($_GET['endtime']); ?></li>
          <input name="endtime" type="hidden" value="" />
          <div style="float:left">&nbsp;&nbsp;<a class="button1" onclick="formsubmit()"> 提交</a>&nbsp;<a href="/admin.php/productManagement/sellRecord/product_id/<?php echo ($_GET['product_id']); ?>" class="button1">重置</a>
          <a class="button1" onclick="formsubmit2()"> 导出excel</a>
          </div>
          <script type="text/javascript">
//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: '2015-01-01', //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: false,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: false,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
    }
};
laydate(start);
laydate(end);
     
	   function  formsubmit(){
		   $("form[name='form']").attr('action','__APP__/productManagement/sellRecord/product_id/<?php echo ($_GET['product_id']); ?>');
		  $("input[name='begtime']").val( $('#start').html() );
		  $("input[name='endtime']").val( $('#end').html() );
		   form.submit();
 		 }

   function  formsubmit2(){
		   $("form[name='form']").attr('action','__APP__/productManagement/order_excel/product_id/<?php echo ($_GET['product_id']); ?>');
		  $("input[name='begtime']").val( $('#start').html() );
		  $("input[name='endtime']").val( $('#end').html() );
		   form.submit();
 		 }


</script>
        </form></td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td width="200">订单号</td>
      <td  width="100">消费金额</td>
      <td  width="100">数量</td>
      <td  width="100">确认收货时间</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><a href="__APP__/order/orderDetail/order_id/<?php echo ($vol["order_id"]); ?>" style="color:#06C"><?php echo ($vol["order_num"]); ?></a></td>
        <td><?php echo ($vol["total_price"]); ?></td>
        <td><?php echo ($vol["product_num"]); ?></td>
        <td><?php echo (date('Y年m月d日 H:i:s',$vol["time4"])); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
      <td  colspan="9" bgcolor="#fbfce2"  height="36" class="feny"><?php echo ($page); ?></td>
    </tr>
  </table>
</div>
</body>
</html>