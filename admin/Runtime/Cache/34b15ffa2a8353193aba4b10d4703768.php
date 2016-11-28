<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
<script type="text/javascript" src="__PUBLIC__js/jquery-1.4.2.min.js"></script>
<script src="__PUBLIC__js/main.js" type="text/javascript"></script>
<style>
*{margin:0;padding:0;list-style-type:none;}
img,a{border:0;}
.piccon{height:75px;margin:100px 0 0 50px;}
.piccon li{float:left;padding:0 10px;}
#preview{position:absolute;border:1px solid #ccc;background:#333;padding:5px;display:none;color:#fff;}
</style>
</head>
<body>
 <div class="bannerList">
 <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;">
    <tbody><tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;"></tr>
  </tbody></table>
   <form id="registerform" name="registerform" method="post" action="__APP__/manage/saveaptitude">
       <input type="hidden" name="cuser_id" value="<?php echo ($user_id); ?>">
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr bgcolor="#fbfce2">
      <td>药品经营种类：</td>
      <td style="width:80px;">操作</td>
    </tr>
    <tr>
        <td>
            <?php if(is_array($aptitudelist)): $i = 0; $__LIST__ = $aptitudelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$aptitude): $mod = ($i % 2 );++$i;?><label style="margin-left:35px;margin-top:30px;" name="doc_type" class="check">
                    <input type="checkbox" name="aptitudeids[]" value="<?php echo ($aptitude["id"]); ?>" <?php if($aptitude["checked"] == 1): ?>checked="checked"<?php endif; ?>> <?php echo ($aptitude["name"]); ?>
                </label><?php endforeach; endif; else: echo "" ;endif; ?>
        </td>
      <td>
            <a onClick="registeraptitude()" style="cursor:pointer;color:green">保存</a>
      </td>
    </tr>
    <tr>
    </tr>
  </table>
   </form>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr bgcolor="#fbfce2">
      <td style="width:20px;"></td>
      <td style="width:100px;">认证ID</td>
      <td style="width:60px;">用户名</td>
      <td style="width:100px;">证件持有者姓名</td>
      <td style="width:100px;">认证类型</td>
      <td style="width:100px;">证件有效日期</td>
      <td style="width:100px;">提交时间</td>
      <td style="width:40px;">状态</td>
      <td style="width:80px;">图片</td>
      <td style="width:80px;">操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><input type="checkbox" name="download[]" value="<?php echo ($vo["id"]); ?>"></td>
      <td><?php echo ($vo["id"]); ?></td>
      <td><?php echo ($vo["user_name"]); ?></td>
      <td><?php echo ($vo["name"]); ?></td>
      <td><?php echo ($vo["doc_type"]); ?></td> 
      <td>
      <?php echo ($vo["get_date"]); ?> 至 <?php echo ($vo["lose_date"]); ?><br><br>
      <a style="color:#db6969"><?php echo ($vo["er"]); ?></a>
      </td>
      <td><?php echo (date('Y-m-d',$vo["date"])); ?></td>
      <td>
        <?php if($vo["status"] == 0): ?>未审核
        <?php elseif($vo["status"] == 1): ?>
          已通过
        <?php else: ?>
          已拒绝<br>
          (原因：<?php echo ($vo["back"]); ?>)<?php endif; ?>
      </td>
      <td><a rel="/Uploads/<?php echo ($vo["img"]); ?>" class="preview"><img style="width:100px;height:80px;" src="/Uploads/<?php echo ($vo["img"]); ?>"></a></td>
      <td>
        <a style="color:#db6969;margin-right:10px;font-size: 15px;" href="__APP__/manage/download/id/<?php echo ($vo["id"]); ?>">下载</a>
        <?php if($vo["status"] == 0): ?><a onClick="return confirm('确认要通过此认证吗？')" href="__APP__/manage/audit_ok/id/<?php echo ($vo["id"]); ?>" style="cursor:pointer;color:green">通过</a>
            <a onclick="alertpro(<?php echo ($vo["id"]); ?>)" style="cursor:pointer;margin-left:10px;color:#db6969;font-size: 15px;" id="alertpro">不通过</a>
        <?php elseif($vo["status"] == 1): ?>
            <a onclick="alertpro(<?php echo ($vo["id"]); ?>)" style="cursor:pointer;margin-left:10px;color:#db6969;font-size: 15px;" id="alertpro">不通过</a>
        <?php else: ?>
            <a onClick="return confirm('确认要通过此认证吗？')" href="__APP__/manage/audit_ok/id/<?php echo ($vo["id"]); ?>" style="cursor:pointer;color:green">通过</a><?php endif; ?>
      </td>
      <script>
      function alertpro (id) {
          var alertpro = document.getElementById('alertpro');
          var name=prompt("请输入不通过的原因(注：原因为空将不能提交操作申请)","");
          if (name!=null && name!="") {
            alertpro.href = "__APP__/manage/audit_no/id/"+id+"/name/"+name;
            alertpro.onclick = "";
            alertpro.click();
          }
      }
      </script>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
    </tr>
  </table>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;">
    <tbody><tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:26px;">
      <td style="text-align:left">
        <a href="javascript:void(0)" class="button1"  onclick="selectAll()">全选</a><a href="javascript:void(0)" class="button1" onclick="selectAllNo()">取消</a><a href="javascript:void(0)" class="button1" onclick="down()">批量下载</a>
      </td>
    </tr>
  </tbody></table>
</div>
<div style="margin-left:40%;margin-top:3%;" class="feny"><?php echo ($page); ?></div>
<script type="text/javascript">
  function ss () {
    var key=document.getElementById('key').value;
    var keyword=document.getElementById('keyword').value;
    window.location.href="__APP__/manage/certification_audit/key/"+key+"/keyword/"+keyword;
  }
  
  function down () {
    selId= new Array();
    for(i=0;i<$("input[type='checkbox']:checked").length;i++){
        var val = $("input[type='checkbox']:checked:eq("+ i +")").val()
          selId.push(val);
       }
      selId= selId.toString();
      if (selId) {
        window.location.href="__APP__/manage/download/id/"+selId; 
      } else {
        alert("批量下载请选择至少一项");
      };
  }

  function selectAll(){          //全选
     for(   i=0;i<$("input[type='checkbox']").length;i++  ){
       $("input[type='checkbox']")[i].checked=true;
         }
  }
  function selectAllNo(){         //取消
   $("input[type='checkbox']").attr("checked",false);
  }
  
  function registeraptitude(){
    if(confirm('确认保存客户的品种修改吗？')){
        var tips = $("#registerform input[name='aptitudeids[]']:checked");
        if(tips.length<=0){
            alert("请选择经营药品种类？");
            return false;
        }
        $("#registerform").submit();
    }
  }
</script>
</body>
</html>