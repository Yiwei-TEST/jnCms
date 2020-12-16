<?php

namespace app\admin\controller;
use app\admin\model\AnnModel;
use think\Db;

class Novel extends Base
{

    /**
     * [index 文章列表]
     * @author [田建龙] [864491238@qq.com]
     */
    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['title'] = ['like',"%" . $key . "%"];
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = config('list_rows');// 获取总条数
        $count = Db::name('ann')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $article = new AnnModel();
        $lists = $article->getArticleByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count);
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }


    /**
     * [add_article 添加文章]
     * @return [type] [description]
     * @author [田建龙] [864491238@qq.com]
     */
    public function add_article()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $article = new AnnModel();
            $flag = $article->insertArticle($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        return $this->fetch();
    }


    /**
     * [edit_article 编辑文章]
     * @return [type] [description]
     * @author [田建龙] [864491238@qq.com]
     */
    public function edit_article()
    {
        $article = new AnnModel();
        if(request()->isAjax()){

            $param = input('post.');
            $flag = $article->updateArticle($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
        $this->assign('article',$article->getOneArticle($id));
        return $this->fetch();
    }

    /**
     * [del_article 删除文章]
     * @return [type] [description]
     * @author [田建龙] [864491238@qq.com]
     */
    public function del_article()
    {
        $id = input('param.id');
        $cate = new AnnModel();
        $flag = $cate->delArticle($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }


}
