<?php
class indexManagementAction extends beginAction {
    function bannerList(){
	if(  $_GET['class']=='banner' ){
		  $m = M('index_banner'); // 实例化Data数据对象
		}
		elseif( $_GET['class']=='index_ad1' )
		{
		  $m = M('index_ad1'); // 实例化Data数据对象
		}
		else{
		  $m = M('index_ad2'); 
			}
		
  
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
	   if(  $_GET['class']=='banner' ){
		  $m = M('index_banner'); // 实例化Data数据对象
		}
		elseif( $_GET['class']=='index_ad1' ){
		  $m = M('index_ad1'); // 实例化Data数据对象
			}
		  else{
		  $m = M('index_ad2'); 
			}	
			
	   
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
	    $save_path = './Uploads/';
            $ymd = date("Ymd");
            $file_path = "images/".$ymd . "/";
            $save_path .= $file_path;
            if (!file_exists($save_path)) {
                    mkdir($save_path);
            }
            $upload->savePath = $save_path;
            //$upload->saveRule = '';

            if(!$upload->upload()) {// 上传错误提示错误信息
              $this->error($upload->getErrorMsg());
             }
	 	 else{// 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
         } 
 		 
		 if(  $_GET['class']=='banner' ){
		  $m = M('index_banner'); 
		}
		elseif( $_GET['class']=='index_ad1' ){
		  $m = M('index_ad1'); 
			}
			else{
		  $m = M('index_ad2'); 
			}
			
		 
	     $data['img'] = $file_path.$info[0]['savename'];
		 $data['link']=$_POST['link'];
		 $m->add($data);
		 $this->success('上传成功');
   }



   
  function bannerSave(){         // 文章修改
	  $where['index_banner_id']=$_GET['index_banner_id'];
  	  if(  $_GET['class']=='banner' ){
		  $m = M('index_banner'); // 实例化Data数据对象
		}
		elseif( $_GET['class']=='index_ad1' ){
		  $m = M('index_ad1'); 
			}
		else{
		  $m = M('index_ad2'); 
			}	
			
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
	    $save_path = './Uploads/';
            $ymd = date("Ymd");
            $file_path = "images/".$ymd . "/";
            $save_path .= $file_path;
            if (!file_exists($save_path)) {
                    mkdir($save_path);
            }
            $upload->savePath = $save_path;
            //$upload->saveRule = '';
            if(!$upload->upload()) {// 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
            }else{// 上传成功 获取上传文件信息
                $info =  $upload->getUploadFileInfo();
		$data['img'] = $file_path.$info[0]['savename'];
            } 
		endif;	   
		if(  $_GET['class']=='banner' ){
		  $m = M('index_banner'); 
		}
		elseif( $_GET['class']=='index_ad1' ){
		  $m = M('index_ad1'); 
			}   
		else{
		  $m = M('index_ad2'); 
			}	
 		  
		   $data['index_banner_id']=$_GET['index_banner_id'];
 	       $data['link']=$_POST['link'];
 		   $m->save($data);
		  $this->success('修改成功');
   }


    function simplePageList(){
    $m = M('simple_page'); // 实例化Data数据对象
    import('ORG.Util.Page');// 导入分页类
	$arr = $m->select();
    $this->assign('data',$arr);// 赋值数据集
     $this->display();
    }


  function simplePageSave(){         // 文章修改
	  $where['simple_page_id']=$_GET['simple_page_id'];
  	  $m=M('simple_page');
   	  $data=$m->where($where)->find();
	  $this->assign('data',$data);
      $this->display();
    } 
	
	


  function simplePageSaveFunUpload(){       // 文章修改 功能
			   
 		   $m = M("simple_page"); 
		   $data['simple_page_id']=$_GET['simple_page_id'];
    	   $data['time'] = time();
		    $data['content'] = $_POST['content'];

 		   $m->save($data);
		  $this->success('修改成功');
   }









	
}