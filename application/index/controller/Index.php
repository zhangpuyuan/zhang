<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
class Index extends Controller
{
    public function index()
    {
        return view();
    }
    public function add(){
    	$data = input('post.');
    	// dump($data);
    	$t_sql = Db::table('text')->insert($data);
    	if($t_sql){
    		$this->success('添加成功','index/show');
    	}else{
    		$this->success('添加失败','index/index');
    	}
    }
    public function show(){
    	$t_sql = Db::table('text')->paginate(1);
    	// dump($t_sql);
    	$page = $t_sql->render();
    	$this->assign('t_sql',$t_sql);
    	$this->assign('page',$page);
    	return view();
    }
    public function delete(){
    	$id = input('get.');
    	// dump($id);
    	$t_sql = Db::table('text')->where(['id'=>$id['id']])->delete();
    	// print_r($t_sql);
    	if($t_sql){
    		$this->success('删除成功','index/show');
    	}else{
    		$this->success('删除失败','index/show');
    	}
    	
    }
    public function updata(){
    	$id = input('get.');
    	$t_sql = Db::table('text')->where(['id'=>$id['id']])->find();
    	// dump($t_sql);
    	$this->assign('t_sql',$t_sql);
    	return view();
    }
    public function updata_1(){
    	$data = input('post.');
    	// print_r($data);die;
    	$t_sql = Db::table('text')->setField($data);
    	if($t_sql){
    		$this->success('修改成功','index/show');
    	}else{
    		$this->success('修改失败','index/show');
    	}
    }

}
