<?php
/**
 * 我的信息
 */
namespace app\index\controller;

use app\common\controller\Frontend;
use think\Config;
use think\Cookie;
use think\Hook;
use think\Session;
use think\Validate;


class My extends Frontend
{
    /**
     * 首页
     */
    protected $layout = 'default';
    protected $noNeedLogin = ['login', 'register', 'third'];
    protected $noNeedRight = ['*'];
    
    public function doc()
    {
        
        return $this->fetch();
    }

    public function map()
    {
        
        return $this->fetch();
    }
}