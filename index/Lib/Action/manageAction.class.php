<?php
class manageAction extends commonAction
{
    public function suggest()
    {
        import('ORG.Util.Page');// 导入分页类
        $count = M('suggest')->where('user_id='.session('user_id').' and status=1')->count();
        $Page = new Page($count,3);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出

        $list = M('suggest')->where('user_id='.session('user_id').' and status=1')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }

    public function save_sug()
    {
    	$mobile_phone = $_POST['mobile_phone'];
    	$email = $_POST['email'];
    	$qq = $_POST['qq'];
    	$user_id = session('user_id');
    	$date = strtotime(date('Y-m-d H:i:s'));
    	$note = $_POST['note'];
    	if ($note=="") {
    		$this->error('投诉建议不能为空！');
    	} elseif ($mobile_phone=="" && $email=="" && $qq=="") {
    		$this->error('为了方便我们联系您，请留下至少一种联系方式！');
    	} else {
    		$data = array('mobile_phone' => $mobile_phone,
    					  'email' => $email,
    					  'qq' => $qq,
    					  'user_id' => $user_id,
    					  'date' => $date,
    					  'note' => $note
    			);

    		$result = M('suggest')->add($data);
    		if ($result) {
    			$this->success('提交成功！');
    		} else {
    			$this->error('提交失败，请重新提交！');
    		}
    	}
    }

    public function integration()
    {
        $sum = 0;
        $user_id = session('user_id');
        import('ORG.Util.Page');// 导入分页类
        $count = M('order')->where('user_id='.$user_id)->count();
        $Page = new Page($count,9);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        $list = M('order')->where('user_id='.$user_id.' and status!=1')->limit($Page->firstRow.','.$Page->listRows)->select();
        for ($i=0; $i < count($list); $i++) { 
            $list[$i]['p'] = M('order_product')->where('order_id='.$list[$i]['order_id'])->limit($Page->firstRow.','.$Page->listRows)->select();
            for ($j=0; $j < count($list[$i]['p']); $j++) { 
                $sum += $list[$i]['p'][$j]['total_price'];
                $return = M('return')->where('order_id='.$list[$i]['p'][$j]['order_id'].' and product_id='.$list[$i]['p'][$j]['product_id'].' and status=4')->getfield('money');
                if($return){
                    $list[$i]['p'][$j]['return'] = $return;
                } else {
                    $list[$i]['p'][$j]['return'] = 0;
                }
                $sum-=$list[$i]['p'][$j]['return'];
            }

            $sum+=$list[$i]['express_fee'];
            $sum-=$list[$i]['points_reduce']/100;
            $sum=floor($sum);
        }
        $this->assign('sum',$sum);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function evaluate()
    {
        $user_id = session('user_id');
        import('ORG.Util.Page');// 导入分页类
        $count = M()->table(array('comment'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,9);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询
        $list = M()->table(array('comment'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->limit($Page->firstRow.','.$Page->listRows)->select();
        for ($i=0; $i < count($list); $i++) { 
            $list[$i]['img'] = M('product_img')->where('product_id='.$list[$i]['product_id'])->getfield('img');
            $list[$i]['content'] = mb_substr($list[$i]['content'],0,100,'utf-8');
        }
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
}