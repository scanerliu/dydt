<?php
class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
                //Log::write('wxpay query：'.json_encode($result), Log::DEBUG);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
                //Log::write('call back:'.json_encode($data), Log::DEBUG);
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
                //订单处理
                $orderno = substr($data["out_trade_no"], 6);
                $whe['order_num'] = $orderno;
                $orderp = M('order')->where($whe)->find();
                if($orderp['status']==1){//未支付的修改订单状态
                    $data = NULL;
                    $data['status'] = 2;	
                    $data['time2'] = time();
                    $where['order_id'] = $orderp['order_id'];
                    M('order')->where($where)->save($data);                    
                }
		return true;
	}
}
?>

