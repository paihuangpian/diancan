<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index(){
    	$tmenus = \DB::table('tmenus')->where('created_at', date('Y-m-d'))->get();
        if(!$tmenus){
            $tmenus = \DB::table('tmenus')->where('created_at', date('Y-m-d', (strtotime(date('Y-m-d')) - 24*3600)))->get();
        }
    	return view('home.index', ['tmenus' => $tmenus]);
    }

    public function homeOrder(Request $request){

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
			    ['name' => $request->input('name'), 'menus' => implode(',', $request->input('menus')), 'type' => $request->input('type'), 'created_at' => date('Y-m-d')]
		);

    	if($result){
    		return redirect()->back()->withErrors(['errors' => '骚年，已收到您的订单，感谢您的支持~'])->withInput();
    	}
    }
}
