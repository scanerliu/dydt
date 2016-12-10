<?php
class companyAction extends commonAction {

    function company() {
        $where = '';
//        $gold_manu = M('gold_manu')->select();
        import('ORG.Util.Page');// 导入分页类
        $count=M('gold_manu')->where($where)->count();
        $Page=new Page($count,21);// 实例化分页类 传入总记录数和每页显示的记录数
        $show=$Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $gold_manu = M('gold_manu')->where($where)->order('sort_by desc')->limit($Page->firstRow.','.$Page->listRows) ->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('gold_manu', $gold_manu);
        $this->display();
    }

}
