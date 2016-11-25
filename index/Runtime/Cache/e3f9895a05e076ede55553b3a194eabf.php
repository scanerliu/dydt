<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购买认证-真善美</title>
	<link rel="stylesheet" href="__PUBLIC__css/base.css">
	<link rel="stylesheet" href="__PUBLIC__css/main.css">
	<link rel="stylesheet" href="__PUBLIC__css/other.css">
	<link rel="stylesheet" type="text/css" media="all" href="__PUBLIC__css/style1.css">
	<link rel="stylesheet" type="text/css" media="all" href="__PUBLIC__css/style.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__css/L_person.css">
	<script style="text/javascript" src="__PUBLIC__js/jquery-1.11.0.js"></script>	
	<script style="text/javascript" src="__PUBLIC__js/rich_lee.js"></script>
	<script type="text/javascript" src="__PUBLIC__js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__js/jquery.leanModal.min.js"></script>
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
       		<span>账号管理</span>
       		<p>the account management</p> 
       		<p class="crumbs02">购买认证</p>
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
<!-- 购买认证 -->
<div class="L_member_infor">
	<form>
    <div class="buy_identify">
       <dl>
       	<dt>购买认证</dt>
       	<?php if($status == 1): ?><label style="margin-left:390px;color:red;">您已经上传并审核通过所有(必要)认证！</label>
		<?php elseif($status == 2): ?>
			<label style="margin-left:300px;color:red;">您还有没通过审核的(必要)认证！（上传所有(必要)认证并通过审核才能购买商品）</label>
		<?php else: ?>
			<label style="margin-left:300px;color:red;">您还有没上传的(必要)认证！（上传所有(必要)认证并通过审核才能购买商品）</label><?php endif; ?>
       	<?php if($doc_user != ''): ?><dd>
	       		<label class="label1">证件信息(<a style="color:red">红色为必要认证</a>)</label>
	       		<label class="label2">证件有效日期</label>
	       		<label class="label3">证件持有者姓名</label>
	       		<label class="label4">上传凭证</label>
	       	</dd>
	       	<dd>
	       		<ul>
		       		<?php if(is_array($doc_user)): $i = 0; $__LIST__ = $doc_user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$doc): $mod = ($i % 2 );++$i;?><li class="member_first_li">
		       				<div class="identify_infor">
			       				<?php if($doc["status"] == 0): ?><label style="margin-left:35px;margin-top:30px;" name="doc_type">
				       					<?php if($doc["m"] == 1): ?><a style="color:red"><?php echo ($doc["doc_type2"]); ?></a>
				       					<?php else: ?>
				       						<?php echo ($doc["doc_type2"]); endif; ?>
			       					</label>
			       					<label style="margin-left:46px;">(待审核...)</label>
			       				<?php elseif($doc["status"] == 1): ?>
			       					<label style="margin-left:35px;margin-top:30px;" name="doc_type">
				       					<?php if($doc["m"] == 1): ?><a style="color:red;"><?php echo ($doc["doc_type2"]); ?></a>
				       					<?php else: ?>
				       						<?php echo ($doc["doc_type2"]); endif; ?>
			       					</label>
			       					<label style="margin-left:46px;">(审核通过)</label>
			       				<?php else: ?>
			       					<label style="margin-left:35px;margin-top:10px;" name="doc_type">
				       					<?php if($doc["m"] == 1): ?><a style="color:red"><?php echo ($doc["doc_type2"]); ?></a>
				       					<?php else: ?>
				       						<?php echo ($doc["doc_type2"]); endif; ?>
			       					</label>
			       					<label style="font-size:8px;">(审核失败,请删除后重新上传)</label><?php endif; ?>
		       				</div>
		       				<?php if($doc["status"] == 2): ?><div style="width:270px;padding-left:10px;border-left:1px solid #dddddd;padding-top:22px">
			       					<a style="font-size:18px;color:#8E8E8E;">失败原因：</a><br>
			       					<a style="font-size:16px;margin-left:79px;color:#8E8E8E;"><?php echo ($doc["back"]); ?></a>
			       				</div>
			       			<?php else: ?>
			       				<div class="identify_uestime">
			       				<?php if($doc["er"] != ''): ?><label style="margin-left:39px;color:#db6969"><?php echo ($doc['get_date']); ?>~<?php echo ($doc['lose_date']); ?><br><?php echo ($doc["er"]); ?></label>
			       					<?php else: ?>
			       					<label style="margin-left:39px;"><?php echo ($doc['get_date']); ?>~<?php echo ($doc['lose_date']); ?><br><?php echo ($doc["er"]); ?></label><?php endif; ?>
			       				</div><?php endif; ?>
		       				<div class="identify_name">
		       					<label style="margin-left:50px;margin-top:35px;"><?php echo ($doc['name']); ?></label>
		       				</div>
			       			<div class="identify_upload">
			       				<img style="width:200px;height:100px;margin-left:39px;" src="/Uploads/<?php echo ($doc['img']); ?>">
			       				<a onClick="return confirm('确认要删除此认证吗,没有完整上传认证将无法购买商品！')" href="<?php echo U('userinfo/del_doc',array('id'=>$doc['id']));?>" style="width:80px;;margin-left:259px;margin-top:-66px;">删除</a>
			       			</div>
		       			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		       	</ul>
       		</dd><?php endif; ?>
   		<dd>
	   		<?php if(($st != 3)): ?><center><a href="#loginmodal" class="flatbtn" id="modaltrigger">上传</a></center><?php endif; ?>
		</dd>
       	</dl>
    </div>
    </form>

    <div id="loginmodal" style="display:none;">
		<h1>上传认证</h1>
		<form id="loginmodal" name="loginmodal" method="post" action="<?php echo U('userinfo/up');?>" enctype="multipart/form-data">
			<div class="buy_identify">
			    <dl>
			       	<dt class="buy_dt">购买认证<span>（以下信息必填，否则无法购买商品）</span></dt>
			       	<dd>
			       		<label class="label1">证件信息</label>
			       		<label class="label2">证件有效日期</label>
			       		<label class="label3">证件持有者姓名</label>
			       		<label class="label4">上传凭证</label>
			       	</dd>
			       	<dd>
			       		<ul>
			       			<li class="member_first_li">
			       				<div class="identify_infor">
			       					<select name="doc_type">
			       					<option>-请选择-</option>
				       					<?php if(is_array($doc_d)): $i = 0; $__LIST__ = $doc_d;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dd): $mod = ($i % 2 );++$i;?><option><?php echo ($dd["doc_type"]); if($dd["status"] == 1): ?>(必要)<?php endif; ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			       					</select>
			       				</div>
			       				<div class="identify_uestime">
			       					<input type="date" name="get_date" style="width:120px;height:18px;margin-left:0px;margin-top:33px;line-height:20px;padding:4px;" />
			       					<label>~</label>
			       					<input type="date" name="lose_date" style="width:120px;height:18px;line-height:20px;margin-left:0px;margin-top:33px;padding:4px;" />
			       				</div>
			       				<div class="identify_name">
			       					<input type="text" name="name" placeholder="请填写持有者姓名">
			       				</div>
			       				<div class="identify_upload">
			       					<input style="margin-top:16px;margin-left:130px;" type="file" name="photo">
			       					<label>图片大小不超过5M，仅支持GIF、JPG、PNG、BMP格式</label>
			       				</div>
			       			</li>
			       		</ul>
			       	</dd>
		       		<dd>
       					<input class="L_save" type="submit" name="submit" value="保存" />
       				</dd>
       			</if>
			    </dl>
		    </div>
		</form>
	</div>
</div>
<script type="text/javascript">
$(function(){
	//弹出层调用语句
	$('#modaltrigger').leanModal({
		top:110,
		overlay:0.45,
		closeButton:".hidemodal"
	});
});
</script>
    <!-- 购买认证-结束 -->
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