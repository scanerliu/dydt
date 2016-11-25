<?php
	class logisticsAction extends commonAction{
		public function logistics()
		{
			
		 $data=M('order')->where("order_id='$_GET[order_id]'")->find();
 	     $this->assign('order',$data);   
		 
 			$typeCom = $_GET["transport_company"];//获得快递公司
			$typeNu = $_GET["transport_code"];//获得快递单号
			if(isset($typeCom)&&isset($typeNu)){
				$AppKey='dee19f1123760151';
				$url= 'http://www.kuaidi100.com/applyurl?key='.$AppKey.'&com='.$typeCom.'&nu='.$typeNu;
				if(function_exists('curl_init') == 1){
					$curl = curl_init();
					curl_setopt ($curl, CURLOPT_URL, $url);
					curl_setopt ($curl, CURLOPT_HEADER,0);
					curl_setopt ($curl, CURLOPT_RETURNTRANSFER,1);
					curl_setopt ($curl,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
					curl_setopt ($curl, CURLOPT_TIMEOUT,5);
					$get_content = curl_exec($curl);
					curl_close ($curl);
				}else{
					include("snoopy.php");
					$snoopy = new snoopy();
					$snoopy->referer ='google';
					$snoopy->fetch($url);
					$get_content = $snoopy->results;
				}
				$get_content=iconv('UTF-8','GB2312//IGNORE', $get_content);
				$this->assign('get_content',$get_content);
				//print_r('<iframe src="'.$get_content.'" width="580"height="380"><br/>' . $powered);
			}else{
			}
			$this->display();
		}
	}
?>