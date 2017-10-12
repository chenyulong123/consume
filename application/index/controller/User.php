<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class User extends Controller
{
    /**
     * 渲染主页模板
     */
    public function index()
    {
        return view('/index', ['title'=>'消费单']);
    }
    
    /**
     * @return json
     */
    public function product_info()
    {
       $result = db('consume')->select();
       foreach ($result as $key=>$value) {
           $result[$key]['created_time'] = date('Y-m-d', $result[$key]['created_time']);
       }
       $result = json($result);
       return $result;
    }
    
    /**
     * @return 创建消费单
     */
    public function created_ticket()
    {
        $request = Request::instance()->post();
        $time = strtotime($request['time']);
        $date = date('Ym', time());
        $data = ['product'=>$request['product'], 'price'=>$request['price'], 'created_time'=>$time, 'month' => $date];
        $result = Db::table('consume')->insert($data);
        return json($result);
    }
    
    /**
     * @param $id int 消费单ID
     * @return void
     */
    public function delete_ticket($id)
    {
        
        $result = Db::table('consume')->where('id',$id)->delete();
        if ($result) {
            $this->success('删除成功', '/');
        } else {
            $this->error('删除失败', '/');
        }
    }
    
    /**
     * @return 加载今日消费模板
     */
    public function today_consume()
    {
        return view('/today-consume', ['title' => '今日消费']);
    }
    
    /**
     * @return json 消费金额
     */
    public function count_today_consume()
    {
        $count_consume = 0;
        $date = date('Ymd', time());
        $today = strtotime($date);
        $result = Db::table('consume')->where('created_time', $today)->select();
        foreach($result as $value) {
            $count_consume += $value['price'];
        }
        return json($count_consume);
    }
    
    /**
     * @return 加载月消费模板
     */
    public function month_consume()
    {
        return view('/month-consume', ['title' => '月消费']);
    }
    
    /**
     * @return json 月消费金额
     */
    public function count_month_consume()
    {
        $request = Request::instance()->get();
        $month_consume = 0;
        if (!empty($request)) {
            $time = $request['month'];
            $result = Db::table('consume')->where('month', $time)->select();
            if(!empty($result)) {
                foreach($result as $value) {
                    $month_consume += $value['price'];
                }
                return json($month_consume);
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }
    
}
