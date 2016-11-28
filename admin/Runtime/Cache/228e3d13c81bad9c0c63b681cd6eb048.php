<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
<script type="text/javascript" src="__PUBLIC__js/check.js"></script>
</head>
<body>
<div class="bannerAdd">
  <form action="__APP__/productManagement/productAddFunDo/class2/<?php echo ($_GET['class2']); ?>" method="post" enctype="multipart/form-data"  name="form">
    <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
      <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:36px;">
        <td style="text-align:left"><a href="__APP__/productManagement/productList/">文章列表</a> >> 文章新增 </td>
      </tr>
    </table>
    <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
      <tr style="height:36px;">
        <td style="text-align:left"><span>产品标题:</span><span>
          <input name="title" type="text"  class="input1" style="width:400px;" value="" my_check='need'   error='标题不能为空' />
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>副标题:</span><span>
          <input name="subhead" type="text"  class="input1" style="width:400px;" value=""/>
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>是否推荐:</span><span>
          <input name="is_recommend" type="checkbox" value="1" />
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>是否打折:</span><span>
          <input name="able_discount" type="checkbox" value="1" />
          </span></td>
      </tr>
      <tr>
        <td style="text-align:left"><div style="line-height:36px;">产品图片</div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div>
          <div style="margin-bottom:5px;">
            <input type="file"  name="file[]">
          </div></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>原价:</span><span>
          <input name="price1" type="text"  class="input1" style="width:400px;" value=""   my_check='float'   error='原价设置错误'  />
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>现价:</span><span>
          <input name="price2" type="text"  class="input1" style="width:400px;" value=""   my_check='float_need'   error='现价设置错误'/>
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>特惠价:</span><span>
          <input name="price3" type="text"  class="input1" style="width:400px;" value=""   my_check='float'   error='特惠价设置错误'  />
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>库存:</span><span>
          <input name="stock" type="text"  class="input1" style="width:400px;"   my_check='number_need'  value=""  error='库存错误' />
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>品牌:</span><span>
                <select name="manu_id" my_check='number_need' error='品牌错误'>
                    <option value="">--请选择品牌--</option>
                    <?php if(is_array($managelist)): $i = 0; $__LIST__ = $managelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mana): $mod = ($i % 2 );++$i;?><option value="<?php echo ($mana["gold_id"]); ?>"><?php echo ($mana["gold_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>药品属性类型:</span><span>
                <select name="aptitudes" my_check='number_need' error='药品属性类型错误'>
                    <?php if(is_array($aptitudelist)): $i = 0; $__LIST__ = $aptitudelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$aptitude): $mod = ($i % 2 );++$i;?><option value="<?php echo ($aptitude["id"]); ?>"><?php echo ($aptitude["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>药品类型:</span><span>
                <select name="ptype" my_check='number_need' error='药品类型错误'>
                    <option value="1">普通药品</option>
                    <option value="2">控销药品</option>
                    </volist>
                </select>
          </span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>状态:</span><span>
          <select name="frame" >
            <option value="1">上架</option>
            <option value="2">下架</option>
            <option value="3">锁定</option>
          </select>
          </span></td>
      </tr>
      <script type="text/javascript" src="__PUBLIC__js/laydate.js"></script>
      <tr>
        <td style="text-align:left"><div style="line-height:36px;">抢购开始时间</div>
          <li class="inline laydate-icon" id="start" style="width:200px; margin-right:10px;"></li>
          <input name="discount_beg_time" type="hidden" value="" /></td>
      </tr>
      <tr>
        <td style="text-align:left"><div style="line-height:36px;">抢购结束时间</div>
          <li class="inline laydate-icon" id="end" style="width:200px;"></li></td>
        <input name="discount_end_time" type="hidden" value="" />
      </tr>
      <script type="text/javascript">
//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(), //设定最小日期为当前日期
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
</script>
      <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
          <td style="text-align:left"><?php if($vol["is_select"] == 1): echo ($vol["title"]); ?>:
              <input name="<?php echo ($vol["attribute_id"]); ?>" type="text"  class="input1"/>
              <?php else: ?>
              <?php echo ($vol["title"]); ?>:
              <?php if(is_array($vol["value"])): $i = 0; $__LIST__ = $vol["value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i; echo ($vol2); ?> <input type="radio" name="<?php echo ($vol["attribute_id"]); ?>" value="<?php echo ($vol2); ?>"  style="vertical-align:middle" 
                
                <?php if($i == 1): ?>checked="checked"<?php endif; ?>
                />
                &nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php if(is_array($class1)): $i = 0; $__LIST__ = $class1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
          <td style="text-align:left"><?php if($vol["is_select"] == 1): echo ($vol["title"]); ?>:
              <input name="<?php echo ($vol["attribute_id"]); ?>" type="text"  class="input1"/>
              <?php else: ?>
              <?php echo ($vol["title"]); ?>:
              <?php if(is_array($vol["value"])): $i = 0; $__LIST__ = $vol["value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i; echo ($vol2); ?> <input name="<?php echo ($vol["attribute_id"]); ?>" type="radio"  style="vertical-align:middle" value="<?php echo ($vol2); ?>"  
                
                <?php if($i == 1): ?>checked="checked"<?php endif; ?>
                />
                &nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php if(is_array($class2)): $i = 0; $__LIST__ = $class2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
          <td style="text-align:left"><?php if($vol["is_select"] == 1): echo ($vol["title"]); ?>:
              <input name="<?php echo ($vol["attribute_id"]); ?>" type="text"  class="input1"/>
              <?php else: ?>
              <?php echo ($vol["title"]); ?>:
              <?php if(is_array($vol["value"])): $i = 0; $__LIST__ = $vol["value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i; echo ($vol2); ?> <input type="radio" name="<?php echo ($vol["attribute_id"]); ?>" value="<?php echo ($vol2); ?>"  style="vertical-align:middle" 
                
                <?php if($i == 1): ?>checked="checked"<?php endif; ?>
                />
                &nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php if(is_array($class3)): $i = 0; $__LIST__ = $class3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
          <td style="text-align:left"><?php if($vol["is_select"] == 1): echo ($vol["title"]); ?>:
              <input name="<?php echo ($vol["attribute_id"]); ?>" type="text"  class="input1"/>
              <?php else: ?>
              <?php echo ($vol["title"]); ?>:
              <?php if(is_array($vol["value"])): $i = 0; $__LIST__ = $vol["value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i; echo ($vol2); ?> <input type="radio" name="<?php echo ($vol["attribute_id"]); ?>" value="<?php echo ($vol2); ?>"  style="vertical-align:middle" 
                
                <?php if($i == 1): ?>checked="checked"<?php endif; ?>
                />
                &nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         <td style="text-align:left"><div style="line-height:30px;">详细内容</div>
          <div> 
            <script charset="utf-8" src="__ROOT__/kindeditor-4.1.10/themes/default/default.css"></script> 
            <script charset="utf-8" src="__ROOT__/kindeditor-4.1.10/kindeditor-min.js"></script> 
            <script charset="utf-8" src="__ROOT__/kindeditor-4.1.10/lang/zh_CN.js"></script> 
            <script>
			KindEditor.ready(function(K) {
		  editor=K.create('#content1', {
			  fileManagerJson : '__ROOT__/kindeditor-4.1.10/php/file_manager_json.php',
				allowFileManager : true,
					themeType : 'default'
				});
			});
		</script>
            <textarea id="content1"  style="width:700px;height:200px;visibility:hidden;"></textarea>
            <textarea   name="introduction" style="display:none"></textarea>
          </div></td>
      </tr>
      <tr>
        <td style="text-align:left"><div style="line-height:30px;">产品资质</div>
          <div> 
            <script>
			KindEditor.ready(function(K) {
		  editor2=K.create('#content2', {
			  fileManagerJson : '__ROOT__/kindeditor-4.1.10/php/file_manager_json.php',
				allowFileManager : true,
					themeType : 'default'
				});
			});
		  </script>
            <textarea id="content2"  style="width:700px;height:200px;visibility:hidden;"></textarea>
            <textarea  name="qualification" style="display:none"></textarea>
          </div></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>最优搭配:</span><span>
          <input name="product_group" type="text"  class="input1" style="width:400px;" value=""/>
          </span> <span>商品id 之间请用/连接  如商品id/商品id/商品id</span></td>
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><a href="javascript:void(0)" class="button1"  onclick="formSubmit()">确定</a> <a href="__APP__/productManagement/productList" class="button1">返回</a></td>
      </tr>
    </table>
  </form>
  <script type="text/javascript">
function formSubmit(){    
       if(!my_check()){return};
         $("input[name='discount_beg_time']").val( $('#start').html())
           $("input[name='discount_end_time']").val( $('#end').html())  	
  	       $("textarea[name='introduction']").html(editor.html());  
		    $("textarea[name='qualification']").html(editor2.html());  
	 
 		 form.submit();
 	}
 </script> 
</div>
</body>
</html>