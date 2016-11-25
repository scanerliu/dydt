<?php
// 本类由系统自动生成，仅供测试用途
class newsmanuAction extends commonAction {
           function  newsmanu(){
           	$m=M('arccontent');
           	$article_id=$_GET['id'];
           	$browse_num=$m->where('article_id='.$article_id)->getfield('browse_num');
           	$browse_num=intval($browse_num);
           	$browse_num+=1;
           	$data['browse_num']=$browse_num;
           	$m->where('article_id='.$article_id)->save($data);
           	$list=$m->where('article_id='.$article_id)->find();
           	$this->assign('list',$list);
            $m2=M('arc_category');
            $class_father_content=$m2->where('class_child_id='.$_GET['id'])->find();
            $class_father=intval($class_father_content['class_father_id']);
            $hello1=$m2->where('other_id='.$class_father )->find();
            $this->assign('hello1',$hello1);


             $where['class_father_id']=$class_father;
             $list=M('arc_category')->where($where)->select();
             for( $i=0;$i<count($list);$i++){
                $where='';
                $where['class_father_id']=$class_father;
                $list[$i]['zl']=M('arc_category')->where($where)->order('category_Name asc')->select();          
                   }
      $this->assign('asdsdaf',$list);

	        $this->display();
			}

   

			

		
		
		
   
   
   
   
   
   
   
   
   
   
	
	
}