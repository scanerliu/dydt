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
<form action="__APP__/system/baseFunUpload" method="post" name="form" enctype="multipart/form-data" >
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr >
      <td style="text-align:left"><div >title:</div>
        <div style=" padding-bottom:10px;">
          <textarea name="title"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["title"]); ?></textarea>
        </div></td>
    </tr>
    <tr >
      <td style="text-align:left"><div >keywords:</div>
        <div style=" padding-bottom:10px;">
          <textarea name="keywords"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["keywords"]); ?></textarea>
        </div></td>
    </tr>
    <tr >
      <td style="text-align:left"><div >description:</div>
        <div style=" padding-bottom:10px;">
          <textarea name="description"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["description"]); ?></textarea>
        </div></td>
    </tr>
    <tr>
      <td style="text-align:left"><div style="line-height:30px;">友情链接 </div>
        <textarea name="link"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo (stripslashes($data["link"])); ?></textarea></td>
    </tr>
    <tr>
      <td style="text-align:left"><div style="line-height:30px;">交易服务费</div>
        <textarea name="service_charge"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["service_charge"]); ?></textarea></td>
    </tr>
    
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
        <tr>
      <td style="text-align:left"><div style="line-height:30px;">电子合同</div>
            <textarea id="content1"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo (stripslashes($data["contract"])); ?></textarea>
           <textarea   name="contract" style="display:none"></textarea>
       </td>
    </tr>
    
    
    
    
     <tr>
      <td style="text-align:left"><div style="line-height:30px;">qq </div>
        <textarea name="qq"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["qq"]); ?></textarea></td>
    </tr>
    <tr>
      <td style="text-align:left"><div style="line-height:30px;">搜索关键字-  请使用 关键字/关键字/关键字 形式 </div>
        <textarea name="search_keyword"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["search_keyword"]); ?></textarea></td>
    </tr>
    <tr>
      <td style="text-align:left"><div style="line-height:30px;">微博地址</div>
        <textarea name="weibo"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["weibo"]); ?></textarea></td>
    </tr>
    <tr>
      <td style="text-align:left"><div style="line-height:30px;">快递费</div>
        <textarea name="express_fee"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["express_fee"]); ?></textarea></td>
    </tr>
    <tr>
      <td style="text-align:left"><div style="line-height:30px;">电话</div>
        <textarea name="tel"  style="width:490px;height:50px; padding:10px; border:1px  solid #CCC"><?php echo ($data["tel"]); ?></textarea></td>
    </tr>
    <tr>
      <td style="text-align:left"><div style="line-height:30px;">折扣&nbsp;<input name="discount"    class="input1"  my_check='discount'  value="<?php echo ($data["discount"]); ?>"  error='折扣设置错误' type="text" >  <span style="color:#999">不填 表示不打折 ，请设置1-99之间的数字 </span> </div>
       </td>
    </tr>
     <tr>
      <td style="text-align:left"><div style="line-height:30px;">满&nbsp;<input name="reduce_money1"    class="input1"  my_check='number'  value="<?php echo ($data["reduce_money1"]); ?>"  error='全场满减设置错误' type="text" > &nbsp;&nbsp;减&nbsp;<input name="reduce_money2"    class="input1"  my_check='number'  value="<?php echo ($data["reduce_money2"]); ?>"  error='全场满减设置错误' type="text" >  <span style="color:#999"> 不填 表示不生效 </span> </div>
       </td>
    </tr>
        <tr>
      <td style="text-align:left"><div style="line-height:30px;">1元人民币换取多少积分&nbsp;<input name="get_cash"    class="input1"  my_check='number'  value="<?php echo ($data["get_cash"]); ?>"  error='1元人民币换取多少积分设置错误' type="text" ></div>
       </td>
    </tr>
     <tr>
      <td style="text-align:left"><div style="line-height:30px;">1积分当做多少分人民币&nbsp;<input name="use_cash"    class="input1"  my_check='number'  value="<?php echo ($data["use_cash"]); ?>"  error='1积分当做多少分人民币设置错误' type="text" ></div>
       </td>
    </tr>
       <tr>
    <tr style="height:36px;">
      <td style="text-align:left;"><a href="javascript:void(0)" class="button1"  onclick=" formSubmit()">确定</a></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
function formSubmit(){
  $("textarea[name='contract']").html(editor.html());  
 	if(!my_check()){return};
 	  form.submit();
	}
</script>


</body>
</html>