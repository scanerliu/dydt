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
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="20">  日志列表  <a href="__APP__/system/recordList/is_dangerous/1" style="color:#06F">不安全的操作</a>  <a href="__APP__/system/recordList/" style="color:#06F">全部</a></td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="50">id</td>
      <td width="300" >时间</td>
      <td >备注</td>
      <td width="100">是否安全</td>
     </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><?php echo ($vol["record_id"]); ?></td>
        <td><?php echo (date('Y年m月d日 H:i:s',$vol["time"])); ?></td>
        <td><?php echo ($vol["remark"]); ?></td>
        <td>
        <?php if($vol["is_dangerous"] == 1): ?><span style="color:#F00">不安全</span>
         <?php else: ?>安全<?php endif; ?>
         </td>
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