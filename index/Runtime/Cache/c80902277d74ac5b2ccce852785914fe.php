<?php if (!defined('THINK_PATH')) exit();?><body onload="lod()">
    <script>
        var cnt = 2;
        function lod(){
        if(cnt < 0){
        window.location.href = "/";
        }else{
        document.getElementById("showTime").innerHTML = "页面<font color=red>" + cnt + "</font>秒后跳转";
        cnt--;
        }
        setTimeout("lod()",1000);
        }
    </script>
  <!-- 头部 -->
    <header>
        <a class="back" href="/"></a>
    </header>
    <img src="__PUBLIC__images/404.png">
    <div id="showTime"></div>
</body>
</html>