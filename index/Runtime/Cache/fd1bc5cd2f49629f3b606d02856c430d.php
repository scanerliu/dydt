<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>退货第一步</title>
	<link rel="stylesheet" href="__PUBLIC__css/base.css">
	<link rel="stylesheet" href="__PUBLIC__css/main.css">
		<!--<link rel="stylesheet" href="css/other.css">-->
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
<!-- search -->
<!-- topend -->
<!-- search -->
	<div class="search_index">
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
<!-- searchend -->
<!-- nav -->
	<div class="content">
		<div class="my_box_nav">
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

		<!--
        	作者：rich
        	时间：2015-10-21
        	描述：banner右侧
        -->	
       <div class="crumbs">
       		<span>您的位置：</span>
       		<h6>首页</h6>
       		<h6>退款/退货</h6>
       		<p>refund/return</p>   	
       </div>
       <table class="return_tb">
       		<tr>
       			<td>买家申请退款</td>
       			<td>商家 处理退款申请</td>
       			<td>退款完成</td>
       		</tr>
       		<tr>
       			<td colspan="3" class="row3" style="width:100%"><img src="__PUBLIC__images/return01.png" alt=""></td>
       		</tr>
       </table>
       
    	<div class="return_content">
    		<table class="return_content_left">
    			<tr class="return_tr_first">
    				<td class="return_td_first">商品信息</td>
    				<td class="return_td_secend">单价</td>
    				<td class="return_td_third">小计</td>
    				<td class="return_td_fouth">商家</td>
    			</tr>
    			<tr class="return_tr_secend">
    				<td class="return_td02_first clear">
    					<img style="width:60px;height:60px;" src="/Uploads/<?php echo ($list["img"]); ?>" alt="">
    					<div class="return_td02_first_text">
    						<h3><?php echo ($list_p["title"]); ?></h3>
    						<p><?php echo ($list_p["subhead"]); ?></p>
    					</div>
    				</td>
    				<td class="return_td02_secend"><?php echo ($list["price"]); ?> 元</td>
    				<td class="return_td02_third"><?php echo ($list["product_num"]); ?></td>
    				<td class="return_td02_fourth">单体药店专卖网</td>
    			</tr>
    			<tr class="return_tr_first">
    				<td colspan="4">订单信息</td>
    			</tr>
    			<tr class="return_tr_third">
    				<td colspan="2">订单编号：<?php echo ($list_or["order_num"]); ?></td>
    				<td colspan="2">运费：<?php echo ($list_or["express_fee"]); ?> 元</td>
    			</tr>
    			<tr class="return_tr_third">
    				<td colspan="2">总优惠：-12元</td>
    				<td colspan="2">成交时间：<?php echo (date('Y-m-d H:i:s',$list_or["time"])); ?></td>
    			</tr>
    			<tr class="return_tr_third">
    				<td colspan="4">总计：<?php echo ($list["total_price"]); ?>元</td>
    			</tr>
    		</table>
    		<div class="return_content_right2">
    			<p class="title_secend_return">等待商家处理申请</p>
    			<h6 class="first_h6">如果商家同意，退货申请将达成需要您退货给商家</h6>
    			<h6>如果商家拒绝，将需要您修改退货申请</h6>
    		</div>

    	</div>
    	
       
       
       
       
	</div>	
	<!--
    	作者：rich
    	描述：friend ++ content end
    -->	
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