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
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:36px;">
      <td style="text-align:right">
       <form action="__APP__/productManagement/productAdd" method="get" name="add">
          产品分类
          <select name="class2">
            <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value=""><?php echo ($vol["title"]); ?></option>
              <?php if(is_array($vol["class2"])): $i = 0; $__LIST__ = $vol["class2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><option value="">--小类：<?php echo ($vol2["title"]); ?></option>
                <?php if(is_array($vol2["class3"])): $i = 0; $__LIST__ = $vol2["class3"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol3): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol3["product_classify_id"]); ?>">------子类：<?php echo ($vol3["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
          </select>
           <a  class="button1" onclick="add.submit()">添加产品</a>
        </form>
     </td>
    </tr>
  </table>
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:36px;">
      <td style="text-align:left; position:relative">
      <form action="" method="get" name="form">
          产品分类
          <select name="class">
            <option value="">---全部---</option>
            <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["product_classify_id"]); ?>"><?php echo ($vol["title"]); ?></option>
              <?php if(is_array($vol["class2"])): $i = 0; $__LIST__ = $vol["class2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol2["product_classify_id"]); ?>">--小类：<?php echo ($vol2["title"]); ?></option>
                <?php if(is_array($vol2["class3"])): $i = 0; $__LIST__ = $vol2["class3"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol3): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol3["product_classify_id"]); ?>">------子类：<?php echo ($vol3["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
          </select>
          &nbsp;&nbsp;状态 &nbsp;<select name="frame">
            <option value="">全部</option>
            <option value="1">上架</option>
            <option value="2">下架</option>
            <option value="3">锁定</option>
           </select>
          &nbsp; 
          <input name="keyword" type="text"  class="input1" style="width:300px;"  placeholder="请输入货号\批准文号\通用名称\商品名\厂家" />
         <a class="button1" onclick="formsubmit()" >提交</a>  <a class="button1" onclick="formsubmit2()" >导出excel</a>   <a class="button1" href="__APP__/productManagement/productList/stock/1">库存不足的商品</a>  
        </form>
        <script type="text/javascript">
            $("select[name='class'] ").find("option[value='<?php echo ($_GET['class']); ?>'] ").get(0).selected = true;
            $("select[name='frame'] ").find("option[value='<?php echo ($_GET['frame']); ?>'] ").get(0).selected = true;
			$("input[name='keyword']").val('<?php echo ($_GET['keyword']); ?>')
			
	 function  formsubmit(){
		   $("form[name='form']").attr('action','__APP__/productManagement/productList');
		  $("input[name='begtime']").val( $('#start').html() );
		  $("input[name='endtime']").val( $('#end').html() );
		   form.submit();
 		 }

   function  formsubmit2(){
		   $("form[name='form']").attr('action','__APP__/productManagement/productListExcel');
		  $("input[name='begtime']").val( $('#start').html() );
		  $("input[name='endtime']").val( $('#end').html() );
		   form.submit();
 		 }

			
			
			
			
			
			
			
         </script>
        </td>
  </table>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="20">  产品列表 <a href="__APP__/productManagement/productList" style="color:#06F">重置</a></td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="50">id</td>
      <td  width="30">选择</td>
      <td width="130">缩略图</td>
      <td>标题</td>
      <td>链接地址;</td>
      <td>销售记录</td>
        <td>库存</td>
        <td>货号</td>
        <td>批准文号</td>
        <td>厂家</td>
      <td width="50">上下架</td>
       <td width="150">修改时间</td>
      <td width="100">操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><?php echo ($vol["product_id"]); ?></td>
        <td><input name="" type="checkbox" value="<?php echo ($vol["product_id"]); ?>"  /></td>
        <td><a   href="/Uploads/<?php echo ($vol["imgFirst"]); ?>" target="_new" ><img src="/Uploads/<?php echo ($vol["imgFirst"]); ?>" width="120" /></a></td>
        <td>
        <div><?php echo ($vol["title"]); ?></div>
        <div style="color:#999"><?php echo ($vol["subhead"]); ?></div>
            </td>
        <td><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>" target="_blank" style="color:#06C">链接</a></td>
        <td><a href="__APP__/productManagement/sellRecord/product_id/<?php echo ($vol["product_id"]); ?>" style="color:#06C">销售记录</a></td>
           <td><?php echo ($vol["stock"]); ?></td>
            <td><?php echo ($vol["serialNumber"]); ?></td>
             <td><?php echo ($vol["approveNumber"]); ?></td>
             <td><?php echo ($vol["company"]); ?></td>
         <td>
         <?php if($vol["frame"] == 1): ?>上架
          <?php elseif($vol["frame"] == 2): ?>下架
          <?php elseif($vol["frame"] == 3): ?>锁定<?php endif; ?>
          </td>
        <td><?php echo (date('Y年m月d日 H:i:s',$vol["time"])); ?></td>
        <td><a href="__APP__/productManagement/productSave/product_id/<?php echo ($vol["product_id"]); ?>" style="color:#03C">修改</a>&nbsp;<a href="__APP__/productManagement/productListFunDel/id/<?php echo ($vol["product_id"]); ?>" style="color:#03C">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="20"><a href="javascript:void(0)" class="button1"  onclick="selectAll()">全选</a><a href="javascript:void(0)" class="button1" onclick="selectAllNo()">取消</a><a href="javascript:void(0)" class="button1" onclick="del()">删除</a></td>
    </tr>
    <tr>
      <td  colspan="20" bgcolor="#fbfce2"  height="36" class="feny"><?php echo ($page); ?></td>
    </tr>
  </table>
</div>
<script type="text/javascript">
      
     function selectAll(){          //全选
		 for(   i=0;i<$("input[type='checkbox']").length;i++  ){
		   $("input[type='checkbox']")[i].checked=true;
	       }
	    }
    function selectAllNo(){         //取消
		 $("input[type='checkbox']").attr("checked",false);
	  }
	  
	  selId= new Array();               //删除   
	  function del(){                  
		   for(  i=0;i<$("input[type='checkbox']:checked").length;i++   ){
		    var val = $("input[type='checkbox']:checked:eq("+ i +")").val()
			selId.push(val);
		   }
		  selId= selId.toString(); 
		  window.location.href='__APP__/productManagement/productListFunDel/id/'+selId;
	  } 
 	  
 
	  
	  
	  
	  
	  
	  
</script>
</body>
</html>