<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo ($top_content["title"]); ?></title>
<meta name="Keywords" content="<?php echo ($top_content["keywords"]); ?>" />
<meta name="Description" content="<?php echo ($top_content["description"]); ?>" />
<link rel="stylesheet" href="__PUBLIC__css/base.css">
<link rel="stylesheet" href="__PUBLIC__css/main.css">
<link rel="stylesheet" href="__PUBLIC__css/other.css">
<link rel="stylesheet" href="__PUBLIC__css/cssforml.css">
<script style="text/javascript" src="__PUBLIC__js/jquery-1.11.0.js"></script>
<script style="text/javascript" src="__PUBLIC__js/rich_lee.js"></script>
</head>
<script type="text/javascript">
	$(function(){
 		nav_down();//
	});
		
	</script>
<body>
<!-- top --> 
<link rel="shortcut icon" href="/favicon.ico"/>
<div class="side">
  <ul>
    <li><a href="/newsmanu/newsmanu/id/124">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon01.png">客服中心</div>
      </a></li>
    <li><a href="/newsmanu/newsmanu/id/124">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon02.png">客户案例</div>
      </a></li>
    <li><a href="tencent://message/?uin=<?php echo ($top_content["qq"]); ?>&Site=真善美&Menu=yes">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon04.png">QQ客服</div>
      </a></li>
    <li><a href="<?php echo ($top_content["weibo"]); ?>">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon03.png">新浪微博</div>
      </a></li>
    <li style="border:none;"><a  onclick="move()"  class="sidetop"><img src="__PUBLIC__img/side_icon05.png"></a></li>
  </ul>
</div>
<script type="text/javascript"> 
function move()
{
    $('html,body').animate({scrollTop:0},500);
}

</script>
 <link rel="stylesheet" href="__PUBLIC__css/style.css">
<div class="top_index" id="top">
  <div class="top_index_middle">
    <div class="top_index_left">
      <ul>
        <li>
          <?php if($_SESSION['user_id'] != null): ?><span style="color:#069"><?php echo ($top["name"]); ?> </span><?php endif; ?>
          您好，欢迎来到单体药店网！</li>
        <?php if($_SESSION['user_id'] == null): ?><li><a href="/account/login">请登录</a></li>
          <li><a href="/account/register">免费注册</a></li><?php endif; ?>
        <?php if($_SESSION['user_id'] != null): ?><li><a href="/account/logout" style="color:#999">[退出]</a></li><?php endif; ?>
      </ul>
    </div>
    <div class="top_index_right">
      <ul>
        <?php if($_SESSION['user_id'] != null): ?><li class="top_index_right_per"> <span></span><!-- 这个span是小图标不能删 --> 
            <a href="/order/orderList">个人中心</a> </li>
          <li class="top_index_right_favor"> <span></span><!-- 这个span是小图标不能删 --> 
            <a href="/ordermanage/my_collection/">收藏夹</a> </li><?php endif; ?>
        <li class="top_index_right_app"> <span></span><!-- 这个span是小图标不能删 --> 
          <a href="/newsmanu/newsmanu/id/74">手机APP</a> </li>
        <li class="top_index_right_contact"> <span></span><!-- 这个span是小图标不能删 --> 
          <a href="tencent://message/?uin=<?php echo ($top_content["qq"]); ?>&Site=真善美&Menu=yes">联系客服</a> </li>
      </ul>
    </div>
  </div>
</div>
<!-- topend --> 
<!-- search --> <div class="search_index">
  <div class="search_index_left"> 
     <div><a href="/"> <img src="__PUBLIC__images/logo.png" alt="真善美"> </a></div>
     <div style="text-align:right">渝B20160001</div>
   </div>
  <div class="search_index_middle">
    <div class="search_index_form">
     <form action="/shop/shopList" method="get" name="search_form">     
     <input type="text" class="search_index_text" placeholder="请输入商品名称\批准文号\厂家\适应症" name='keyword'>
      <input type="button" class="search_index_button" value="搜索"  onclick="search_form.submit()" >
      </form>
    </div>
    <ul class="search_index_hot">
    <?php if(is_array($top_content["search_keyword"])): $i = 0; $__LIST__ = $top_content["search_keyword"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li> <a href="/shop/shopList/keyword/"><?php echo ($vol); ?></a> <span>|</span> </li><?php endforeach; endif; else: echo "" ;endif; ?> 
     </ul>
  </div>
   <script type="text/javascript">
     function search_encodeURI(){
		 var i;
	 	 for( i=0;i<$('.search_index_hot a').length;i++){
			   var html=encodeURI($('.search_index_hot a').eq(i).html());
			   html="/shop/shopList/keyword/"+html;
			   $('.search_index_hot a').eq(i).attr('href',html);
 			 }
 	    }
        search_encodeURI()
     </script>
   <div class="search_index_right"> <a href="/ordermanage/shop_cart">
    <p> <span class="search_index_right_car"></span> 
      <!-- 这个span是小图标不能删 --> 
      我的购物车 </p>
    </a> <span class="search_index_right_number"><?php echo ($shopping_cart_sum); ?></span> </div>
</div>
<div class="content i_orderDetail"> <div class="my_box_nav">
  <div class="my_box_posi">
    <?php if(is_array($top_class)): $i = 0; $__LIST__ = $top_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><div class="sub_nav">
        <?php if(is_array($vol["class_1"])): $i = 0; $__LIST__ = $vol["class_1"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><ul class="sub_content">
            <li class="sub_title"> <a href="/shop/shopList?class1=<?php echo ($vol["product_classify_id"]); ?>&class2=<?php echo ($vol2["product_classify_id"]); ?>"><?php echo (mb_substr($vol2["title"],0,4,'utf-8')); ?></a> </li>
            <li class="sub_nav_box">
              <?php if(is_array($vol2["class_2"])): $i = 0; $__LIST__ = $vol2["class_2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol3): $mod = ($i % 2 );++$i;?><a href="/shop/shopList?class1=<?php echo ($vol["product_classify_id"]); ?>&class2=<?php echo ($vol2["product_classify_id"]); ?>&class3=<?php echo ($vol3["product_classify_id"]); ?>"><?php echo ($vol3["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
          </ul><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
      <!--sub_nav--><?php endforeach; endif; else: echo "" ;endif; ?>
    <!--下拉菜单结束-->
    <div class="nav_index_left">
      <dl>
        <dt>全部商品分类</dt>
        <?php if(is_array($top_class)): $i = 0; $__LIST__ = $top_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dd> <span></span><!-- 这个span是小图标不能删 -->
            <h2><a href="/shop/shopList?class1=<?php echo ($vol["product_classify_id"]); ?>"><?php echo ($vol["title"]); ?></a></h2>
            <ul>
              <?php if(is_array($vol["class_1"])): $i = 0; $__LIST__ = array_slice($vol["class_1"],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><li><a href="/shop/shopList?class1=<?php echo ($vol["product_classify_id"]); ?>&class2/<?php echo ($vol2["product_classify_id"]); ?>"><?php echo (mb_substr($vol2["title"],0,4,'utf-8')); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </dd><?php endforeach; endif; else: echo "" ;endif; ?>
        <script type="text/javascript">
     $('.nav_index_left dd').eq(0).attr('class','nav_index_left_first');
     $('.nav_index_left dd').eq(1).attr('class','nav_index_left_second');
     $('.nav_index_left dd').eq(2).attr('class','nav_index_left_third');
     $('.nav_index_left dd').eq(3).attr('class','nav_index_left_fourth');
     $('.nav_index_left dd').eq(4).attr('class','nav_index_left_fifth');
     $('.nav_index_left dd').eq(5).attr('class','nav_index_left_sixth');
</script>
      </dl>
    </div>
  </div>
</div>
<div class="nav_index_banner">
  <ul class="center_nav">
    <li><a href="/">首页</a></li>
    <li><a href="/shop/shopList">药品超市</a></li>
    <li><a href="/company/company">金牌厂家</a></li>
    <li><a href="/newslist/newslist">医药资讯</a></li>
    <li><a href="/newsmanu/newsmanu/id/72">帮助中心</a></li>
    <li><a href="/shop/discount">团购</a></li>
  </ul>
</div>

  <div class="weiz">您的位置：<a href="/">首页</a> <i>|</i> <a href="/order/orderList">订单列表</a> <i>|</i> 订单详情 <i>|</i> <span>TERMS OF PAYMENT</span> </div>
  <div class="s_part1">
    <div class="h1">
      <div class="a1 p">拍下商品</div>
      <div class="a2 p">付款</div>
      <div class="a3 p">卖家发货</div>
      <div class="a4 p">确认收货</div>
      <div class="a5 p">评价</div>
      <div class="clearx"></div>
    </div>
    <!--h1-->
    <div class="h3">
      <?php if($orderDetail["status"] == 1): ?><img src="__PUBLIC__images/a4.jpg">
        <?php elseif($orderDetail["status"] == 2): ?>
        <img src="__PUBLIC__images/a5.jpg">
        <?php elseif($orderDetail["status"] == 3): ?>
        <img src="__PUBLIC__images/a6.jpg">
        <?php elseif($orderDetail["status"] == 4): ?>
        <img src="__PUBLIC__images/a7.jpg">
        <?php elseif($orderDetail["status"] == 5): ?>
        <img src="__PUBLIC__images/a8.jpg"><?php endif; ?>
    </div>
    <div class="h2">
      <div class="a1 p"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time"])); ?></div>
      <div class="a2 p"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time2"])); ?></div>
      <div class="a3 p"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time3"])); ?></div>
      <div class="a4 p"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time4"])); ?></div>
      <div class="a5 p"><?php echo (date('Y年m月d日 H:i:s',$orderDetail["time5"])); ?></div>
      <div class="clearx"></div>
    </div>
    <!--h2--> 
  </div>
  <!--s_part1-->
  <div class="s_part2">
    <div class="L">
      <div class="ti">订单信息</div>
      <div class="co">
        <div class="h">
          <div class="iL">收货地址</div>
          <div class="iR">
            <?php if($orderDetail["confirm"] == 2): ?>地址&nbsp;<?php echo ($receiving_address["city1"]); echo ($receiving_address["city2"]); echo ($receiving_address["city3"]); echo ($receiving_address["address"]); ?>&nbsp;&nbsp;&nbsp;邮编&nbsp;<?php echo ($receiving_address["postcode"]); ?>&nbsp;&nbsp;&nbsp;收货人&nbsp;<?php echo ($receiving_address["name"]); ?>&nbsp;&nbsp;&nbsp;电话&nbsp;<?php echo ($receiving_address["mobile_phone"]); ?> &nbsp;&nbsp;&nbsp;  座机&nbsp;<?php echo ($receiving_address["quhao"]); ?>- <?php echo ($receiving_address["mobile_phone"]); ?> <a href="/ordermanage/receiving_address">地址修改</a>
              <?php else: ?>
              <?php echo ($orderDetail["real_address"]); endif; ?>
          </div>
          <div class="clearx"></div>
        </div>
        <!--h-->
        <div class="h">
          <div class="iL">订单编号</div>
          <div class="iR"><?php echo ($orderDetail["order_num"]); ?></div>
          <div class="clearx"></div>
        </div>
        <!--h--> 
      </div>
      <!--co-->
      <div class="code" style="display:none">
        <div class="iL"><img src="__PUBLIC__images/a10.jpg"></div>
        <div class="iR">查物流，评价，晒图，一手搞定</div>
        <div class="clearx"></div>
      </div>
    </div>
    <!--L-->
    <div class="R">
      <div class="h1">订单状态：
        <?php if($orderDetail["confirm"] == 2): ?>待确认订单
          <?php elseif($orderDetail["status"] == 1 and $orderDetail["confirm"] != 2): ?>
          待付款
          <?php elseif($orderDetail["status"] == 2): ?>
          买家已经付款，等待商家发货
          <?php elseif($orderDetail["status"] == 3): ?>
          商家已经发货，等待买家确认
          <?php elseif($orderDetail["status"] == 4): ?>
          买家已经确认，等待买家评论
          <?php elseif($orderDetail["status"] == 5): ?>
          交易全部完成<?php endif; ?>
      </div>
      <?php if($orderDetail["status"] == 3): ?><div class="h2">还有<span><?php echo ($remainingTime); ?></span>秒来确认收货,超时订单自动确认收货</div>
        <!--h2--><?php endif; ?>
      <?php if($orderDetail["status"] != 1 and $orderDetail["status"] != 2): ?><div class="h3">
          <div class="iL">物流： </div>
          <div class="iR">  
           真善美&nbsp;&nbsp;&nbsp;
           配送运单号:<?php echo ($orderDetail["transport_code<!--"]); ?> <a href="__APP__/logistics/logistics/transport_company/<?php echo ($orderDetail["transport_company"]); ?>/transport_code/<?php echo ($orderDetail["transport_code"]); ?>/order_id/<?php echo ($orderDetail["order_id"]); ?>" target="_new">物流详情</a>--><br>
            </div>
          <div class="clearx"></div>
        </div>
        <!--h3--><?php endif; ?>
      <div class="h4">
        <?php if($orderDetail["confirm"] == 2 ): ?><form action="/order/orderDetailFunConfirm/order_id/<?php echo ($_GET['order_id']); ?>" method="post" enctype="multipart/form-data" name="confirm" >
            <div>您可以 <a class="a1" onClick="confirm.submit()" style=" cursor:pointer">确认订单</a></div>
             <?php if($coupon != null): ?><div style="margin-top:10px;">
                <?php if(is_array($coupon)): $i = 0; $__LIST__ = $coupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><div style="line-height:30px; font-size:14px">
                    <input name="coupon_id[]" type="checkbox" value="<?php echo ($vol["coupon_id"]); ?>asd">
                    优惠券 <span style="color:#F00; font-size:16px"><?php echo ($vol["num"]); ?></span>元  有效期 <?php echo (date('Y年m月d日 ',$vol["begtime"])); ?> 至 <?php echo (date('Y年m月d日 ',$vol["endtime"])); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
                备注：优惠券不找零 </div><?php endif; ?>
          </form><?php endif; ?>
        <?php if($orderDetail["status"] == 1 and $orderDetail["confirm"] != 2 ): ?>您可以 <a href="/order/orderDetail_2/order_id/<?php echo ($_GET['order_id']); ?>" class="a1">去付款</a> <a href="/order/orderListFunorderDel/order_id/<?php echo ($_GET['order_id']); ?>">取消订单</a><?php endif; ?>
        <?php if($orderDetail["status"] == 3): ?>您可以 <a href="/order/orderDetail4_mid/order_id/<?php echo ($_GET['order_id']); ?>" class="a1">确认收货</a><?php endif; ?>
      </div>
    </div>
    <!--R-->
    <div class="clearx"></div>
  </div>
  <!--s_part2-->
  <div class="s_part3">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr class="h1">
          <td class="a1">商品 </td>
          <td class="a2">状态</td>
          <td class="a3">商品操作</td>
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
              </div>
              <div class="clear"></div>
              </a></td>
            <td class="a2"><?php if($orderDetail["status"] == 1): ?>待付款
                <?php elseif($orderDetail["status"] == 2): ?>
                待发货
                <?php elseif($orderDetail["status"] == 3): ?>
                待确认
                <?php elseif($orderDetail["status"] == 4): ?>
                <?php if($vol["is_have_comment_right"] == 1): ?>未评价
                  <?php else: ?>
                  已评价<?php endif; ?>
                <?php elseif($orderDetail["status"] == 5): ?>
                已经评价<?php endif; ?></td>
            <td class="a3"><?php if($orderDetail["status"] == 1): ?>-
                <?php elseif($orderDetail["status"] == 2 and vol.is_return != 1): ?>
                <a href="/return/return_one/order_id/<?php echo ($_GET['order_id']); ?>/product_id/<?php echo ($vol["product_id"]); ?>">退款/退货</a>
                <?php elseif($orderDetail["status"] != 1 and $vol["is_return"] != 1 and $orderDetail["status"] != 2): ?>
                <a href="/return/return_one/order_id/<?php echo ($_GET['order_id']); ?>/product_id/<?php echo ($vol["product_id"]); ?>">退款/退货</a><?php endif; ?>
              <?php if($vol["is_return"] == 1): ?><a href="/return/return_two/order_id/<?php echo ($_GET['order_id']); ?>/product_id/<?php echo ($vol["product_id"]); ?>">退款/退货处理中</a><?php endif; ?>
              <?php if($vol["is_return"] == 2): ?>退货已经完成<?php endif; ?>
               <?php if($vol["is_have_comment_right"] == 1 ): ?><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>/order_id/<?php echo ($_GET['order_id']); ?>">去评价</a><?php endif; ?></td>
            <td class="a2"><?php echo ($vol["price"]); ?></td>
            <td class="a2"><?php echo ($vol["product_num"]); ?></td>
            <td class="a2"><?php echo ($vol["total_price"]); ?></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
  </div>
  <!--s_part3-->
  <div style="text-align:right; color:#F00"><?php echo ($orderDetail["remark"]); ?> &nbsp;&nbsp;1积分等于  <?php echo ($system["use_cash"]); ?> 分 人民币- 消费1元人民币  获得  <?php echo ($system["get_cash"]); ?> 积分</div>
  <div class="s_part4"> 配送费： <?php echo ($orderDetail["express_fee"]); ?> 元 &nbsp;&nbsp;总价（包括配送费）：<span class="a3"><?php echo ($orderDetail["total"]); ?></span>元&nbsp;
    <?php if($orderDetail["status"] == 4 or $orderDetail["status"] == 5): ?>获得的积分为 <?php echo ($orderDetail["points_add"]); endif; ?>
    <?php if($orderDetail["confirm"] == 2): ?>可以使用的积分：<span class="a4"><?php echo ($data_points); ?> </span> <span class="a1">需付款：</span> <span class="a2"></span><span class="a1">元</span><?php endif; ?>
    <?php if($orderDetail["confirm"] != 2): ?>使用的积分：<?php echo ($orderDetail["points_reduce"]); ?> <span class="a1">实际付款</span> <span class="a2"><?php echo ($orderDetail["need_pay"]); ?></span> <span class="a1">元</span><?php endif; ?>
    <script type="text/javascript">
		 <?php if($orderDetail["confirm"] == 2): ?>if(  $('.i_orderDetail .s_part4 .a3').html()-$('.i_orderDetail .s_part4 .a4').html()*<?php echo ($system["use_cash"]); ?>/100 >0){
	       $('.i_orderDetail .s_part4 .a2').html( $('.i_orderDetail .s_part4 .a3').html()-$('.i_orderDetail .s_part4 .a4').html()*<?php echo ($system["use_cash"]); ?>/100   )
	   }
   else{
	    $('.i_orderDetail .s_part4 .a2').html(0)
	  }<?php endif; ?>
 </script> 
    
    <!--配送费： 22 元   总价（包括配送费）：121元   使用的积分：0      获得的积分：：121 <span class="a1">实际付款</span>：<span class="a2">121</span><span class="a1">元</span> --> 
    
  </div>
  <!--s_part4--> 
</div>
<div class="footer">
		<dl>
			<dd>
				<h2>消费者保障</h2>
				<a href="/newsmanu/newsmanu/id/121">网购警示</a>
				<a href="/newsmanu/newsmanu/id/122">隐私保护</a>
				<a href="/newsmanu/newsmanu/id/123">投诉维权</a>
				<a href="/newsmanu/newsmanu/id/124">客服中心</a>
			</dd>
			<dd>
				<h2>新手上路</h2>
				<a href="/newsmanu/newsmanu/id/111">订单状态</a>
				<a href="/newsmanu/newsmanu/id/112">购物流程</a>
				<a href="/newsmanu/newsmanu/id/113">用户注册</a>
				<a href="/newsmanu/newsmanu/id/114">订购方式</a>
			</dd>
			<dd>
				<h2>配送方式</h2>
				<a href="/newsmanu/newsmanu/id/101">商品签收</a>
				<a href="/newsmanu/newsmanu/id/102">配送网点</a>
			</dd>
			<dd>
				<h2>售后服务</h2>
				<a href="/newsmanu/newsmanu/id/91">退换货保障</a>
				<a href="/newsmanu/newsmanu/id/92">发票制度</a>
				<a href="/newsmanu/newsmanu/id/93">服务承诺</a>
				<a href="/newsmanu/newsmanu/id/94">快递查询</a>
			</dd>
			<dd>
				<h2>支付方式</h2>
				<a href="/newsmanu/newsmanu/id/81">银行转账&汇款</a>
				<a href="/newsmanu/newsmanu/id/82">网上银行支付</a>
				<a href="/newsmanu/newsmanu/id/83">货到付款</a>
			</dd>
			<dd>
				<h2>帮助中心</h2>
				<a href="/newsmanu/newsmanu/id/71">找回密码</a>
				<a href="/newsmanu/newsmanu/id/72">常见问题</a>
				<a href="/newsmanu/newsmanu/id/73">用户协议</a>
				<a href="/newsmanu/newsmanu/id/74">关于单体</a>
			</dd>
			<dt  style="display:none">
				<img src="__PUBLIC__images/footer_mark.png"/>
				<span>微信公众号</span>
			</dt>
		</dl>
		<P>互联网药品信息服务资格证编号：(渝)-非经营性-2013-0008 &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate1.jpg" target="_new" style="color:#06C">互联网药品交易服务资格证编号</a>&nbsp;&nbsp;备案号: <a href="http://www.miitbeian.gov.cn/" target="_new" style="color:#06C">渝ICP备15010503号</a><br />
©2015-2025 单体药店网版权所有  重庆真善美医药有限公司 design by cqtiandu.com &nbsp;   &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate2.jpg" target="_new" style="color:#06C">药品经营质量管理规范认证证书</a> &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate3.jpg" target="_new" style="color:#06C">公司营业执照</a> &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate4.jpg" target="_new" style="color:#06C">药品经营许可证</a> </P>
		<ul>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img01.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img02.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img03.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img04.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img05.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img06.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img07.png"  />
				</a>
			</li>
		</ul>
	</div>
    
    
    <style type="text/css">
 .feny{ text-align:center; line-height:18px; height:18px; margin:10px 0px;  font-size:12px }
 .feny a{ display:inline-block;  height:25px; line-height:25px; text-align:center; border:1px solid #eeeeee; padding:0px 5px; }
 .feny span{ display:inline-block;  height:25px; line-height:25px; text-align:center;border:1px solid #3b93de; background:#3b93de;color:#FFF;padding:0px 5px; }


</style>

    
    
    
    
    
    
    
    
    
    
</body>
</html>