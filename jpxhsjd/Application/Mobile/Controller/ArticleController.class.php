<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Mobile\Controller;
/**
 * 文档模型控制器
 * 文档模型列表和详情
 */
class ArticleController extends HomeController {

    /* 文档模型频道页 */
	public function index(){
		/* 分类信息 */
		$category = $this->category();
		//频道页只显示模板，默认不读取任何内容
		//内容可以通过模板标签自行定制
		/* 模板赋值并渲染模板 */
		$this->assign('category', $category);
		$this->display($category['template_index']);
	}

	/* 文档模型列表页 */
	public function lists($p = 1){
		/* 分类信息 */
		$category = $this->category();
		/* 获取当前分类列表 */
		$Document = D('Document');
		if($category['id']==45){
			$count=$Document->where('category_id='.$category['id'].' and status=1')->count();	
			$page=new \Think\Page($count,6);
			$list = $Document->order('level desc')->where('category_id=44 and status=1')->select();
			$cate=$Document->where('category_id='.$category['id'].' and status=1')->limit("$page->firstRow,$page->listRows")->select();
		}else{
			$count=$Document->order('level desc')->where('category_id='.$category['id'].' and status=1')->count();	
			$page=new \Think\Page($count,6);	
			$doc=$Document->order('level desc')->where('category_id='.$category['id'].' and status=1')->limit("$page->firstRow,$page->listRows")->select();
			$list = $Document->order('level desc')->where('category_id='.$category['id'].' and status=1')->select();
		}		
		$lx=M('document_lx')->find();
		$hd=M('config')->where('status=1 and id in(1,2,3)')->select();
		$picture=M('Document')->order('level desc')->where('status=1 and category_id=48 and position=2')->select();
		if(false === $list){
			$this->error('获取列表数据失败！');
		}
		if($_GET['gl']=='')
		{
			$gl=$list[0]['id'];
		}
		else
		{
			$gl=$_GET['gl'];
		}
		$this->assign("gl",$gl);
		/* 模板赋值并渲染模板 */
		$this->assign('category', $category);

		$this->assign('lx',$lx);

		$this->assign('picture',$picture);

		$this->assign('list', $list);

		$this->assign('cate',$cate);

		$this->assign('doc',$doc);

		$this->assign('hd',$hd);

		$this->assign('page',$page->show());

		$this->display($category['template_lists']);
	}
	/* 文档模型详情页 */
	public function detail($id = 0, $p = 1){
		/* 标识正确性检测 */
		if(!($id && is_numeric($id))){
			$this->error('文档ID错误！');
		}
		$lx=M('document_lx')->find();
		$picture=M('Document')->where('status=1 and category_id=48 and position=2')->select();
		/* 页码检测 */
		$p = intval($p);
		$p = empty($p) ? 1 : $p;

		/* 获取详细信息 */
		$Document = D('Document');
		$info = $Document->detail($id);
		if(!$info){
			$this->error($Document->getError());
		}
		/* 分类信息 */
		$category = $this->category($info['category_id']);
		/* 获取模板 */
		if(!empty($info['template'])){//已定制模板
			$tmpl = $info['template'];
		} elseif (!empty($category['template_detail'])){ //分类已定制模板
			$tmpl = $category['template_detail'];
		} else { //使用默认模板
			$tmpl = 'Article/'. get_document_model($info['model_id'],'name') .'/detail';
		}
		$hd=M('config')->where('status=1 and id in(1,2,3)')->select();
		/* 更新浏览数 */
		$map = array('id' => $id);
		$Document->where($map)->setInc('view');
		/* 模板赋值并渲染模板 */
		$this->assign('category', $category);
		$this->assign('info', $info);
		$this->assign('page', $p); //页码
		$this->assign('lx',$lx);
		$this->assign('picture',$picture);
		$this->assign('hd',$hd);
		$this->display($tmpl);
	}

	/* 文档分类检测 */
	private function category($id = 0){
		/* 标识正确性检测 */
		$id = $id ? $id : I('get.category', 0);
		if(empty($id)){
			$this->error('没有指定文档分类！');
		}

		/* 获取分类信息 */
		$category = D('Category')->info($id);
		if($category && 1 == $category['status']){
			switch ($category['display']) {
				case 0:
					$this->error('该分类禁止显示！');
					break;
				//TODO: 更多分类显示状态判断
				default:
					return $category;
			}
		} else {
			$this->error('分类不存在或被禁用！');
		}
	}
    public function getpage($count,$pagecount=5)
    {
        $p=new ThinkPage($count,$pagecount);
        $p->setConfig('prev','上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last','首页');
        $p->setConfig('first','尾页');
        $P->lastSuffix=false;//最后一页不显示为总页数
        return $p;
    }

}
