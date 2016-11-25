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
 
  
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <!-- <td height="30" width="50">id</td> -->
     <td  width="180">标题</td>
      <td width="130">缩略图</td>
      <td>链接地址;</td>
      <td width="100">操作</td>
    </tr>
    
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
      <!-- <td height="30"><?php echo ($vol["index_banner_id"]); ?></td> -->
      <td><?php echo ($vol["title"]); ?></td>
      <td><a   href="/Uploads/<?php echo ($vol["img"]); ?>" target="_new" ><img src="/Uploads/<?php echo ($vol["img"]); ?>" width="120" /></a></td>
      <td><a href="<?php echo ($vol["link"]); ?>" target="_new"><?php echo ($vol["link"]); ?></a></td>
      <td><a href="__APP__/liu/bannerSave/index_banner_id/<?php echo ($vol["index_banner_id"]); ?>/class/<?php echo ($_GET['class']); ?>" style="color:#03C">修改</a>&nbsp;<?php if($_GET['class'] != index_ad2 ): ?><!-- <a href="__APP__/liu/bannerListFunDel/id/<?php echo ($vol["index_banner_id"]); ?>/class/<?php echo ($_GET['class']); ?>" style="color:#03C">删除</a> -->
      &nbsp;<?php endif; ?><a href="/Uploads/<?php echo ($vol["img"]); ?>" target="_new" style="color:#03C">大图</a></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php if($_GET['class'] != index_ad2 ): ?><!--  <tr>
<td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9"><a href="javascript:void(0)" class="button1"  onclick="selectAll()">全选</a><a href="javascript:void(0)" class="button1" onclick="selectAllNo()">取消</a><a href="javascript:void(0)" class="button1" onclick="del()">删除</a></td>
    </tr> --><?php endif; ?>
    
    
       <tr>
      <td  colspan="9" bgcolor="#fbfce2"  height="36" class="feny"><?php echo ($page); ?></td>
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
		   window.location.href='__APP__/indexManagement/bannerListFunDel/class/<?php echo ($_GET['class']); ?>/id/'+selId;
	  } 
  
	  

	  
	  
	  
	  
	  
</script>
</body>
</html>