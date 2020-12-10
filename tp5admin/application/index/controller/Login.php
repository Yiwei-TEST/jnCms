<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\MemberModel;
use org\Verify;
use com\Geetestlib;
class Login extends Controller
{
    public function login() {
        return $this->fetch('index/login');
    }

    public function doLogin()
    {
        $username = input("param.username");
        $password = input("param.password");
        $code = input("param.code");
        $result = $this->validate(compact('username', 'password'), 'IndexValidate');
        if(true !== $result){
            return json(['code' => -5, 'url' => '', 'msg' => $result]);
        }
        if (!$code) {
             return json(['code' => -4, 'url' => '', 'msg' => '请输入验证码']);
         }
        $verify = new Verify();
         if (!$verify->check($code)) {
                return json(['code' => -4, 'url' => '', 'msg' => '验证码错误']);
        }
        $hasUser = Db::name('member')->where('account', $username)->find();
        if(empty($hasUser)){
            return json(['code' => -1, 'url' => '', 'msg' => '会员不存在']);
        }

        if(md5(md5($password) . config('auth_key')) != $hasUser['password']){
            writelog($hasUser['id'],$username,'用户【'.$username.'】登录失败：密码错误',2);
            return json(['code' => -2, 'url' => '', 'msg' => '账号或密码错误']);
        }

        if(1 != $hasUser['status']){
            writelog($hasUser['id'],$username,'用户【'.$username.'】登录失败：该账号被禁用',2);
            return json(['code' => -6, 'url' => '', 'msg' => '该账号被禁用']);
        }

        //获取该会员角色信息
        if($hasUser['group_id']!==4){
            writelog($hasUser['id'],$username,'用户【'.$username.'】登录失败：用户不是会员',2);
            return json(['code' => -7, 'url' => '', 'msg' => '用户不是会员']);
        };

        session('uid', $hasUser['id']);         //用户ID
        session('username', $hasUser['nickname']);  //用户名
        session('portrait', $hasUser['head_img']); //用户头像
        //更新管理员状态
        $token = md5($hasUser['nickname'] . $hasUser['password'] . $hasUser['id']);
        $param = [
            'login_num' => $hasUser['login_num'] + 1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time(),
            'token' => $token
        ];
        Db::name('member')->where('id', $hasUser['id'])->update($param);
        writelog($hasUser['id'],session('username'),'用户【'.session('username').'】登录成功',1);
        return json(['code' => 1, 'url' => url('index/index'), 'msg' => '登录成功！','token'=>$token,'name'=>$hasUser['nickname']]);
    }

    public function registerpost() {
        $param = input('post.');
        $group = new MemberModel();
        $flag = $group->insert($param);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }

    /**
     * 验证码
     * @return
     */
    public function checkVerify()
    {
        $verify = new Verify();
        $verify->imageH = 32;
        $verify->imageW = 100;
        $verify->codeSet = '0123456789';
        $verify->length = 4;
        $verify->useNoise = false;
        $verify->fontSize = 14;
        return $verify->entry();
    }


    /**
     * 退出登录
     * @return
     */
    public function loginOut()
    {
        session(null);
        cache('db_config_data',null);//清除缓存中网站配置信息
        $this->redirect('login/login');
    }

    /**
     * 退出登录
     * @return
     */
    public function register()
    {
        $s_nid = input('get.s_nid');
        if(empty($s_nid)){
            $this->error('代理商不能为空');
        }
        $g = Db::name('member')->where('id',$s_nid)->find();
        if(empty($g)){
            $this->error('代理商不存在');
        }
        if($g['group_id'] !==3){
            $this->error('代理商身份错误');
        }
        $this->assign('s_nid',$s_nid);
        return $this->fetch('index/register');
    }
    /**
     * 忘记密码
     * @return
     */
    public function forget_password()
    {
        return $this->fetch('index/forget_password');
    }

}
