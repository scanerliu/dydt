<?php if (!defined('THINK_PATH')) exit();?>                                           <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>收货地址-<?php echo ($top_content["title"]); ?></title>
<meta name="Keywords" content="<?php echo ($top_content["keywords"]); ?>" />
<meta name="Description" content="<?php echo ($top_content["description"]); ?>" />
	<link rel="stylesheet" href="__PUBLIC__css/base.css">
	<link rel="stylesheet" href="__PUBLIC__css/main.css">
	<link rel="stylesheet" href="__PUBLIC__css/other.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__css/L_person.css">
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
       		<span>订单管理</span>
       		<p>the order management</p> 
       		<p class="crumbs02">收货地址</p>
       </div>
       <div class="crumbs_nav">
       <dl>
              <dt><a href="#">账号管理</a></dt>
              <dd><a href="/userinfo/info">会员信息</a></dd>
              <dd><a href="/userinfo/alter_pwd">修改登录密码</a></dd>
              <dd><a href="/userinfo/authentication">购买认证</a></dd>
       </dl>
       <dl>
              <dt><a >订单管理</a></dt>
              <dd><a href="/ordermanage/shop_cart">购物车</a></dd>
              <dd><a href="/return/return_list">退款/退货</a></dd>
              <dd><a href="/order/orderList">我的订单</a></dd>
              <dd><a href="/ordermanage/receiving_address">收货地址</a></dd>
              <dd><a href="/ordermanage/my_collection/">我的收藏</a></dd>
              <dd><a href="/ordermanage/browse_record">浏览记录</a></dd>
       </dl>
       <dl>
              <dt><a href="#">互动管理</a></dt>
              <dd><a href="/manage/suggest">投诉建议</a></dd>
              <dd><a href="/manage/evaluate">我的评价</a></dd>
              <dd><a href="/manage/integration">我的积分</a></dd>
       </dl>
</div>
       <!--
       	作者：rich_lee
       	描述：面包屑 面包屑导航 完成
       -->


       <!-- 收货地址 -->
       <div class="L_adress">
       		<dl>
       			<dt>收货地址</dt>
	       			<dd class="add_new">
	       					<!-- <a id="add_f" style="cursor: pointer;" onclick="add()">新增收货地址</a> -->
	       					电话号码、手机号码选填一项其余均为必填项
	       			</dd>
	       			<form id="add_form" method="post" action="<?php echo U('ordermanage/save_receiving_address');?>">
	       				<dd class="add_area">
	       					<label>所在地区：</label>
	       					<?php if(($address['city1'] == '') or ($address['city2'] == '') or ($address['city3'] == '')): ?><select id="s_province" name="s_province"></select>
							    <select id="s_city" name="s_city"></select>
							    <select id="s_county" name="s_county"></select>
						    <?php else: ?>
							    <div id="spanposition" >
							    	<label id="l_province" name="province"><?php echo ($address["city1"]); ?></label>
							    	<label id="l_city" name="city"><?php echo ($address["city2"]); ?></label>
							    	<label id="l_county" name="county"><?php echo ($address["city3"]); ?></label>
							    	<label><a style="color:red;cursor:pointer;" onclick="edit()">修改</a></label>
							    </div>
							    <div id="iptposition" style="display:none">
							    	<select id="s_province" name="s_province"></select>
								    <select id="s_city" name="s_city" ></select>
								    <select id="s_county" name="s_county"></select>
								    <img style="margin-left:10px" src="__PUBLIC__images/L_dot.png">
								</div><?php endif; ?>
			       			<!-- <select id="s_province" name="s_province"></select>
						    <select id="s_city" name="s_city" ></select>
						    <select id="s_county" name="s_county"></select> -->
						    <script class="resources library" src="__PUBLIC__js/area.js" type="text/javascript"></script>
	    					<script type="text/javascript">_init_area();</script>
	       			</dd>
	       			<dd class="detail_ad">
	       				<label>详细地址</label>
	       				<textarea name="address" required="required" placeholder="建议您如实填写详细地址，例如街道名称，门牌号码，楼层和房间号等信息"><?php echo ($address["address"]); ?></textarea>
	       				<img style="margin-left:10px" src="__PUBLIC__images/L_dot.png">
	       			</dd>
	       			<dd>
	       				<label>邮政编码</label>
	       				<input type="text" name="postcode" required="required" placeholder="若您不清楚邮递区号，请填写000000" value="<?php echo ($address["postcode"]); ?>">
	       				<img style="margin-left:10px" src="__PUBLIC__images/L_dot.png">
	       			</dd>
	       			<dd>
	       				<label>收货人姓名</label>
	       				<input type="text" name="name" required="required" placeholder="长度不可超过25个字符" value="<?php echo ($address["name"]); ?>">
	       				<img style="margin-left:10px" src="__PUBLIC__images/L_dot.png">
	       			</dd>
	       			<dd>
	       				<label>手机号码</label>
	       				<input type="text" name="mobile_phone" required="required" id="phonenumber" placeholder="请输入正确的手机号码格式" value="<?php echo ($address["mobile_phone"]); ?>">
	       				<img style="margin-left:10px" src="__PUBLIC__images/L_dot.png">
	       			</dd>
					<script>
					 var phonenumber = document.getElementById("phonenumber");
					 var mobile = parseInt(phonenumber.value);
						phonenumber.onblur =  function(){
						
        if(phonenumber.value.length==0)
        {
			alert('不允许为空！');
           phonenumber.focus();
           return false;
        }    
        if(phonenumber.value.length!=11)
        {
            alert('手机号码的长度为11位！');
            phonenumber.focus();
            return false;
        }
        
        var myreg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
        if(!myreg.test(phonenumber.value))
        {
            alert('请输入有效的手机号码！');
            phonenumber.focus();
            return false;
        }
    }
					</script>
	       			<dd class="table_phone">
	       				<label>座机号码</label>
	       				<input type="text" placeholder="区号" name="quhao" value="<?php echo ($address["quhao"]); ?>">
	       				<b>-</b>
	       				<input type="text" placeholder="电话号码" name="home_phone" value="<?php echo ($address["home_phone"]); ?>">
	       				<img style="margin-left:10px" src="__PUBLIC__images/L_dot.png">
	       			</dd>
	       			<!-- <dd class="design_common">
	       				<input type="checkbox" value="1" name="moren">
						设置为默认
	       			</dd> -->
	       			<dd>
	       				<input class="getgoods_save" type="submit" name="" id="" value="保存" />
	       			</dd>
       			</form>
       		</dl>
       		<!-- <div class="had_adress">
       			<?php $ot = 10-$count;?>
       			<div class="ad_limit">已保存了<?php echo ($count); ?>条地址，还能保存<?php echo ($ot); ?>条地址</div>
       			<div class="had_sheet_head">
       				<label class="hadad_label1">收货人</label>
       				<label class="hadad_label2">所在地区</label>
       				<label class="hadad_label3">详细地址</label>
       				<label class="hadad_label4">邮编</label>
       				<label class="hadad_label5">手机/电话</label>
       				<label class="hadad_label6">操作</label>
       			</div>
       			<ul>
       			<?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="getgood_firstli">
       					<div class="get_porson"><?php echo ($vo["name"]); ?></div>
       					<div class="where"><?php echo ($vo["city1"]); ?> <?php echo ($vo["city2"]); ?> <?php echo ($vo["city3"]); ?></div>
       					<div class="detail_adress"><?php echo ($vo["address"]); ?></div>
       					<div class="zip_code"><?php echo ($vo["postcode"]); ?></div>
       					<div class="phone"><?php echo ($vo["mobile_phone"]); ?></div>
       					<div class="operate">
       						<a href="#">修改</a>
       						<label>|</label>
       						<a href="<?php echo U('ordermanage/delete_address' ,array('id' => $vo['id']));?>">删除</a>
       					</div>
       					<?php if($vo["moren"] == 1): ?><div class="mo_sure"><a style="background-color:#28FF28;color:#FFFFFF;">默认地址</a></div>
       					<?php else: ?>
       						<div class="mo_sure"><a href="<?php echo U('ordermanage/moren_address',array('id' => $vo['id']));?>">默认地址</a></div><?php endif; ?>
       				</li><?php endforeach; endif; else: echo "" ;endif; ?>
       			</ul>
       		</div> -->
       </div>
       <!-- 收货地址-结束 -->

	<script type="text/javascript">

		// function add () {
		// 	if($("#add_form").css("display")=="none"){
		// 		$("#add_form").show();
		// 	}else{
		// 		$("#add_form").hide();
		// 	}
		// }

		function edit() {
			document.getElementById("spanposition").style.display="none";//隐藏
			document.getElementById("iptposition").style.display="block";//显示
			// document.getElementById("s_county").style.visibility="visible";//显示
		}

		var Gid  = document.getElementById ;
		var showArea = function(){
			Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" + 	
			Gid('s_city').value + " - 县/区" + 
			Gid('s_county').value + "</h3>"
		}
		Gid('s_county').setAttribute('onchange','showArea()');
	</script>  
	</div>	
	<!--
    	作者：rich
    	描述：friend ++ content end
    -->	
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