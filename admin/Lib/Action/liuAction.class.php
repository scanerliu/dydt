<?php
class liuAction extends beginAction
{
	// 刘大爷
		public function arcedite()
		{
			$where['class_child_id']=$_GET['class_child_id'];
			$list=M('arc_category')->where($where)->find();
			$this->assign('list',$list);
			$this->display();
		}


		public function arcchange()
		{

			$where['article_id']=$_GET['article_id'];
			$list=M('arccontent')->where($where)->find();
			$list['category_Name']=M('arc_category')->where('class_child_id='.$list['class_child_id'])->getfield('category_Name');

			$this->assign('list',$list);
			$this->display();
		}

		public function manuchange()
		{

			$where['article_id']=$_GET['article_id'];
			$list=M('arccontent')->where($where)->find();
			$list['category_Name']=M('arc_category')->where('class_child_id='.$list['class_child_id'])->getfield('category_Name');

			$this->assign('list',$list);
			$this->display();
		}


		public function listaa(){

			 $where['class_father_id']='';
			$list=M('arc_category')->where($where)->select();
             for( $i=0;$i<count($list);$i++){
                $where='';
                $where['class_father_id']=$list[$i]['id'];
                $list[$i]['zl']=M('arc_category')->where($where)->select();
               // var_dump($list[$i]['zl']);
             }
			$this->assign('asdsdaf',$list);
			$this->display();
		}

		public function listbb(){

			 $where['class_father_id']='';
			$list=M('arc_category')->where($where)->select();
             for( $i=0;$i<count($list);$i++){
                $where='';
                $where['class_father_id']=$list[$i]['other_id'];
                $list[$i]['zl']=M('arc_category')->where($where)->order('other_id asc')->select();
              // var_dump($list[$i]['zl']);
             }
			$this->assign('asdsdaf',$list);
			$this->display();
		}

		public function listcc(){
			// $where['class_child_id']=$_GET['class_child_id'];
			$newlist=M('gold_manu')->select();
			$this->assign('newlist',$newlist);
			$this->display();
		}

		 public function goldDel()
    {
        $where['gold_id'] = $_GET['id'];
        M('gold_manu')->where($where)->delete();
        $this->success('删除成功', '/admin.php/liu/listcc',2);
    }

    	 public function arcticleDel()
    {
        $where['article_id'] = $_GET['id'];
         M('arccontent')->where($where)->delete();
        $this->success('删除成功', '/admin.php/liu/listaa');
    }

		public function productList()
		{
			$where['class_child_id']=$_GET['class_child_id'];
			$newlist=M('arccontent')->where($where)->select();
			$this->assign('newlist',$newlist);

			$this->display();
		}




		public function gold_manu(){
			$data['gold_name']=$_POST['title'];
			$data['gold_content']=$_POST['arccontent'];
                        $data['sort_by']=$_POST['sort_by'];
			// 文件上
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Uploads/';// 设置附件上传目录
			 if(!$upload->upload()) {
			 // 上传错误提示错误信息
			   $this->error($upload->getErrorMsg());
			 }
			 else
			 {// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			};
			$data['gold_pic']=$info[0]['savename'];
		M('gold_manu')->add($data);
		$this->success('添加成功','',4);


		}

		public function fabu()
		{
		$data['hotarc']=$_POST['hotarc'];
		$data['recommended_headlines']=$_POST['recommended_headlines'];
		$data['hot_topics']=$_POST['hot_topics'];
		$data['middle_topic']=$_POST['middle_topic'];
		$data['class_child_id']=$_POST['se'];
		$data['title']=$_POST['title'];
		$data['arccontent']=$_POST['arccontent'];
		$data['hotarc']=$_POST['hotarc'];
		$data['time']=date('Y-m-d');
		 // var_dump($data);exit;
		// 文件上
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Uploads/';// 设置附件上传目录
			 if(!$upload->upload()) {
			 // 上传错误提示错误信息
			   $this->error($upload->getErrorMsg());
			 }
			 else
			 {// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			};
			$data['thumbnail']=$info[0]['savename'];

			// 文件上传end
	     M('arccontent')->add($data);
		$this->success('添加成功','',100);
 
	}
	public function change()
		{
		$where['article_id']=$_POST['article_id'];
		$data['class_child_id']=$_POST['se'];
		$data['title']=$_POST['title'];
		$data['arccontent']=$_POST['arccontent'];
		$data['hotarc']=$_POST['hotarc'];
		$data['time']=date('Y-m-d H:i:s');
		// var_dump($data);exit;
		// 文件上
		if ($is_img_upload) {
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Uploads/';// 设置附件上传目录
			 if(!$upload->upload()) {
			 // 上传错误提示错误信息
			   $this->error($upload->getErrorMsg());
			 }
			 else
			 {// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			};
			$data['thumbnail']=$info[0]['savename'];
		}

			// 文件上传end
	     M('arccontent')->where($where)->save($data);
		$this->success('添加成功','/admin.php/liu/listbb',2);
 
	}

Public function upload(){
 import('ORG.Net.UploadFile');
$upload = new UploadFile();// 实例化上传类
$upload->maxSize  = 3145728 ;// 设置附件上传大小
$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
 if(!$upload->upload()) {// 上传错误提示错误信息
$this->error($upload->getErrorMsg());
 }else{// 上传成功 获取上传文件信息
$info =  $upload->getUploadFileInfo();
$this->success('上传成功！');
 }

		
	}
		// 刘大爷

// 广告
    function bannerList(){
	// if(  $_GET['class']=='banner' ){
	// 	  $m = M('index_banner'); // 实例化Data数据对象
	// 	}
	// 	elseif( $_GET['class']=='index_ad1' )
	// 	{
		  $m = M('list_ad1'); // 实例化Data数据对象
	//	}
	//	else{
	//	  $m = M('in.
	//	  	dex_ad2'); 
	//		}
		 
  
    import('ORG.Util.Page');// 导入分页类
		
	$count   = $m->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
    $Page   = new Page($count,10);// 实例化分页类 传入总记录数
    $show   = $Page->show();// 分页显示输出
	$arr = $m->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
    $this->assign('data',$arr);// 赋值数据集
    $this->assign('page',$show);// 赋值分页输出
     $this->display();
    }



	 function bannerListFunDel(){          // 删除
	  //   if(  $_GET['class']=='banner' ){
	 	//   $m = M('index_banner'); // 实例化Data数据对象
	 	// }
	 	// elseif( $_GET['class']=='index_ad1' ){
	 	//   $m = M('index_ad1'); // 实例化Data数据对象
	 	// 	}
	 	//   else{
	 	  $m = M('list_ad1'); 
	 	//	}	
			
	   
	       $selId=explode( ',',$_GET['id']);
	       for( $i=0; $i< count( $selId,0);$i++ ){
              $where['index_banner_id']= $selId[$i];	  
	          $m->where( $where)->delete();
 	       }
		
	   $this->success('删除成功');
     } 

	
	 
  function bannerAddFunUpload(){       // 上传
	   import('ORG.Net.UploadFile');
	   $upload = new UploadFile();// 实例化上传类
	   $upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->savePath = './Uploads/';// 设置附件上传目录

       if(!$upload->upload()) {// 上传错误提示错误信息
         $this->error($upload->getErrorMsg());
             }
	 	 else{// 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
         } 
 		 
		//  if(  $_GET['class']=='banner' ){
		//   $m = M('index_banner'); 
		// }
		// elseif( $_GET['class']=='index_ad1' ){
		//   $m = M('index_ad1'); 
		// 	}
		// 	else{
		  $m = M('list_ad1'); 
		//	}
			
		 
	     $data['img'] = $info[0]['savename'];
		 $data['link']=$_POST['link'];
		 $m->add($data);
		 $this->success('上传成功');
   }



   
  function bannerSave(){         // 文章修改
	  $where['index_banner_id']=$_GET['index_banner_id'];
  // 	  if(  $_GET['class']=='banner' ){
		//   $m = M('index_banner'); // 实例化Data数据对象
		// }
		// elseif( $_GET['class']=='index_ad1' ){
		  $m = M('list_ad1'); 
		// 	}
		// else{
		//   $m = M('index_ad2'); 
		// 	}	
			
   	  $data=$m->where( $where)->find();
	  $this->assign('data',$data);
      $this->display();
    } 
	

  function bannerSaveFunUpload(){       // 文章修改 功能
  if( $_FILES['file']['name']) :
 	   import('ORG.Net.UploadFile');
	   $upload = new UploadFile();// 实例化上传类
	   $upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->savePath = './Uploads/';// 设置附件上传目录
            if(!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
              }
 	        else{// 上传成功 获取上传文件信息
              $info =  $upload->getUploadFileInfo();
		      $data['img'] = $info[0]['savename'];
               } 
		endif;	   
		// if(  $_GET['class']=='banner' ){
		//   $m = M('index_banner'); 
		// }
		// elseif( $_GET['class']=='index_ad1' ){
		//   $m = M('index_ad1'); 
		// 	}   
		// else{
		  $m = M('list_ad1'); 
		//	}	
 		  
		   $data['index_banner_id']=$_GET['index_banner_id'];
 	       $data['link']=$_POST['link'];
 		   $m->save($data);
		  $this->success('修改成功');
   }


	// 广告end



}
?>