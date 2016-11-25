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
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;">
    <tbody>
      <tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;" class="status">
        <td style="text-align:left; line-height:24px;"><form  action="" method="get" name="form" >
            <div style="float:left"> 状态
              <select name="status">
                <option value="">全部</option>
                <option value="1">待付款</option>
                <option value="2">待发货</option>
                <option value="3">待收货</option>
                <option value="4">待评价</option>
                <option value="5">已评价</option>
              </select>
            </div>
            <script type="text/javascript">
       $("select[name='status'] ").find("option[value='<?php echo ($_GET['status']); ?>'] ").get(0).selected = true;
        </script>
            <div style="float:left">&nbsp;&nbsp;
              <input  type="text"  class="input1" style="width:300px;"  placeholder="请输入订单号\采购商名称\联系人\联系电话\药品名称" name="keyword" value="<?php echo ($_GET['keyword']); ?>"/>
            </div>
            <script type="text/javascript" src="/admin/Tpl/public/js/laydate.js"></script>
            <div style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;查询时间：</div>
            <div style="float:left">
              <select name="time">
                <option value="">下单时间</option>
                <option value="2">付款时间</option>
                <option value="4">发货时间</option>
                <option value="4">收货时间</option>
                <option value="5">评价时间</option>
              </select>
            </div>
            <script type="text/javascript">
       $("select[name='time'] ").find("option[value='<?php echo ($_GET['time']); ?>'] ").get(0).selected = true;
      </script>
            <div style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开始时间：</div>
            <li class="inline laydate-icon" id="start" style="width:100px; margin-right:10px; float:left"><?php echo ($_GET['begtime']); ?></li>
            <input name="begtime" type="hidden" value="" />
            <div style="float:left">结束时间：</div>
            <li class="inline laydate-icon" id="end" style="width:100px; float:left"><?php echo ($_GET['endtime']); ?></li>
            <input name="endtime" type="hidden" value="" />
            &nbsp;&nbsp;<a class="button1"  onclick="formsubmit()">提交</a> &nbsp; 已经付款的金额为
            <?php if($num == null ): ?>0
              <?php else: ?>
              <?php echo ($num); endif; ?>
            元，已经确认收货的金额为
            <?php if($num2 == null ): ?>0
              <?php else: ?>
              <?php echo ($num2); endif; ?>
            元，，待发货的金额为
            <?php if($num3 == null ): ?>0
              <?php else: ?>
              <?php echo ($num3); endif; ?>
            元 <a class="button1" onclick="formsubmit2()"> 导出excel</a>
          </form></td>
      </tr>
    </tbody>
  </table>
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
		   $("form[name='form']").attr('action','/admin.php/order/orderList');
		  $("input[name='begtime']").val( $('#start').html() );
		  $("input[name='endtime']").val( $('#end').html() );
		   form.submit();
 		 }
    function  formsubmit2(){
		   $("form[name='form']").attr('action','/admin.php/order/order_excel');
		  $("input[name='begtime']").val( $('#start').html() );
		  $("input[name='endtime']").val( $('#end').html() );
		   form.submit();
 		 }
     </script>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="">订单号</td>
      <td>状态</td>
      <td>下单时间</td>
      <td>收货人</td>
      <td>联系方式</td>
      <td width="">订单金额</td>
      <td width="">操作</td>
      <td width="">电子合同</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30" style="color:#06F"><?php echo ($vol["order_num"]); ?></td>
        <td><?php if($vol["status"] == 1): ?>待付款
            <?php elseif($vol["status"] == 2): ?>
            待发货
            <?php elseif($vol["status"] == 3): ?>
            待确认
            <?php elseif($vol["status"] == 4): ?>
            未评价
            <?php elseif($vol["status"] == 5): ?>
            已评价<?php endif; ?></td>
        <td><?php echo (date('Y年m月d日 H:i:s',$vol["time"])); ?></td>
        <td><?php echo ($vol["name"]); ?></td>
        <td><?php echo ($vol["real_address"]); ?></td>
        <td width=""><?php echo ($vol["total"]); ?></td>
        <td><a href="__APP__/order/orderDetail/order_id/<?php echo ($vol["order_id"]); ?>" style="color:#03C">查看</a></td>
         <td><a href="/order/contract2/order_id/<?php echo ($vol["order_id"]); ?>" target="_new" style="color:#03C">查看</a></td>
      </tr>
      <?php if(is_array($vol["pro"])): $i = 0; $__LIST__ = $vol["pro"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><tr>
          <td colspan="100"  style="text-align:left; padding-left:10px; height:50px; color:#777"> 商品名：<?php echo ($vol2["title"]); ?>&nbsp;&nbsp;&nbsp;规格:<?php echo ($vol2["guige"]); ?>&nbsp;&nbsp;&nbsp;批准文号:<?php echo ($vol2["peihao"]); ?>&nbsp;&nbsp;&nbsp;货号:<?php echo ($vol2["huohao"]); ?>&nbsp;&nbsp;&nbsp;厂家:<?php echo ($vol2["changjia"]); ?>&nbsp;&nbsp;&nbsp;价格:<?php echo ($vol2["price"]); ?>&nbsp;&nbsp;&nbsp;数量:<?php echo ($vol2["product_num"]); ?>&nbsp;&nbsp;&nbsp;批号：<?php echo ($vol2["serial_number"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
    <tr>
      <td  colspan="9" bgcolor="#fbfce2"  height="36" class="feny"><?php echo ($page); ?></td>
    </tr>
  </table>
</div>
</body>
</html>