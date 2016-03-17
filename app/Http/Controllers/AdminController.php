<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index(){
 
    	return view('admin.index');
    }

    public function getMenus(){
    	$menus = \DB::table('menus')->get();
    	return view('admin.menus.index')->withMenus($menus);
    }

    public function addMenu(){
    	return view('admin.menus.create')->withMenus(\DB::table('menus'));
    }

    public function postMenu(Request $request){
    	\DB::table('menus')->insert(
		    ['name' => $request->input('name'), 'remark' => $request->input('remark')]
		);
		return redirect()->back();
    }
}
