<?php if (!defined('THINK_PATH')) exit();?>
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

  <div class="my_banner">
    <div class="nav_index_banner">
      <div class="banner">
        <div class="banner_box">
          <div class="banner_move">
            <?php if(is_array($index_banner)): $i = 0; $__LIST__ = $index_banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vol["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($vol["img"]); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
          <div class="move_btn">
            <ul>
            <?php if(is_array($index_banner)): $i = 0; $__LIST__ = $index_banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; if($i == 1): ?><li class="my"></li>
            <?php else: ?> <li></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
               </ul>
          </div>
        </div>
        <div class="index_card_box">
          <dl class="index_card">
            <dt> <span style="border-bottom-style: none; background-image: none; background-position: initial initial; background-repeat: initial initial;">公告</span> <span>通知</span> <span>帮助</span> </dt>
            <dd>
               <div style="display: block;"> 
			 <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><a href="/news/news/id/<?php echo ($vo1['article_id']); ?>" target="view_window" style="color:#fff;">
               <p><?php echo ($vo1['title']); ?></p>
			   <span><?php echo ($vo1['time']); ?></span>
              </a><?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
			  
              <div>
              <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><a href="/news/news/id/<?php echo ($vo2['article_id']); ?>" target="view_window" style="color:#fff;">
               <p><?php echo ($vo2['title']); ?></p>
			   <span><?php echo ($vo2['time']); ?></span>
              </a><?php endforeach; endif; else: echo "" ;endif; ?>                
                </div>
              <div>
                    <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($i % 2 );++$i;?><a href="/news/news/id/<?php echo ($vo3['article_id']); ?>" target="view_window" style="color:#fff;">
               <p><?php echo ($vo3['title']); ?></p>
			   <span><?php echo ($vo3['time']); ?></span>
              </a><?php endforeach; endif; else: echo "" ;endif; ?> 
                </div>
            </dd>
          </dl>
          <div class="index_onload">
           </div>
        </div>
      </div>
      <div class="index_adv">
        <div class="move_adv" style="left: 0px;">
          <?php if(is_array($index_ad1)): $i = 0; $__LIST__ = $index_ad1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vol["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($vol["img"]); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
    </div>
    <div class="products">
      <div class="pro_title"> <a class="pro_title01">精品推荐</a> <a href="/shop/discount" class="pro_title02" style="display:none">促销活动</a> </div>
      <dl>
        <dt>
          <?php if(is_array($index_part_recommend)): $i = 0; $__LIST__ = $index_part_recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>">
            <p><?php echo (mb_substr($vol["title"],0,16,'utf-8')); ?></p>
            <span>¥<?php echo ($vol["price"]); ?></span> <img src="/Uploads/<?php echo ($vol["img"]); ?>" style="width:140px; height:140px;"> </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </dt>
        <dd>
          <?php if(is_array($index_part_discount)): $i = 0; $__LIST__ = $index_part_discount;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>">
            <p><?php echo (mb_substr($vol["title"],0,16,'utf-8')); ?></p>
            <span>￥<?php echo ($vol["price3"]); ?></span> <img src="/Uploads/<?php echo ($vol["img"]); ?>" style="width:65px; height:65px;"> </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
      </dl>
    </div>
    <ul class="brand">
     <li> 
       <?php if(is_array($index_part_goldCompany)): $i = 0; $__LIST__ = $index_part_goldCompany;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><a href="/goldcontent/goldcontent/id/<?php echo ($vol["gold_id"]); ?>"><img src="/Uploads/<?php echo ($vol["gold_pic"]); ?>"> </a><?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
      </ul>
    <?php if(is_array($index_part_productList)): $k = 0; $__LIST__ = $index_part_productList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($k % 2 );++$k;?><div class="sale_box">
        <dl class="sale_left">
          <dt> <a class="sale_a<?php echo ($k); ?>" href="/shop/shopList/class1/<?php echo ($vol["product_classify_id"]); ?>"><?php echo ($k); ?>F <?php echo ($vol["title"]); ?></a> </dt>
          <dd>
            <?php if(is_array($vol["class2"])): $i = 0; $__LIST__ = $vol["class2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><a href="/shop/shopList/class1/<?php echo ($vol["product_classify_id"]); ?>/class2/<?php echo ($vol2["product_classify_id"]); ?>"><?php echo ($vol2["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
          </dd>
        </dl>
        <ul class="sale_center">
          <?php if(is_array($vol["product"])): $i = 0; $__LIST__ = $vol["product"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol3): $mod = ($i % 2 );++$i;?><li><a href="/shop/content/product_id/<?php echo ($vol3["product_id"]); ?>"> <img src="/Uploads/<?php echo ($vol3["img"]); ?>">
              <p> <?php echo (mb_substr($vol3["title"],0,27,'utf-8')); ?> </p>
              <span>¥<?php echo ($vol3["price2"]); ?></span> </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="sale_right">
          <?php if($k == 1): ?><a href="<?php echo ($index_ad2["0"]["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($index_ad2["0"]["img"]); ?>"  style=" width:229px; height:511px;"></a>
            <?php elseif($k == 2): ?>
            <a href="<?php echo ($index_ad2["1"]["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($index_ad2["1"]["img"]); ?>"  style=" width:229px; height:511px;"></a>
            <?php elseif($k == 3): ?>
            <a href="<?php echo ($index_ad2["2"]["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($index_ad2["2"]["img"]); ?>"  style=" width:229px; height:511px;"></a>
            <?php elseif($k == 4): ?>
            <a href="<?php echo ($index_ad2["3"]["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($index_ad2["3"]["img"]); ?>"  style=" width:229px; height:511px;"></a>
            <?php elseif($k == 5): ?>
            <a href="<?php echo ($index_ad2["4"]["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($index_ad2["4"]["img"]); ?>"  style=" width:229px; height:511px;"></a>
            <?php elseif($k == 6): ?>
            <a href="<?php echo ($index_ad2["5"]["link"]); ?>" target="_blank"><img src="/Uploads/<?php echo ($index_ad2["5"]["img"]); ?>"  style=" width:229px; height:511px;"></a><?php endif; ?>
        </div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <dl class="friend">
      <dt> <a>友情链接</a> </dt>
      <dd> <?php echo (stripslashes($top_content["link"])); ?> </dd>
    </dl>
  </div>
</div>