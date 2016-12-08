<?php
class notifyAction extends commonAction
{
    public function _initialize() {
        vendor('Alipay.Corefunction');
        vendor('Alipay.Notify');
        vendor('Alipay.RsaFunction');
        vendor('Alipay.Submit');   
    }
    public function alipayNotify()
    {
        Log::write('alipay notify info：'.json_encode($_POST), Log::ERR);
        $alipay_config=C('alipay_config');
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];
            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                        //判断该笔订单是否在商户网站中已经做过处理
                                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                                //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                                //如果有做过处理，不执行商户的业务程序

                        //注意：
                        //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                $orderp = M('order')->where("order_num=".$out_trade_no)->find();
                if($orderp['status']==1){//未支付的修改订单状态
                    $data = NULL;
                    $data['status'] = 2;	
                    $data['time2'] = time();
                    $where['order_id'] = $orderp['order_id'];
                    M('order')->where($where)->save($data);                    
                }
            }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                        //判断该笔订单是否在商户网站中已经做过处理
                                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                                //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                                //如果有做过处理，不执行商户的业务程序

                        //注意：
                        //付款完成后，支付宝系统发送该交易状态通知

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
                $orderp = M('order')->where("order_num=".$out_trade_no)->find();
                if($orderp['status']==1){//未支付的修改订单状态
                    $data = NULL;
                    $data['status'] = 2;	
                    $data['time2'] = time();
                    $where['order_id'] = $orderp['order_id'];
                    M('order')->where($where)->save($data);                    
                }
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";		//请不要修改或删除
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }else {
            //验证失败
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }
    public function alipayReturn()
    {
        Log::write('alipay return info：'.json_encode($_GET), Log::ERR);
        $alipay_config=C('alipay_config');
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];
            //支付宝交易号
            $trade_no = $_GET['trade_no'];
            //交易状态
            $trade_status = $_GET['trade_status'];
            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                $orderp = M('order')->where("order_num=".$out_trade_no)->find();
                if($orderp['status']==1){//未支付的修改订单状态
                    $data = NULL;
                    $data['status'] = 2;	
                    $data['time2'] = time();
                    $where['order_id'] = $orderp['order_id'];
                    M('order')->where($where)->save($data);                    
                }
            }
        }
        redirect(  '/order/orderDetail2_mid/order_id/' . $_GET['out_trade_no'] );
    }
}