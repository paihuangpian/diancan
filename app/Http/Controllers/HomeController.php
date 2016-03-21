<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index(){
    	$tmenus = \DB::table('tmenus')->get();
    	return view('home.index', ['tmenus' => $tmenus]);
    }

    public function homeOrder(Request $request){

        // 重复下单的后果
        $repeat = \DB::select('select * from orders where ip = "' . $_SERVER['REMOTE_ADDR'] . '" and created_at = "' . date('Y-m-d') .  '" and type = ' . $request->input('type'));
       
        if($repeat){
            $type = $request->input('type') ? '晚饭' : '午饭';
            return redirect()->back()->withErrors(['errors' => '施主，你' . $type . '确实已经点了一份，不信，你去问前台妹子，如果非要吃多份，可以主动联系她她她哟~'])->withInput();
        }

    	$info = [
            'name.required' => '还没有填写姓名呢~',
            'menus.required' => '还没有填写菜单呢~',
        ];

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'menus' => 'required',
        ], $info);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(count($request->input('menus')) > 2){
            return redirect()->back()->withErrors(['errors' => '最多选择两个菜品'])->withInput();
        }

    	$result = \DB::table('orders')->insert(
			    ['name' => $request->input('name'), 'menus' => implode(',', $request->input('menus')), 'type' => $request->input('type'), 'created_at' => date('Y-m-d'), 'ip' => $_SERVER['REMOTE_ADDR']]
		);

    	if($result){
    		return redirect()->back()->withErrors(['errors' => '骚年，已收到您的订单，感谢您的支持~'])->withInput();
    	}
    }

    public function homeOrderApi(Request $request){
        return response()->json(['status' => 0, 'errors' => '最多选择两个菜品']);
        // 重复下单的后果
        $repeat = \DB::select('select * from orders where ip = "' . $_SERVER['REMOTE_ADDR'] . '" and created_at = "' . date('Y-m-d') .  '" and type = ' . $request->input('type'));
       
        if($repeat){
            $type = $request->input('type') ? '晚饭' : '午饭';
            return response()->json(['status' => 0, 'errors' => '施主，你' . $type . '确实已经点了一份，不信，你去问前台妹子，如果非要吃多份，可以主动联系她她她哟~']);
        }

        /*$info = [
            'name.required' => '还没有填写姓名呢~',
            'menus.required' => '还没有填写菜单呢~',
        ];

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'menus' => 'required',
        ], $info);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'errors' => '请填写名字或者菜单']);
        }*/

        if(count($request->input('menus')) > 2){
            return response()->json(['status' => 0, 'errors' => '最多选择两个菜品']);
        }

        $result = \DB::table('orders')->insert(
                ['name' => $request->input('name'), 'menus' => implode(',', $request->input('menus')), 'type' => $request->input('type'), 'created_at' => date('Y-m-d'), 'ip' => $_SERVER['REMOTE_ADDR']]
        );

        if($result){
            return response()->json(['status' => 1, 'errors' => '已收到客观的订单~']);
        }
    }
}
