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
<body onload="myf()">
<div class="bannerList">
 <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;">
    <tbody><tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;" class="status">
      <td style="text-align:right">
        <a href="__APP__/manage/return_back/" class="button1">全部申请</a>
        <a href="__APP__/manage/return_back/status/1" class="button1">待审核</a>
        <a href="__APP__/manage/return_back/status/2" class="button1">已通过</a>
        <a href="__APP__/manage/return_back/status/3" class="button1">未通过</a>
        <a href="__APP__/manage/return_back/status/4" class="button1">已取消</a>
        <a href="__APP__/manage/return_back/status/5" class="button1">已退款</a>
        <a href="__APP__/manage/return_back/status/6" class="button1">处理完成</a>
      </td>
   </tr>
  </tbody></table>
  <script type="text/javascript">
    <?php if($_GET['status']): ?>$('.status a').eq(<?php echo ($_GET['status']); ?>).css('color','#06C')
    <?php else: ?> 
      $('.status a').eq(0).css('color','#06C')<?php endif; ?>
  </script>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="12">退货/退款订单列表
      <label style="padding-left:33px;">搜索类别</label>
        <?php if($keyv == 2): ?><select onchange="changvalue(this.value)" id="key">
              <option value="1">订单号</option>
              <option value="2" selected="true">用户名</option>
              <option value="3">申请时间</option>
              <option value="4">联系人</option>
              <option value="5">联系方式</option>
          </select>
        <?php elseif($keyv == 3): ?>
          <select onchange="changvalue(this.value)" id="key">
              <option value="1">订单号</option>
              <option value="2">用户名</option>
              <option value="3" selected="true">申请时间</option>
              <option value="4">联系人</option>
              <option value="5">联系方式</option>
          </select>
        <?php elseif($keyv == 4): ?>
          <select onchange="changvalue(this.value)" id="key">
              <option value="1">订单号</option>
              <option value="2">用户名</option>
              <option value="3">申请时间</option>
              <option value="4" selected="true">联系人</option>
              <option value="5">联系方式</option>
          </select>
        <?php elseif($keyv == 5): ?>
          <select onchange="changvalue(this.value)" id="key">
              <option value="1">订单号</option>
              <option value="2">用户名</option>
              <option value="3">申请时间</option>
              <option value="4">联系人</option>
              <option value="5" selected="true">联系方式</option>
          </select>
        <?php else: ?>
          <select onchange="changvalue(this.value)" id="key">
              <option value="1">订单号</option>
              <option value="2">用户名</option>
              <option value="3">申请时间</option>
              <option value="4">联系人</option>
              <option value="5">联系方式</option>
          </select><?php endif; ?>
      <label id="kw" style="margin-left:9px;">搜索关键字</label>
      <input type="text" id="keyword" placeholder="请输入搜索关键字" value="<?php echo ($keyword); ?>" />

      <label id="time" style="margin-left:9px;display:none">时间区间</label>
      <input id="bt" type="date" style="display:none;" value="<?php echo ($date1); ?>" />
      <label id="to" style="display:none">-</label>
      <input id="et" type="date" style="display:none" value="<?php echo ($date2); ?>" />

      <input type="submit" class="btnsure" onclick="ss()" value="搜索">
    </td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td style="width:120px;">订单号</td>
      <td style="width:60px;">用户ID</td>
      <td style="width:80px;">时间</td>
      <td style="width:200px;">商品详细</td>
      <td style="width:30px;">是否收到商品</td>
      <td style="width:20px;">是否退货</td>
      <td style="width:40px;">原因</td>
      <td style="width:200px;">说明</td>
      <td style="width:40px;">申请金额(元)</td>
      <td style="width:40px;">商品总价(元)</td>
      <td style="width:80px;">图片</td>
      <td style="width:60px;">操作</td>
      <td style="width:100px;">退货物流</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><a href="__APP__/order/orderDetail/order_id/<?php echo ($vo["order_id"]); ?>" style="color:#03C"><?php echo ($vo["order_num"]); ?></a></td>
      <td><?php echo ($vo["user_name"]); ?></td>
      <td><?php echo (date('Y-m-d H:i:s',$vo["date"])); ?></td>
      <td>
      <a href="/shop/content/product_id/<?php echo ($vo["product_id"]); ?>">
        <img style="width:80px;height:80px;float:left;" src="/Uploads/<?php echo ($vo["img"]); ?>">
      </a>
      <div style="padding:13px;"> 
        <labe style="color:#FF0080;"><?php echo ($vo["title"]); ?></label><br>
        <lable><?php echo ($vo["subhead"]); ?></lable><br><br>
      </div>
      </td> 
      <td>
        <?php if($vo['fruit'] == 1): ?>是
        <?php else: ?>
          否<?php endif; ?>
      </td>
      <td>
        <?php if($vo['is_back'] == 1): ?>是
        <?php else: ?>
          否<?php endif; ?>
      </td>
      <td><?php echo ($vo["cause"]); ?></td>
      <td><?php echo ($vo["note"]); ?></td>
      <td><?php echo ($vo["money"]); ?></td>
      <td><?php echo ($vo["total_price"]); ?></td>
      <td>
      <?php if(($vo["ph"] == null) or ($vo["ph"] == '')): ?>该用户没有上传图片
      <?php else: ?>
        <a rel="/Uploads/<?php echo ($vo["ph"]); ?>" class="preview">
          <img style="width:80px;height:80px;" src="/Uploads/<?php echo ($vo["ph"]); ?>">
        </a><?php endif; ?>
      </td>
      <td>
        <?php if($vo["status"] == 0): ?><a onClick="return confirm('确认要通过此退款/退货请求吗？')" href="__APP__/manage/return_ok/id/<?php echo ($vo["return_id"]); ?>" style="color:#03C">通过</a>
          <a onclick="alertpro()" style="margin-left:10px;cursor:pointer;color:red" name="<?php echo ($vo["return_id"]); ?>" id="alertpro">不通过</a>
        <?php elseif($vo["status"] == 1): ?>
          <a onclick="backmoney()" id="backmoney" name="<?php echo ($vo["return_id"]); ?>"  style="cursor:pointer;color:#03C">退款</a><br>
          (<?php echo ($vo["back"]); ?>)
        <?php elseif($vo["status"] == 2): ?>
          已拒绝该申请<br>(<?php echo ($vo["back"]); ?>)
        <?php elseif($vo["status"] == 3): ?>
          该申请已被取消
        <?php else: ?>
          已处理<br>(退款：￥<?php echo ($vo["back"]); ?>)<?php endif; ?>
      </td>
      <td>
      <?php if(($vo["express_num"] == '') or ($vo["express_num"] == null)): ?><label>无</label>
      <?php else: ?>
        <label><?php echo ($vo["express"]); ?></label><br>
        <label><?php echo ($vo["express_num"]); ?></label><br>
        <label>
          <?php if($vo["express"] == '圆通'): ?><a href="__APP__/manage/logistics/transport_company/yuantong/transport_code/<?php echo ($vo["express_num"]); ?>">查看物流</a>
        <?php elseif($vo["express"] == '韵达'): ?>
          <a href="__APP__/manage/logistics/transport_company/yunda/transport_code/<?php echo ($vo["express_num"]); ?>">查看物流</a>
        <?php elseif($vo["express"] == '申通'): ?>
          <a href="__APP__/manage/logistics/transport_company/shentong/transport_code/<?php echo ($vo["express_num"]); ?>">查看物流</a>
        <?php elseif($vo["express"] == '中通'): ?>
          <a href="__APP__/manage/logistics/transport_company/zhongtong/transport_code/<?php echo ($vo["express_num"]); ?>">查看物流</a>
        <?php elseif($vo["express"] == '顺风'): ?>
          <a href="__APP__/manage/logistics/transport_company/shunfeng/transport_code/<?php echo ($vo["express_num"]); ?>">查看物流</a>
        <?php elseif($vo["express"] == 'EMS'): ?>
          <a href="__APP__/manage/logistics/transport_company/ems/transport_code/<?php echo ($vo["express_num"]); ?>">查看物流</a><?php endif; ?>
        </label><?php endif; ?>
      </td>
       <script>
      function alertpro () {
          var alertpro = document.getElementById('alertpro');
          var name=prompt("请输入不通过的原因（注：原因为空将不能提交操作）","");
          if (name!=null && name!="") {
            alertpro.href = "__APP__/manage/return_no/id/"+alertpro.name+"/name/"+name;
            alertpro.onclick = "";
            alertpro.click();
          }
      }

      function backmoney () {
        var backmoney = document.getElementById('backmoney');
        var name=prompt("请输入最终退款金额（注：金额为空将不能提交操作）","");
        if (name!=null && name!="") {
          backmoney.href="__APP__/manage/back_money/id/"+backmoney.name+"/name/"+name;
          backmoney.onclick = "";
          backmoney.click();
        }
      }
      </script>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
    </tr>
  </table>
  <script type="text/javascript">
   function ss(){         //搜索
      var key=document.getElementById('key').value;
      if (key==3) {
        var bt=document.getElementById('bt').value;
        var et=document.getElementById('et').value;
        if (bt=="" || et=="" || bt>et) {
          alert('请选择一个正确的时间区间！');return;
        };
        window.location.href="__APP__/manage/return_back/date1/"+bt+"/date2/"+et+"/key/"+key;
      } else { 
        var keyword=document.getElementById('keyword').value;
        window.location.href="__APP__/manage/return_back/key/"+key+"/keyword/"+keyword;
      };
    }
    function myf () {
      var key=document.getElementById('key').value;
      if (key==3) {
        document.getElementById('kw').style.display="none";
        document.getElementById('keyword').style.display="none";
        document.getElementById('time').style.display="";
        document.getElementById('bt').style.display="";
        document.getElementById('to').style.display="";
        document.getElementById('et').style.display="";
      };
    }
    function changvalue (s) {
      if (s==3) {
        document.getElementById('kw').style.display="none";
        document.getElementById('keyword').style.display="none";
        document.getElementById('time').style.display="";
        document.getElementById('bt').style.display="";
        document.getElementById('to').style.display="";
        document.getElementById('et').style.display="";
      } else {
        document.getElementById('kw').style.display="";
        document.getElementById('keyword').style.display="";
        document.getElementById('time').style.display="none";
        document.getElementById('bt').style.display="none";
        document.getElementById('to').style.display="none";
        document.getElementById('et').style.display="none";
      };
    }
</script>
</div>
<div style="margin-left:40%;margin-top:30%;"><?php echo ($page); ?></div>
</body>
</html>