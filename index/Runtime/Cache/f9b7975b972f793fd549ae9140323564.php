<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo ($top_content["title"]); ?></title>
<meta name="Keywords" content="<?php echo ($top_content["keywords"]); ?>" />
<meta name="Description" content="<?php echo ($top_content["description"]); ?>" />
<link rel="stylesheet" href="__PUBLIC__css/base.css">
<link rel="stylesheet" href="__PUBLIC__css/base01.css">
<link rel="stylesheet" href="__PUBLIC__css/main.css">
<link href="__PUBLIC__css/innerpage.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="__PUBLIC__css/other.css">
<script style="text/javascript" src="__PUBLIC__js/jquery-1.11.0.js"></script>
<script style="text/javascript" src="__PUBLIC__js/rich_lee.js"></script>
<script type="text/javascript" src="__PUBLIC__js/innerpage.js"></script>
<script src="__PUBLIC__js/ljs-v1.01.js"></script>
</head>
<script type="text/javascript">
  $(document).ready(function(){
	productImgShow("proshowimg","li","proshowmenu","sel",396,396);
	checkBoxShow("assort_menu","a","assort_sum","li","sel");
	productBoxShow("assort_menu","a","assort_ol","li","assort_sum","ul","sel");
	productBoxWidth(".partside");
	topTitFloat("detail_tit",1100,"detail_tit_sel");
	menuNextPage("#proshowmenubox","menu","li",340,80,"#proshowlast","#proshownext",85,4);
	nav_down();//
});
</script>
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
<div class="content i_shop_detail">
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

<div class="good_content">
<dl class="good_cru">
  <dt><a href="/">首页 </a><span>></span></dt>
  <dd><a href="/shop/shopList">药品超市</a><span>></span></dd>
  <dd><a href="/shop/shopList/class1/<?php echo ($content_part_weiz["class1"]); ?>"><?php echo ($content_part_weiz["class1Title"]); ?></a><span>></span></dd>
  <dd><a href="/shop/shopList/class1/<?php echo ($content_part_weiz["class1"]); ?>/class2/<?php echo ($content_part_weiz["class2"]); ?>"><?php echo ($content_part_weiz["class2Title"]); ?></a><span>></span></dd>
  <dd><a href="/shop/shopList/class1/<?php echo ($content_part_weiz["class1"]); ?>/class2/<?php echo ($content_part_weiz["class2"]); ?>/class3/<?php echo ($content_part_weiz["class3"]); ?>"><?php echo ($content_part_weiz["class3Title"]); ?></a><span>></span></dd>
  <dd><?php echo ($product_detail["title"]); ?></dd>
</dl>
<div class="good_box">
<div class="good_left">
  <div class="wrapper" style="width:410px; float:left; overflow:inherit;">
    <div class="scrool_box">
      <section class="proinfo_left"> <menu id="proshowimg">
         <?php if(is_array($product_img)): $i = 0; $__LIST__ = $product_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li><img src="/Uploads/<?php echo ($vol["img"]); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </menu>
        <div class="clear h15"></div>
        <div class="clear h15"></div>
        <div style=" width:100%;z-index:50; position: relative;"> <a id="proshowlast" href="javascript:void(0);"> < </a> <a id="proshownext" href="javascript:void(0);"> > </a> </div>
        <div id="proshowmenubox" class="mga" style="position:relative;"> <menu id="proshowmenu"></menu> </div>
        <div class="clear"></div>
      </section>
    </div>
  </div>
</div>
<div class="good_cen">
<h3><?php echo ($product_detail["title"]); ?></h3>
<p><?php echo ($product_detail["subhead"]); ?></p>
<?php if($contentFunIsDiscount == 1): ?><dl class="dl01">
  <dt>价  格 ：</dt>
  <dd> <a>￥<?php echo ($product_detail["price3"]); ?></a> <span>特价出售</span> </dd>
</dl>
<?php else: ?>
<dl class="dl01">
<dt>价  格 ：</dt>
<dd> <a>￥<?php echo ($product_detail["price2"]); ?></a> </dd><?php endif; ?>
<dl class="dl02">
  <dt>原   价 ：</dt>
  <dd><s>￥<?php echo ($product_detail["price1"]); ?></s></dd>
</dl>
<dl class="dl04">
  <dt>快递费 ：</dt>
  <dd><select onChange="express_fee_check()" id="express_fee">
  <option value="<?php echo ($top_content["express_fee"]); ?>">默认</option>
   <option value=<?php echo ($top_content["express_fee"]); ?> title="北京市">北京市</option><option value=<?php echo ($top_content["express_fee"]); ?> title="天津市">天津市</option><option value=<?php echo ($top_content["express_fee"]); ?> title="上海市">上海市</option><option value=<?php echo ($top_content["express_fee"]); ?> title="重庆市">重庆市</option><option value=<?php echo ($top_content["express_fee"]); ?> title="河北省">河北省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="山西省">山西省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="内蒙古">内蒙古</option><option value=<?php echo ($top_content["express_fee"]); ?> title="辽宁省">辽宁省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="吉林省">吉林省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="黑龙江省">黑龙江省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="江苏省">江苏省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="浙江省">浙江省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="安徽省">安徽省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="福建省">福建省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="江西省">江西省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="山东省">山东省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="河南省">河南省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="湖北省">湖北省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="湖南省">湖南省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="广东省">广东省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="广西">广西</option><option value=<?php echo ($top_content["express_fee"]); ?> title="海南省">海南省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="四川省">四川省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="贵州省">贵州省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="云南省">云南省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="西藏">西藏</option><option value=<?php echo ($top_content["express_fee"]); ?> title="陕西省">陕西省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="甘肃省">甘肃省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="青海省">青海省</option><option value=<?php echo ($top_content["express_fee"]); ?> title="宁夏">宁夏</option><option value=<?php echo ($top_content["express_fee"]); ?> title="新疆">新疆</option><option value=<?php echo ($top_content["express_fee"]); ?> title="香港">香港</option><option value=<?php echo ($top_content["express_fee"]); ?> title="澳门">澳门</option><option value=<?php echo ($top_content["express_fee"]); ?> title="台湾省">台湾省</option>
   </select>&nbsp;<i style="font-style:normal" id="express_fee_val"><?php echo ($top_content["express_fee"]); ?></i>元
   </dd>
   <script type="text/javascript">
   <?php if(is_array($express_fee)): $i = 0; $__LIST__ = $express_fee;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?>$("option[title='<?php echo ($vol["area"]); ?>']").attr('value',<?php echo ($vol["fee"]); ?>);<?php endforeach; endif; else: echo "" ;endif; ?>
    
	  function express_fee_check(){
 		  $("#express_fee_val").html( $("#express_fee").val())
 		  }
      </script>
</dl>
<dl class="dl02">
  <dt>库 &nbsp;存 ：</dt>
  <dd> <?php echo ($product_detail["stock"]); ?></dd>
</dl>
 <?php if(is_array($product_detail1)): $i = 0; $__LIST__ = $product_detail1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dl class="dl04">
  <dt><?php echo ($vol["title"]); ?>:</dt>
   <?php if($vol["title"] == 批准文号): ?><dd><a href="http://app1.sfda.gov.cn/datasearch/face3/base.jsp?tableId=25&tableName=TABLE25&title=%E5%9B%BD%E4%BA%A7%E8%8D%AF%E5%93%81&bcId=124356560303886909015737447882" style="color:#03C; font-size:14px">&nbsp;<?php echo ($vol["value"]); ?></a></dd>
   <?php else: ?><dd>&nbsp;<?php echo ($vol["value"]); ?></dd><?php endif; ?>
 
</dl><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if($contentFunIsDiscount == 1): ?><dl class="dl08">
    <dt>折扣时间 ：</dt>
    <dd><?php echo (date('Y-m-d',$product_detail["discount_beg_time"])); ?> ~ <?php echo (date('Y-m-d',$product_detail["discount_end_time"])); ?></dd>
  </dl><?php endif; ?>
<dl class="dl09">
  <dt>购买数量 ：</dt>
  <dd> <span onClick="num_reduce()">-</span>
    <input type="text" name="num"  value="1"  class="input_num" />
    <span onClick="num_add()">+</span> </dd>
  <script type="text/javascript">
	     num=1;
	 	function num_add(){
		   num++;
		   $('.input_num').val(num)
		}
		function num_reduce(){
			num--;
			if(num==0){
			  num=1;	
			}
			 $('.input_num').val(num)
		}
     </script>
</dl>
<dl class="dl10">
  <dt>
    <div onClick="shopping_cart_add()" style="cursor:pointer">加入购物车</div>
    <script type="text/javascript">
 	 function shopping_cart_add(){
		          <?php if($_SESSION['user_id']): ?>alert('加入成功');<?php endif; ?>
			    str="/shop/shopping_cart_add/product_id/<?php echo ($product_detail["product_id"]); ?>/num/"+$('.input_num').val();
                window.location.href=str; 		 
		 }
       </script> 
  </dt>
  <dd>
    <div onClick="orderFunAdd()">立刻购买</div>
      <script type="text/javascript">
 	 function orderFunAdd(){
  		         str="/order/orderFunAdd/product_id/<?php echo ($product_detail["product_id"]); ?>/product_num/"+$('.input_num').val();
                window.location.href=str; 		 
		 }
       </script> 
    
    
  </dd>
</dl>
</div>
<dl class="good_right">
  <dt>
    <h3>放心购买</h3>
    <p>互联网药品交易资格证：</p>
  </dt>
  <dd><img src="__PUBLIC__images/good_mark.png"  style="display:none"/> </dd>
</dl>
</div>
<?php if($product_detail["product_group"] != null): ?><dl class="good_add" >
    <dd> <img src="/Uploads/<?php if(is_array($product_img)): $i = 0; $__LIST__ = array_slice($product_img,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; echo ($vol["img"]); endforeach; endif; else: echo "" ;endif; ?>
      ">
      <p><?php echo (mb_substr($product_detail["title"],0,16,'utf-8')); ?> </p>
      <span>￥
      <?php if($contentFunIsDiscount == 1 ): ?><ss class="a1"><?php echo ($product_detail["price3"]); ?> </ss>
        <?php else: ?>
        <ss class="a1" ><?php echo ($product_detail["price2"]); ?></ss><?php endif; ?>
      </span> <s class="a2"  style="display:none"><?php echo ($product_detail["price1"]); ?></s> </dd>
    <?php if(is_array($product_group)): $i = 0; $__LIST__ = $product_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dd> <a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($vol["img"]); ?>"></a>
        <p><?php echo (mb_substr($vol["title"],0,16,'utf-8')); ?> </p>
        <span>￥
        <ss class="a1" ><?php echo ($vol["price"]); ?></ss>
        <div>
          <input name="product" type="checkbox" id="" value="<?php echo ($vol["product_id"]); ?>" checked>
        </div>
        </span> </dd>
      <s class="a2"  style="display:none"><?php echo ($vol["price1"]); ?></s><?php endforeach; endif; else: echo "" ;endif; ?>
    <dt>
      <p class="p2"  style="margin-top:20px;">套餐价 : <span>￥
        <ss class="price_now"></ss>
        </span></p>
      <p class="p3">原价： <s>
        <ss  class="price_now2"></ss>
        </s></p>
      <p class="p4">已节省：
        <ss  class="price_now3"></ss>
      </p>
      <div onClick="product_group_form()">加入购物车</div>
      <script type="text/javascript">
	   function  product_group_form(){
 		    selId= new Array();   
			selId.push(<?php echo ($product_detail["product_id"]); ?>);
           for(  i=0;i<$("input[name='product']:checked").length;i++   ){
		    var val = $("input[name='product']:checked:eq("+ i +")").val()
			selId.push(val);
		   }
		  selId= selId.toString(); 
		   window.location.href='/shop/content_part_product_group_add/id/'+selId;
 		  }
		  </script> 
    </dt>
  </dl>
  <script type="text/javascript">
		     	price_now=0; //现在的价格
 			   for( i=0;i< $('.good_add .a1').length;i++){
				   price_now=price_now+$('.good_add .a1:eq('+i+')').html()*1
				   }
				   $('.price_now').html(price_now)
				   
				  price_now2=0; //原价
 			   for( i=0;i< $('.good_add .a2').length;i++){
				   price_now2=price_now2+$('.good_add .a2:eq('+i+')').html()*1
				   } 
				   
                  $('.price_now2').html(price_now2)
				  price_now3=price_now2-price_now
 				  $('.price_now3').html(price_now3)
	       </script><?php endif; ?>
<div class="good_det">
  <div class="good_oth">
    <div class="good_otht">
      <dl>
        <dt><span>同类其他商品</span></dt>
        <dd>
          <?php if(is_array($content_part_product_other)): $i = 0; $__LIST__ = $content_part_product_other;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>"><?php echo (mb_substr($vol["title"],0,5,'utf-8')); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
      </dl>
    </div>
    <div class="good_see">
      <div class="left_goodslist">
        <h4 class="title_left">热销药品</h4>
        <ul class="selling_list">
         <?php if(is_array($shopList_part_hotSell)): $i = 0; $__LIST__ = $shopList_part_hotSell;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li> <a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>" style="display:block"><img src="/Uploads/<?php echo ($vol["img"]); ?>" alt=""  style="width:218px; height:218px;" />
            <h3 class="selling_title"><?php echo ($vol["title"]); ?>.</h3>
            <h5 class="selling_newprice">￥<?php echo ($vol["price"]); ?></h5>
            <h5 class="selling_oldprice">￥<?php echo ($vol["price1"]); ?></h5>
            </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="good_introbox">
    <dl class="good_intr">
      <dt> <span class="span1"><a href="#good_intrimg">商品介绍</a></span> <span class="span2"><a href="#good_repl">商品评价（<?php echo ($content_part_comment_count_1); ?>）</a></span>
        <div onClick="shopping_cart_add()" style="cursor:pointer">加入购物车</div>
      </dt>
      <dd>
        <div><span>商品名称：</span>
          <p><?php echo ($product_detail["title"]); ?></p>
        </div>
        <?php if(is_array($product_detail2)): $i = 0; $__LIST__ = $product_detail2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><div><span><?php echo ($vol["title"]); ?>：</span>
          <p><?php echo ($vol["value"]); ?></p>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
        
        <div><span>温馨提示：</span>
          <p>部分商品包装更换频繁，如货品与图片 不完全一致，请以收到的商品实物为准 </p>
        </div>
      </dd>
    </dl>
    <dl class="good_intrimg" id="good_intrimg">
      <dt> <span>产品详情</span> </dt>
    </dl>
    <div style="margin-bottom:20px; line-height:22px; font-size:14px"> <?php echo (stripslashes($product_detail["introduction"])); ?> </div>
    <dl class="good_repl" id="good_repl">
      <dt>
      <a id="mao" href="/shop/content/product_id/<?php echo ($_GET['product_id']); ?>#mao"  >全部评价（<?php echo ($content_part_comment_count_1); ?>）</a>
      <a id="mao" href="/shop/content/product_id/<?php echo ($_GET['product_id']); ?>/class_comment/2#mao" >好评（<?php echo ($content_part_comment_count_2); ?>）</a>
      <a id="mao" href="/shop/content/product_id/<?php echo ($_GET['product_id']); ?>/class_comment/3#mao"  >中评（<?php echo ($content_part_comment_count_3); ?>）</a>
      <a id="mao" href="/shop/content/product_id/<?php echo ($_GET['product_id']); ?>/class_comment/4#mao" >差评（<?php echo ($content_part_comment_count_4); ?>）</a>
      <a id="mao" href="/shop/content/product_id/<?php echo ($_GET['product_id']); ?>/class_comment/5#mao"  >有图（<?php echo ($content_part_comment_count_5); ?>）</a> </dt>
    <script type="text/javascript">
	  <?php if($_GET['class_comment'] == 2 ): ?>$('.i_shop_detail  .good_repl dt a').eq(1).attr('class','sel')
      <?php elseif($_GET['class_comment'] == 3): ?>
	  $('.i_shop_detail  .good_repl dt a').eq(2).attr('class','sel')
	    <?php elseif($_GET['class_comment'] == 4): ?>
	  $('.i_shop_detail  .good_repl dt a').eq(3).attr('class','sel')  
	    <?php elseif($_GET['class_comment'] == 5): ?>
	  $('.i_shop_detail  .good_repl dt a').eq(4).attr('class','sel')    
       <?php else: ?>
	   $('.i_shop_detail  .good_repl dt a').eq(0).attr('class','sel')<?php endif; ?>
     </script>
       <?php if(is_array($content_part_comment_list)): $i = 0; $__LIST__ = $content_part_comment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dd>
        <div class="redd_left"> <img src="/Uploads/<?php echo ($vol["img"]); ?>" />
          <p><?php echo ($vol["name"]); ?></p>
        </div>
        <div class="redd_cen">
          <div class="redd_star"> 
             <?php if($vol["score"] == 5): ?><span></span> <span></span> <span></span> <span></span> <span></span> 
              <?php elseif($vol["score"] == 4): ?>
               <span></span> <span></span> <span></span> <span></span>
                <?php elseif($vol["score"] == 3): ?>
               <span></span> <span></span> <span></span>
                 <?php elseif($vol["score"] == 2): ?>
               <span></span> <span></span>
                 <?php elseif($vol["score"] == 1): ?>
               <span></span><?php endif; ?>
            </div>
          <p>
          <?php echo ($vol["content"]); if($vol["reply"] != null ): ?><span style="color:#F00; padding-left:10px;">管理员回复：<?php echo ($vol["reply"]); ?></span><?php endif; ?>
          </p>
          <?php if($vol["comment_img"] != null): ?><div class="redd_show"> <span><a href="/Uploads/<?php echo ($vol["comment_img"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($vol["comment_img"]); ?>" /></a></span></div><?php endif; ?>
        </div>
        <div class="redd_right">
        <?php echo (date('Y年m月d日 H:i:s',$vol["time"])); ?>
        </div>
      </dd><?php endforeach; endif; else: echo "" ;endif; ?>
     </dl>
  </div>
  <div class="pagebox">
    <div><?php echo ($content_part_comment_page); ?></div>
  </div>
  
  <?php if($content_part_commentFunIsCan == 1): ?><form action="/shop/content_part_commentFunAdd/product_id/<?php echo ($_GET['product_id']); ?>/order_id/<?php echo ($_GET['order_id']); ?>" method="post" enctype="multipart/form-data" name="comment">
      <div class="s_part1">
        <div class="h1">
          <div class="L">请评分</div>
          <div class="R">
            <input name="score" type="radio"  value="1" >
            1
            <input name="score" type="radio" value="2">
            2
            <input name="score" type="radio"  value="3">
            3
            <input name="score" type="radio"  value="4">
            4
            <input name="score" type="radio" value="5" checked>
            5 </div>
          <div class="clear"></div>
        </div>
        <!--h1-->
        <div class="h2">
          <textarea  name="content" ></textarea>
        </div>
        <div class="h4"> 产品图片
         <input name="file" type="file">
         </div>
        <div class="h3">
          <div class="btn" onClick="comment.submit()">提交</div>
        </div>
      </div>
      <!--s_part1-->
    </form><?php endif; ?>
</div>
</div>
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