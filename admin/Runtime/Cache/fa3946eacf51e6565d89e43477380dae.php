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
       <td style="text-align:right"><a href="__APP__/liu/arcedite/class_child_id/<?php echo ($_GET['class_child_id']); ?>" class="button1">添加文章</a></td>
    </tr>
  </table>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9"><a href="__APP__/product/productClassify2/product_classify_id/<?php echo ($_GET['class2']); ?>/class1/<?php echo ($_GET['class1']); ?>"><?php echo ($bef_title); ?></a> > 文章列表<?php echo ($searchName); ?> </td>	
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="50">id</td>
      <td  width="30">选择</td>
      <td width="130">缩略图</td>
      <td>标题</td>
      <td>链接地址;</td>
      <td width="150">修改时间</td>
      <td width="100">操作</td>
    </tr>
    <?php if(is_array($newlist)): $i = 0; $__LIST__ = $newlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><?php echo ($vol["article_id"]); ?></td>
        <td><input name="" type="checkbox" value="<?php echo ($vol["article_id"]); ?>"  /></td>
        <td><a   href="/Uploads/<?php echo ($vol["thumbnail"]); ?>" target="_new" ><img src="/Uploads/<?php echo ($vol["thumbnail"]); ?>" width="120" /></a></td>
        <td><?php echo ($vol["title"]); ?></td>
        <td><a href="/news/news/id/<?php echo ($vol["article_id"]); ?>" target="_blank" style="color:#06C">页面链接</a></td>
        <td><?php echo (date('Y年m月d日 H:i:s',$vol["time"])); ?></td>
        <td><!-- <a href="__APP__/liu/arcchange/article_id/<?php echo ($vol["article_id"]); ?>" style="color:#03C">修改</a> -->&nbsp;<a href="__APP__/liu/arcticleDel/id/<?php echo ($vol["article_id"]); ?>" style="color:#03C">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    
    <tr>
      <td  colspan="9" bgcolor="#fbfce2"  height="36" class="feny"><?php echo ($page); ?></td>
    </tr>
  </table>
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px;">
      <td><span>文件名关键字:</span><span>
        <select name="searchClass">
          <option value="标题">标题</option>
          <option value="id">id</option>
        </select>
        <input name="searchName" type="text"  class="input1"   />
        </span>&nbsp;<a href="javascript:void(0)" class="button1" onclick="searchName()">搜索</a></td>
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
		  window.location.href='__APP__/product/productListFunDel/id/'+selId;
	  } 
	  
	  
	  function searchName(){         //搜索
	     window.location.href='__APP__/product/productList/class1/<?php echo ($_GET['class1']); ?>/class2/<?php echo ($_GET['class2']); ?>/class3/<?php echo ($_GET['class3']); ?>/searchClass/'+$("select[name='searchClass']").val()+'/searchName/'+$("input[name='searchName']").val() ;
	  }
	  
	  
	  
	  
	  
	  
	  
</script>
</body>
</html>