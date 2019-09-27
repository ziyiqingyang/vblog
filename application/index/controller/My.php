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
use think\Db;
use \think\Request;

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
       
        //获取省份列表和旅行计划
        $thisuserid = $this->auth->id;
        $provincelist = DB::table('v_provinces a')
        ->field(["a.brief",
            "a.color",
            "a.id",
            "a.name ",
            "case when b.t_switch is null  then 0 else b.t_switch end as t_switch",
            "case when b.travels_date is null  then '' else b.travels_date end as travels_date",
            "case when b.plan_date is null  then '' else b.plan_date end as plan_date"
            
        ])
        ->join('user_travels b',"a.id = b.pro_id and b.user_id = '$thisuserid' ",'LEFT')
        ->select();
        $this->assign('provincelist', json_encode($provincelist));
//         echo json_encode($provincelist);die;
        return $this->fetch();
    }
    
    public function doaddplan()
    {
        if(request()->isAjax()){
            // $this->user_id = 110543;
            $data = $this->request->param();
//             echo  json_encode($data);die;
            $proid = $data['proid'];
            $plan_date = $data['plan_date'];
            $thisuserid = $this->auth->id;
            $datacreate = array("user_id"=>$thisuserid,
                "pro_id"=>$proid,
                "plan_date"=>$plan_date,
                "t_switch"=>0
                
            );
            //var_dump($activecreate);
            //exit;
            \app\admin\model\Usertravels::create($datacreate);
     
            return (['status' => 1, 'result' => $data]);
        }
    }
    
}