<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
<style type="text/css">
.i_orderDetail { width: 1000px; }
.i_orderDetail .s_part1 { border: 1px solid #c6d9db; border-right: 0px; margin-top: 10px; }
.i_orderDetail .s_part1 .part { width: 20%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border-right: 1px solid #c6d9db; float: left; height: 30px; line-height: 30px; text-align: center; color: #666 }
.i_orderDetail .s_part2 { border: 1px solid #c6d9db; border-top: 0px; }
.i_orderDetail .s_part2 .part { width: 20%; float: left; height: 60px; text-align: center; color: #666; l
}
.i_orderDetail .s_part2 .part img { margin-top: 15px; }
.i_orderDetail .s_part3 { border: 1px solid #c6d9db; border-right: 0px; border-top: 0px; }
.i_orderDetail .s_part3 .part { width: 20%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border-right: 1px solid #c6d9db; float: left; height: 30px; line-height: 30px; text-align: center; color: #666 }
.i_orderDetail .s_part4 { margin-top: 10px; margin-bottom: 10px; }
.i_orderDetail .s_part4 .h1 { background: #eef6fc }
.i_orderDetail .s_part4 .h1 .a1 { width: 400px; }
.i_orderDetail .s_part4 .h2 { }
.i_orderDetail .s_part4 .h2 .a1 { width: 40% }
.i_orderDetail .s_part4 .h2 .a2 { width: 15% }
.i_orderDetail .s_part4 .h2 .a1 .L { float: left }
.i_orderDetail .s_part4 .h2 .a1 .L img { width: 60px; height: 60px; }
.i_orderDetail .s_part4 .h2 .a1 .R { float: left; width: 254px; text-align: left; margin-left: 10px; }
.i_orderDetail .s_part4 .h2 .a1 .R .p1 { font-weight: bolder }
.i_orderDetail .s_part4 .h2 .a1 a { display: block }
</style>
</head>
<body>
<div class="bannerAdd">
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:36px;">
      <td style="text-align:left"><a href="__APP__/order/orderList">返回上一级</a> >> 订单修改 </td>
    </tr>
  </table>
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr style="height:36px;">
      <td style="text-align:left"><span>订单号：</span><span><?php echo ($orderDetail["order_num"]); ?></span></td>
    </tr>
    <tr>
    <tr style="height:36px;">
      <td style="text-align:left"><span>收货地址：</span><span> <?php echo ($orderDetail["real_address"]); ?> </span></td>
    </tr>
    <tr style="height:36px;">
      <td style="text-align:left"><span>采购商名称:<?php echo ($user["real_name"]); ?>&nbsp;&nbsp;用户名:<?php echo ($user["name"]); ?>&nbsp;&nbsp;用户id:<?php echo ($user["user_id"]); ?> </span></td>
    </tr>
    <?php if($orderDetail["remark"] != null): ?><tr style="height:36px;">
        <td style="text-align:left">备注：<?php echo ($orderDetail["remark"]); ?></td>
      </tr><?php endif; ?>
    <tr>
      <td style="text-align:left">
        <div class="i_orderDetail">
          <div class="s_part1">
            <div class="part">拍下商品</div>
            <div class="part">付款</div>
            <div class="part">卖家发货</div>
            <div class="part">确认收货</div>
            <div class="part">评价</div>
            <div class="clear"></div>
          </div>
          <!--s_part1-->
          <div class="s_part2">
            <?php if($orderDetail["status"] == 1): ?><div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <?php elseif($orderDetail["status"] == 2): ?>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <?php elseif($orderDetail["status"] == 3): ?>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <?php elseif($orderDetail["status"] == 4): ?>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <?php elseif($orderDetail["status"] == 5): ?>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div>
              <div class="part"><img src="__PUBLIC__images/a13.jpg" /></div><?php endif; ?>
            <div class="clear"></div>
          </div>
          <!--s_part2-->
          <div class="s_part3">
            <div class="part"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time"])); ?></div>
            <div class="part"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time2"])); ?></div>
            <div class="part"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time3"])); ?></div>
            <div class="part"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time4"])); ?></div>
            <div class="part"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time5"])); ?></div>
            <div class="clear"></div>
          </div>
          <!--s_part3-->
          
          <div class="s_part4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr class="h1">
                <td class="a1">商品 </td>
                <td class="a2">状态</td>
                <td class="a3">单价（元）</td>
                <td class="a3">数量</td>
                <td class="a3">商品总价（元）</td>
              </tr>
              <?php if(is_array($order_product)): $i = 0; $__LIST__ = $order_product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr class="h2">
                  <td class="a1"><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>">
                    <div class="L"><img src="/Uploads/<?php echo ($vol["img"]); ?>" /></div>
                    <div class="R">
                      <div class="p1"><?php echo ($vol["title"]); ?></div>
                      <div class="p2"><?php echo ($vol["subhead"]); ?></div>
                      <div style="color:#999">规格:<?php echo ($vol["guige"]); ?>&nbsp;&nbsp;&nbsp;批准文号:<?php echo ($vol["peihao"]); ?>&nbsp;&nbsp;&nbsp;货号:<?php echo ($vol["huohao"]); ?>&nbsp;&nbsp;&nbsp;厂家:<?php echo ($vol["changjia"]); ?>&nbsp;&nbsp;&nbsp;批号：<?php echo ($vol["serial_number"]); ?></div>
                    </div>
                    <div class="clear"></div>
                    </a></td>
                  <td class="a2">
                    <?php if($orderDetail["status"] == 1): ?>待付款
                      <?php elseif($orderDetail["status"] == 2): ?>
                      待发货
                      <?php elseif($orderDetail["status"] == 3): ?>
                      待确认
                      <?php elseif($orderDetail["status"] == 4): ?>
                      <?php if($vol["is_have_comment_right"] == 1): ?>未评价
                        <?php else: ?>
                        已评价<?php endif; ?>
                      <?php elseif($orderDetail["status"] == 5): ?>
                      已经评价<?php endif; ?>
                  </td>
                  <td class="a2"><?php echo ($vol["price"]); ?></td>
                  <td class="a2"><?php echo ($vol["product_num"]); ?></td>
                  <td class="a2"><?php echo ($vol["total_price"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
          </div>
          <!--s_par4--> 
        </div>
        <!--orderDetail--> 
      </td>
    </tr>
    <tr>
    
    <?php if($orderDetail["status"] == 3 or $orderDetail["status"] == 4 or $orderDetail["status"] == 5): ?><tr style="height:36px;">
      <td style="text-align:left"> 物流公司
         真善美&nbsp;&nbsp;
        ---运单号<?php echo ($orderDetail["transport_code"]); ?></td>
    </tr><?php endif; ?>
      <tr style="height:36px;">
      <td style="text-align:left">配送费： <?php echo ($orderDetail["express_fee"]); ?> 元 &nbsp;&nbsp;总价（包括配送费）：<?php echo ($orderDetail["total"]); ?>元&nbsp;&nbsp;
        <?php if($orderDetail["status"] != 1): ?>使用的积分：<?php echo ($orderDetail["points_reduce"]); ?>&nbsp;&nbsp;
          实际付款：<?php echo ($orderDetail["need_pay"]); ?>元&nbsp;&nbsp;
          &nbsp;&nbsp;获得的积分：：<?php echo ($orderDetail["points_add"]); endif; ?>
      </td>
    </tr>
     <?php if($orderDetail["status"] == 2 ): ?><tr style="height:36px;">
        <td style="text-align:left">
          <form action="__APP__/order/send_out_goods/order_id/<?php echo ($_GET['order_id']); ?>" method="post" name="form">
            配送公司：
            <select name="transport_company">
              <option value="zsm">真善美</option>
              <!--<option value="zhongtong">中通</option>
              <option value="yunda">韵达</option>
              <option value="yuantong">圆通</option>
              <option value="shunfeng">顺丰</option>
              <option value="ems">EMS</option>-->
            </select>
            &nbsp;&nbsp;  运单号：
            <input name="transport_code" type="text"  class="input1"/>
            <?php if(is_array($order_product)): $i = 0; $__LIST__ = $order_product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (mb_substr($vol["title"],0,10,'utf-8')); ?>&nbsp;批号：
              <input name="serial_number_<?php echo ($vol["product_id"]); ?>" type="text"  class="input1"/><?php endforeach; endif; else: echo "" ;endif; ?>
          </form>
        </td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><a class="button1" onclick="form.submit(); " >发货</a> <a class="button1" href="__APP__/order/orderDetailFunEnd_order/order_id/<?php echo ($orderDetail["order_id"]); ?>" >结束订单</a></td>
      </tr><?php endif; ?>
    


    
    
  </table>
</div>
</body>
</html>