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
<div class="bannerList">
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;">
    <tbody>
      <tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;" class="status">
        <td style="text-align:left; line-height:24px;"><form  action="/admin.php/order/couponFun" method="POST" name="form" >
            <div style="float:left"> <span style="color:#F00">优惠券发放</span>— </div>
            <div style="float:left">&nbsp;&nbsp;
              发放对象
              <input  type="text"  class="input1" style="width:200px;"  placeholder="请输入用户id/为空则为全部" name="user_id" value=""/>
            </div>
            <div style="float:left">&nbsp;&nbsp;
              <input  type="text"  class="input1" style="width:100px;"  placeholder="请输入金额" name="num" value=""  my_check='number_need' error=' 金额错误' />
            </div>
            <script type="text/javascript" src="/admin/Tpl/public/js/laydate.js"></script>
            <div style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;开始时间：</div>
            <li class="inline laydate-icon" id="start" style="width:100px; margin-right:10px; float:left"><?php echo ($_GET['begtime']); ?></li>
            <input name="begtime" type="hidden" value=""  my_check='need' error='开始时间错误' />
            <div style="float:left">结束时间：</div>
            <li class="inline laydate-icon" id="end" style="width:100px; float:left"><?php echo ($_GET['endtime']); ?></li>
            <input name="endtime" type="hidden" value=""   my_check='need' error=' 结束时间错误'  />
            &nbsp;&nbsp;<a class="button1"  onclick="formsubmit()">提交</a>
          </form></td>
      </tr>
    </tbody>
  </table>
  <script type="text/javascript">
  //日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: '2015-01-01', //设定最小日期为当前日期
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
    	   function  formsubmit(){
  		  $("input[name='begtime']").val( $('#start').html() );
		  $("input[name='endtime']").val( $('#end').html() );
		    if(!my_check()){return}; 
		   form.submit();
 		 }
     </script>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;">
    <tbody>
      <tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;" class="status">
        <td style="text-align:left; line-height:24px;"><form  action="/admin.php/order/coupon" method="get" name="search_form" >
            <div style="float:left"><span style="color:#09C">优惠券检索</span>_</div>
            <div style="float:left">&nbsp;&nbsp;
               <input  type="text"  class="input1" style="width:200px;"  placeholder="请输入用户id/为空则为全部" name="user_id" value="<?php echo ($_GET['user_id']); ?>"/>   
            </div>
            <div style="float:left">&nbsp;&nbsp;
              <select name="status">
                <option value="">全部</option>
                <option value="1">未使用</option>
                <option value="2">已使用</option>
                <option value="3">已过期</option>
              </select>
              <script type="text/javascript">
                $("select[name='status'] ").find("option[value='<?php echo ($_GET['status']); ?>'] ").get(0).selected = true;
             </script> 
            </div>
            &nbsp;&nbsp;<a class="button1"  onclick="search_form.submit()">提交</a>
          </form></td>
      </tr>
    </tbody>
  </table>
     
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="">用户id</td>
      <td width="">状态</td>
      <td width="">金额</td>
      <td width="">开始时间</td>
      <td width="">结束时间</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><?php echo ($vol["user_id"]); ?></td>
        <td height="30"><?php echo ($vol["status"]); ?></td>
        <td width=""><?php echo ($vol["num"]); ?></td>
        <td width=""><?php echo (date('Y年m月d日',$vol["begtime"])); ?></td>
        <td width=""><?php echo (date('Y年m月d日',$vol["endtime"])); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
      <td  colspan="9" bgcolor="#fbfce2"  height="36" class="feny"><?php echo ($page); ?></td>
    </tr>
  </table>
</div>
</body>
</html>