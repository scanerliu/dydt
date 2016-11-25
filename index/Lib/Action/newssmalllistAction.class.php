 <?php
// 本类由系统自动生成，仅供测试用途
class newssmalllistAction extends commonAction {
           function  newssmalllist(){
           	$class_child_id=$_GET['id'];

			import('ORG.Util.Page');// 导入分页类
			$count=M('arccontent')->where('class_child_id='.$class_child_id)->count();// 查询满足要求的总记录数 $map表示查询条件
			$Page = new Page($count,10);// 实例化分页类 传入总记录数
			$show = $Page->show();
			       
	       	$list=M('arccontent')->where('class_child_id='.$class_child_id)->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);
			$this->assign('Page',$show);// 赋值分页输出
			$leiming=M('arc_category')->where('class_child_id='.$class_child_id)->find();
			
			$this->assign('leiming',$leiming);
			$m2=M('arc_category');
            $class_father_content=$m2->where('class_child_id='.$_GET['id'])->find();
            $class_father=intval($leiming['class_father_id']);
            $hello1=$m2->where('id='.$class_father )->find();
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