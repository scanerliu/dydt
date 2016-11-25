<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo ($top_content["title"]); ?></title>
<meta name="Keywords" content="<?php echo ($top_content["keywords"]); ?>" />
<meta name="Description" content="<?php echo ($top_content["description"]); ?>" />
<link rel="stylesheet" href="__PUBLIC__css/base.css">
<link rel="stylesheet" href="__PUBLIC__css/main.css">
<link rel="stylesheet" href="__PUBLIC__css/cssforml.css">
<script style="text/javascript" src="__PUBLIC__js/jquery-1.11.0.js"></script>
<script style="text/javascript" src="__PUBLIC__js/rich_lee.js"></script>
<script src="__PUBLIC__js/l_goods.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">
  $(document).ready(function(){
 	nav_down();//
});
</script>
</head>
<body>
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
<div class="content"> <div class="my_box_nav">
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

  <div class="positionlock" style="clear:both">
    <p><a href="/">首页</a>&nbsp;>&nbsp;药品超市</p>
  </div>
  
  <!-- 所在位置end --> 
  <!-- 中间区域 -->
  <div class="goodslistcontent clear" style="min-height:2400px;"> 
    <!-- 左边热销商品 -->
    <div class="left_goodslist">
      <h4 class="title_left">热销药品</h4>
      <ul class="selling_list">
        <?php if(is_array($shopList_part_hotSell)): $i = 0; $__LIST__ = $shopList_part_hotSell;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li> <a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>" style="display:block"><img src="/Uploads/<?php echo ($vol["img"]); ?>" alt=""  style="width:218px; height:218px;" />
            <h3 class="selling_title"><?php echo ($vol["title"]); ?>.</h3>
            <h5 class="selling_newprice">￥<?php echo ($vol["price"]); ?></h5>
            <h5 class="selling_oldprice">￥<?php echo ($vol["price1"]); ?></h5>
            </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <!-- 左边热销商品end --> 
    <!-- 右边 -->
    <div class="goods_right"> 
      <!-- 右边热卖推荐 -->
      <div class="bestsellers">
        <h4 class="title_bestsellers">热卖推荐</h4>
        <div class="shop_list_recommend">
          <?php if(is_array($shopList_part_recommend)): $i = 0; $__LIST__ = $shopList_part_recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><div class="part">
              <div class="L"><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>"><img src="/Uploads/<?php echo ($vol["img"]); ?>" alt=""></a></div>
              <div class="R">
                <div class="a1"><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>"><?php echo (mb_substr($vol["title"],0,16,'utf-8')); ?></a></div>
                <div class="a2">￥<?php echo ($vol["price"]); ?></div>
                <div class="a3"><a href="/shop/shopping_cart_add/product_id/<?php echo ($vol["product_id"]); ?>"><img src="__PUBLIC__images/a1.jpg" alt=""></a></div>
              </div>
              <div class="clearx"></div>
            </div>
            <!--part--><?php endforeach; endif; else: echo "" ;endif; ?>
          <style type="text/css">
.shop_list_recommend{  padding:10px 10px; border:1px solid #dddddd}
.shop_list_recommend .part { float:left}
.shop_list_recommend .part  .L{ float:left}
.shop_list_recommend .part  .L img{ width:100px; height:100px;}
.shop_list_recommend .part  .R{ float:left; padding-left:10px; padding-right:5px; width:120px;}
.shop_list_recommend .part  .R .a2{ font-size:16px; color:#F00; font-weight:bolder}
.clearx{ clear:both; height:0px; overflow:hidden}
  </style>
          <div class="clearx"></div>
        </div>
        <!--shop_list_recommend--> 
        
      </div>
      <!-- 右边热卖推荐end --> 
      
      <!-- 右边药品超市 -->
      <div class="drugs_market_top clear">
        <h4>药品超市
          <h5 class="market_top_h5">找到<span class="market_top_num"><?php echo ($count); ?></span>件相关产品  <?php echo ($keyword); ?></h5>
        </h4>
        <a href="/shop/shopList">重新筛选</a> </div>
      <form action="/shop/shopList" method="get" name="form">
        <ul class="drugs_market_ul clear">
          <li class="drugs_market_ul_li clear search_class1"><a class="drugs_market_lg">大类:</a>
            <ul class="drugs_market_in clear">
              <li onClick="search_class1_fun()">全部</li>
              <?php if(is_array($search_class1)): $i = 0; $__LIST__ = $search_class1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li data='<?php echo ($vol["product_classify_id"]); ?>'><?php echo ($vol["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </li>
          <input name="class1" type="hidden" value="<?php echo ($_GET['class1']); ?>">
          <script type="text/javascript">
	          function  search_class1_fun(){
 				  $("input[name='class2']").val('');
 				  $("input[name='class3']").val('');
				  }
	  
	  
	           search_class1='<?php echo ($_GET['class1']); ?>';
             if( search_class1==''){
				 $('.search_class1 li:eq(0)').attr('class','drugs_market_active')
			 }
			 else{
				 $(".search_class1 li[data='"+search_class1+"']").attr('class','drugs_market_active')
 			 }
       </script>
          <?php if($_GET['class1'] != null): ?><li class="drugs_market_ul_li clear search_class2"><a class="drugs_market_lg">小类:</a>
              <ul class="drugs_market_in clear">
                <li onClick="search_class2_fun()">全部</li>
                <?php if(is_array($search_class2)): $i = 0; $__LIST__ = $search_class2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li data='<?php echo ($vol["product_classify_id"]); ?>'><?php echo ($vol["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
            </li>
            <input name="class2" type="hidden" value="<?php echo ($_GET['class2']); ?>">
            <script type="text/javascript">
	        function  search_class2_fun(){
 				  $("input[name='class2']").val('');
 				  $("input[name='class3']").val('');
				  }
	  
	          search_class2='<?php echo ($_GET['class2']); ?>';
             if( search_class2==''){
				 $('.search_class2 li:eq(0)').attr('class','drugs_market_active')
			 }
			 else{
				 $(".search_class2 li[data='"+search_class2+"']").attr('class','drugs_market_active')
 			 }
       </script><?php endif; ?>
          <?php if($_GET['class2'] != null): ?><li class="drugs_market_ul_li clear search_class3"><a class="drugs_market_lg">子类:</a>
              <ul class="drugs_market_in clear">
                <li>全部</li>
                <?php if(is_array($search_class3)): $i = 0; $__LIST__ = $search_class3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li data='<?php echo ($vol["product_classify_id"]); ?>'><?php echo ($vol["title"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
            </li>
            <input name="class3" type="hidden" value="<?php echo ($_GET['class3']); ?>">
            <script type="text/javascript">
	           search_class3='<?php echo ($_GET['class3']); ?>';
             if( search_class3==''){
				 $('.search_class3 li:eq(0)').attr('class','drugs_market_active')
			 }
			 else{
				 $(".search_class3 li[data='"+search_class3+"']").attr('class','drugs_market_active')
 			 }
       </script><?php endif; ?>
          
          <script type="text/javascript">
		//拆分字符串 beg
		  str=$("input[name='attribute']").val();
          str=str.split("x"); 
		  for (i=0;i<str.length ;i++ )  { 
		    str[i]=str[i].split("-"); 
           } 
		  //拆分字符串 end
		  // 根据  <input name="attribute" type="hidden" 的值给 自定义属性加上状态的式样   beg
		 for (i=0;i<str.length ;i++ )  { 
		      if(str[i][1]){
				 $('#'+str[i][0]+" li[data='"+str[i][1]+"']").parent().find('li').attr('class','')
   			     $('#'+str[i][0]+" li[data='"+str[i][1]+"']").attr('class','drugs_market_active')
			  }
             }  
	     // 根据  <input name="attribute" type="hidden" 的值给自定义属性加上状态的式样   end
		 // 提交 页面的时候  根据 自定义 属性的 状态 给  <input name="attribute" type="hidden"  赋值  beg
		   		     function  attributeInput(){
				       for (i=0;i<$("ul[data='attribute']").length ;i++ )  { 
				        if(i==0){
 				            str=$("ul[data='attribute']").eq(i).attr('id')+'-'+$("ul[data='attribute']").eq(i).find('.drugs_market_active').attr('data')
   						}
						else{
						 str=str+'x'+$("ul[data='attribute']").eq(i).attr('id')+'-'+$("ul[data='attribute']").eq(i).find('.drugs_market_active').attr('data')
							}
                      } 
					  $("input[name='attribute']").val(str)
					  
   				 }
				 
 		  // 提交 页面的时候  根据 自定义 属性的 状态 给  <input name="attribute" type="hidden"  赋值  end
              </script>
        </ul>
        <input name="order" type="hidden" value="<?php echo ($_GET['order']); ?>" id="input_order">
        <input type="hidden" value="<?php echo ($_GET['price_min']); ?>" name="price_min"  class="input_price_min"/>
        <input type="hidden" value="<?php echo ($_GET['price_max']); ?>" name='price_max' class="input_price_max" />
      </form>
      <script type="text/javascript">
	$(".drugs_market_ul .drugs_market_in li").on("click", function(){
		// 自定义属性的提交 beg
 		if($(this).parent().attr('data')=='attribute'  ){
				$(this).parent().find('li').attr('class','');
				$(this).attr('class','drugs_market_active');
				 attributeInput();
 				form.submit();
				return ;
				}
			// 自定义属性的提交end	
 		
		
		if( $(this).index()== 0 ){
			
				
			$(this).parent().parent().next().val('');
			}
		   else{
			 $(this).parent().parent().next().val( $(this).attr('data')  );  
 			  }
 		  form.submit();
     });
</script> 
        <!-- 右边药品超市end --> 
      <!-- 右边下部商品列表 -->
      <div class="goodslist_under_top clear">
        <ul class="goodssort">
          <li  onClick="$('#input_order').val(''); form.submit()" >默认</li>
          <li onClick="$('#input_order').val('1'); form.submit()">销量</li>
          <li onClick="$('#input_order').val('2'); form.submit()">价格</li>
          <li class="pricerange">价格区间
            <input type="text" value="<?php echo ($_GET['price_min']); ?>" class="input_price_min2" />
            <span>-</span>
            <input type="text" value="<?php echo ($_GET['price_max']); ?>" class='input_price_max2'/>
            <a onClick="price_search_submit()" style=" background: #06F">确定</a> </li>
        </ul>
      </div>
      <script type="text/javascript">
	  <?php if($_GET['order'] == null ): ?>$('.goodssort li').eq(0).attr('class','active')
	  <?php elseif($_GET['order'] == 1 ): ?>
	   $('.goodssort li').eq(1).attr('class','active')
	  	  <?php elseif($_GET['order'] == 2 ): ?>
	   $('.goodssort li').eq(2).attr('class','active') ;<?php endif; ?>
	function price_search_submit(){ //价格的搜索提交
		$('.input_price_min').val(  $('.input_price_min2').val() )
	    $('.input_price_max').val(  $('.input_price_max2').val() )
 		form.submit();
		}
    </script>
      <div class="goodslist_under">
        <ul class="goodslist_under_ul">
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li class="goodslist_under_li"><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>"><img src="/Uploads/<?php echo ($vol["img"]); ?>" alt=""></a>
              <h3><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>"><?php echo (mb_substr($vol["title"],0,16,'utf-8')); ?></a> </h3>
              <h6 class="newprice">￥<?php echo ($vol["price2"]); ?></h6>
              <h6 class="oldprice">￥1088.00</h6>
              <a href="/shop/shopping_cart_add/product_id/<?php echo ($vol["product_id"]); ?>" class="addcar">加入购物车</a>
              <?php if($vol["isFavorite"] == 1): ?><a class="attention" href="/shop/favorite_delete/product_id/<?php echo ($vol["product_id"]); ?>" >已关注</a>
                <?php else: ?>
                <a href="/shop/favorite_add/product_id/<?php echo ($vol["product_id"]); ?>"   class="attention">关注</a><?php endif; ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
      <!-- 右边下部商品列表end -->
      <div style="clear:both; text-align:center;" class="page"> <?php echo ($page); ?> </div>
      <style type="text/css">
      .page a{ display:inline-block;   height:25px; line-height:25px; text-align:center; border:1px solid #eeeeee; margin-right:10px; padding:0px 15px; }
	  .page span{ display:inline-block;  height:25px; line-height:25px; text-align:center;border:1px solid #3b93de; background:#3b93de; margin-right:10px;color:#FFF;padding:0px 15px;}
     </style>
    </div>
    <!-- 右边end --> 
    <!-- 中间区域end --> 
  </div>
  <!-- 猜您需要 -->
  <div class="guess_need" >
    <div class="guess_need_title clear"> <span>猜您需要</span> </div>
    <ul class="guess_need_underul clear">
      <?php if(is_array($shopList_part_search_discount)): $i = 0; $__LIST__ = $shopList_part_search_discount;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li class="goodslist_under_li"> <a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>" style="display:block"><img src="/Uploads/<?php echo ($vol["img"]); ?>" alt="">
          <h3><?php echo ($vol["title"]); ?></h3>
          <h6 class="newprice">¥<?php echo ($vol["price3"]); ?></h6>
          <h6 class="oldprice">￥<?php echo ($vol["price1"]); ?></h6>
          </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <!-- 猜您需要end --> 
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