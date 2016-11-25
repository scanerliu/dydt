<?php
// 本类由系统自动生成，仅供测试用途
class newslistAction extends commonAction {
           function  newslist(){
	        // $this->display();  
	        //热点文章
			$list=M('arccontent')->where('hotarc=1')->order('article_id desc')->select();
			$this->assign('list',$list);
			//推荐头条
			$list2=M('arccontent')->where('recommended_headlines=1')->order('article_id desc')->select();
			$this->assign('list2',$list2);
			//妇科
			$list3=M('arccontent')->where('class_child_id=61')->order('article_id desc')->select();
			$this->assign('list3',$list3);
			//男科
			$list4=M('arccontent')->where('class_child_id=62')->order('article_id desc')->select();
			$this->assign('list4',$list4);
			//儿科
			$list5=M('arccontent')->where('class_child_id=63')->order('article_id desc')->select();
			$this->assign('list5',$list5);
			//热门话题
			$list6=M('arccontent')->where('hot_topics=1')->order('article_id desc')->select();
			$this->assign('list6',$list6);
			//最中间的一些文章
			$list7=M('arccontent')->where('middle_topic=1')->order('article_id desc')->select();
			$this->assign('list7',$list7);
			//广告
			$list8=M('list_ad1')->order('index_banner_id asc')->select();
			$this->assign('list8',$list8);
			$this->display();
			}


}