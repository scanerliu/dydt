<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>

<script src="__PUBLIC__js/tc/common.js"></script>
<link href="__PUBLIC__css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div class="bannerList">
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="11">用户列表 
          <label style="padding-left:33px;">搜索类别</label>
          <?php if($keyv == 2): ?><select id="key">
                    <option value="1">用户名</option>
                    <option value="2" selected="true">联系人</option>
                    <option value="3">联系电话</option>
                </select>
            <?php elseif($keyv == 3): ?>
                <select id="key">
                    <option value="1">用户名</option>
                    <option value="2">联系人</option>
                    <option value="3" selected="true">联系电话</option>
                </select>
            <?php else: ?>
                <select id="key">
                    <option value="1">用户名</option>
                    <option value="2">联系人</option>
                    <option value="3">联系电话</option>
                </select><?php endif; ?>
          <label id="kw" style="margin-left:9px;">搜索关键字</label>
          <input type="text" id="keyword" placeholder="请输入搜索关键字" value="<?php echo ($keyword); ?>" />
          <input type="submit" style="width:60px;" onclick="ss()" value="搜索">
      </td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td>用户ID</td>
      <td>用户名</td>
      <td>真实姓名</td>
      <td>性别</td>
      <td>出生日期</td>
      <td>手机</td>
      <td>邮箱</td>
      <td>客户资质认证</td>
      <td>历史积分</td>
      <td>积分余额</td>
      <td>操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($vo["user_id"]); ?></td>
      <td>
      <a href="javascript:void(0)" onclick="showlayerwrap(<?php echo ($vo["user_id"]); ?>)"><?php echo ($vo["name"]); ?></a>
      </td>
      <td><?php echo ($vo["real_name"]); ?></td>
      <td><?php echo ($vo["sex"]); ?></td> 
      <td><?php echo ($vo["birthday"]); ?></td>
      <td><?php echo ($vo["mobile_phone"]); ?></td>
      <td><?php echo ($vo["email"]); ?></td>
      <td>
        <?php if($vo["doc"] == 0): ?>无资料
        <?php else: ?>
          <a href="__APP__/manage/doc_content/id/<?php echo ($vo["user_id"]); ?>" style="color:#db6969" title="点击查看详细">查看详细</a><br>
          <?php if(($vo["er"] != '') or ($vo["er"] != null)): ?>（<a style="color:#db6969"><?php echo ($vo["er"]); ?></a>）<?php endif; endif; ?>
      </td>
      <td><?php echo ($vo["sum_i"]); ?></td>
      <td><?php echo ($vo["surplus"]); ?></td>
      <td>
        <?php if($vo["sum_i"] != 0): ?><a href="__APP__/manage/integration/id/<?php echo ($vo["user_id"]); ?>" style="color:#db6969">积分明细</a>&nbsp;&nbsp;<?php endif; ?>
        <?php if($vo["lock"] == 0): ?><a href="__APP__/manage/lock/id/<?php echo ($vo["user_id"]); ?>" style="color:#db6969">暂停服务</a>
        <?php else: ?>
          <a href="__APP__/manage/lock_off/id/<?php echo ($vo["user_id"]); ?>" style="color:#db6969">开启服务</a><?php endif; ?>
        &nbsp;&nbsp;<a onClick="return confirm('确认要删除该企业信息吗？')"  href="__APP__/manage/del_user/id/<?php echo ($vo["user_id"]); ?>" style="color:#db6969">删除</a>
        <!-- <a href="__APP__/manage/login_uesr/id/<?php echo ($vo["user_id"]); ?>" style="color:#db6969">进入用户个人中心</a> -->
      </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
    </tr>
  </table>
</div>
<div style="margin-left:40%;margin-top:3%;" class="feny"><?php echo ($page); ?></div>

<div class="layerwrap" id="layertxwlwrap" style="display:none">
  <div class="layertxwlwrap">
    <p class="layerhead">个人资料<span class="layerclose fr"></span></p>
    <div class="layerinner">
      <table class="layertable" width="100%">
        <tr>
          <td width="90" class="tr">用户名：</td>
          <td width="90">
            <input style="height:20px;width:200px;padding:2px;background:#CCCCCC" readonly="readonly" id="name" type="text" >
          </td>
          <td width="90" class="tr">真实姓名：</td>
          <td width="90">
            <input style="height:20px;width:200px;padding:2px;background:#CCCCCC" readonly="readonly" id="real_name" type="text" >
          </td>
        </tr>
        <tr>
          <td width="90" class="tr">性别：</td>
          <td>
            <input style="height:20px;width:200px;padding:2px;background:#CCCCCC" readonly="readonly" id="sex" type="text" >
          </td>
          <td width="90" class="tr">出生日期：</td>
          <td>
            <input style="height:20px;width:200px;padding:2px;background:#CCCCCC" readonly="readonly" id="birthday" type="text" >
          </td>
        </tr>
        <tr>
          <td width="90" class="tr">手机：</td>
          <td>
            <input style="height:20px;width:200px;padding:2px;background:#CCCCCC" readonly="readonly" id="mobile_phone" type="text" >
          </td>
          <td width="90" class="tr">邮箱：</td>
          <td>
            <input style="height:20px;width:200px;padding:2px;background:#CCCCCC" readonly="readonly" id="eamil" type="text" >
          </td>
        </tr>
        <tr>
          <td width="60" class="tr">地址：</td>
          <td width="120">
            <input style="height:20px;width:200px;padding:2px;background:#CCCCCC" readonly="readonly" id="address" type="text">
          </td>
          <td width="90" class="tr">密码：</td>
          <td width="90">
            <input style="height:20px;width:200px;padding:2px;" type="text" id="password">
          </td>
        </tr>

        <tr>
          <td width="60" class="tr">机构名称：</td>
          <td width="120">
            <input style="height:20px;width:200px;padding:2px;" id="jgmc" type="text">
          </td>
          <td width="90" class="tr">机构编码：</td>
          <td width="90">
            <input style="height:20px;width:200px;padding:2px;" type="text" id="jgbm">
          </td>
        </tr>
        <tr>
          <td width="60" class="tr">机构地址：</td>
          <td width="120">
            <input style="height:20px;width:200px;padding:2px;" id="jgdz" type="text">
          </td>
          <td width="90" class="tr">机构等级“专指医疗机构”：</td>
          <td width="90">
            <input style="height:20px;width:200px;padding:2px;" type="text" id="jgdj">
          </td>
        </tr>
        <tr>
          <td width="60" class="tr">联系方式：</td>
          <td width="120">
            <input style="height:20px;width:200px;padding:2px;" id="lxfs" type="text">
          </td>
          <td width="90" class="tr">执照信息：</td>
          <td width="90">
            <input style="height:20px;width:200px;padding:2px;" type="text" id="zzxx">
          </td>
        </tr>
        <tr>
          <td width="60" class="tr">许可证信息：</td>
          <td width="120">
            <input style="height:20px;width:200px;padding:2px;" id="xkzxx" type="text">
          </td>
          <td width="90" class="tr">认证信息：</td>
          <td width="90">
            <input style="height:20px;width:200px;padding:2px;" type="text" id="rzxx">
          </td>
        </tr>
      </table>
      <div style="margin-left:305px;margin-top:20px;">
        <a id="su" title="确认" class="layersubmit" style="cursor: pointer;">确认</a>
        <a href="javascript:void(0)" title="取消" class="layercancel">取消</a>
      </div>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  var layerclose = $(".layerclose,.layercancel,#layernoticebut");
  layerclose.click(function(){
    $(this).parents(".layerwrap").stop(true,true).fadeOut("50");
  });

  function showlayerwrap(userid){
    var layerwrap = $("#layertxwlwrap");
    $.post("__APP__/manage/user_info", {userid:userid}, function (data) {
      if (data) {
        $('#name').val(data.name);
        $('#address').val(data.city1+""+data.city2+""+data.city3+""+data.address);
        $('#eamil').val(data.eamil);
        $('#mobile_phone').val(data.mobile_phone);
        $('#birthday').val(data.birthday);
        $('#real_name').val(data.real_name);
        $('#sex').val(data.sex);

        $('#jgbm').val(data.jgbm);
        $('#jgmc').val(data.jgmc);
        $('#jgdz').val(data.jgdz);
        $('#jgdj').val(data.jgdj);
        $('#lxfs').val(data.lxfs);
        $('#zzxx').val(data.zzxx);
        $('#xkzxx').val(data.xkzxx);
        $('#rzxx').val(data.rzxx);
        $('#su').attr('onclick','save('+data.user_id+')');
      }
    })
    if(layerwrap.length > 0){
      layerwrap.stop(true,true).fadeIn("100");
    }else{
      showlayernotice("error","错误","加载失败~")
    }
  }

  function showlayernotice(state,titile,content){
    var layernoticewrap = $("#layernoticewrap"),
      layernoticebut = $("#layernoticebut"),
      layernotiveinfoW = $("#layernotiveinfoW"),
      layerhead = $("#layerhead");
    if(layernoticewrap && layernoticebut && layernotiveinfoW){
      layerhead = layerhead.find("span").eq(0).html(titile);
      layernotiveinfoW.html(content);
      layernoticewrap.stop(true,true).fadeIn("100");
      $("#layer"+state).css("display","block");
    }else{
      alert(content);
    }
  }

  function save (userid) {
    var password = $('#password').val();
    var jgbm = $('#jgbm').val();
    var jgmc = $('#jgmc').val();
    var jgdz = $('#jgdz').val();
    var jgdj = $('#jgdj').val();
    var lxfs = $('#lxfs').val();
    var zzxx = $('#zzxx').val();
    var xkzxx = $('#xkzxx').val();
    var rzxx = $('#rzxx').val();
    $.post("__APP__/manage/save_pwd", {userid:userid,password:password,jgbm:jgbm,jgmc:jgmc,jgdz:jgdz,jgdj:jgdj,lxfs:lxfs,zzxx:zzxx,xkzxx:xkzxx,rzxx:rzxx}, function (data) {
      if (data) {
        $("#layertxwlwrap").stop(true,true).fadeOut("50");
        alert('资料已更新！');
      }
    })
  }

  function ss () {
    var key=document.getElementById('key').value;
    var keyword=document.getElementById('keyword').value;
    window.location.href="__APP__/manage/user/key/"+key+"/keyword/"+keyword;
  }

</script>
</body>
</html>