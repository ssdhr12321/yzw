<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Mobile\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {
    public function _initialize(){
        if (!is_mobile()) {
            $this->redirect('Home/Index/index');   
        }
    }
	//系统首页
    public function index(){
        $category = D('Category')->getTree();
        $lists    = D('Document')->lists(null);
        $list=D('Document')->order('level desc')->where('status=1 and position=4 and category_id=43')->limit(3)->select();
        $ls=D('Document')->order('level desc')->where('status=1 and position=4 and category_id=41')->select();
		$picture=M('Document')->order('level desc')->where('status=1 and category_id=48 and position=2')->select();
		$lx=D('document_lx')->find();
        $gywm=D('document')->order('level desc')->where('position=4 and status=1')->lists('39');
        $hd=M('config')->where('status=1 and id in(1,2,3)')->select();
        $syimg=D('Document')->order('level desc')->where('status=1 and category_id=48 and position=4')->select();
		$this->assign('picture',$picture);
        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',D('Document')->page);//分页
		$this->assign('lx',$lx);
		$this->assign('list',$list);
        $this->assign('ls',$ls);            
		$this->assign('gywm',$gywm[3]);    
        $this->assign('hd',$hd);   
        $this->assign('syimg',$syimg);     
        $this->display();
    }

}