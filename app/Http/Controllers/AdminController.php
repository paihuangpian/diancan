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

    	$info = [
    		'name.required' => '菜名一定要填写~',
    		'name.unique' => '菜名重复了~'
    	];

	    $validator = \Validator::make($request->all(), [
        	'name' => 'required|unique:menus'
	    ], $info);

	    if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    	\DB::table('menus')->insert(
		    ['name' => $request->input('name'), 'remark' => $request->input('remark')]
		);

		return redirect()->route('menus');
    }

    public function delMenu(Request $request){
    	\DB::table('menus')->delete($request->input('id'));
    	return redirect()->back();
    }

    // 今日菜单
    public function tmenu(){

    	$menus = \DB::table('menus')->get();
    	$tmenus = \DB::table('tmenus')->get();
        
    	return view('admin.menus.tmenu', ['tmenus' => $tmenus, 'menus' => \DB::table('menus')->get()]);
    }

    public function postTmenu(Request $request){

    	$info = [
    		'menus.required' => '还没有选择菜名呢~',
    		'menus.unique' => '菜名可能重复了呢~',
    	];

	    $validator = \Validator::make($request->all(), [
        	'menus' => 'required|unique:tmenus,name'
	    ], $info);

	    if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \DB::table('tmenus')->delete();

    	foreach($request->input('menus') as $menu){
	    	\DB::table('tmenus')->insert(
			    ['name' => $menu, 'created_at' => date('Y-m-d')]
			);
    	}
    	return redirect()->back();
    }

    public function delTmenu(Request $request){
    	\DB::table('tmenus')->delete($request->input('id'));
    	return redirect()->back();
    }

    public function postOrder(Request $request){

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
        
    	\DB::table('orders')->insert(
			    ['name' => $request->input('name'), 'menus' => implode(',', $request->input('menus')), 'type' => $request->input('type'), 'created_at' => date('Y-m-d')]
		);

        $router = $request->input('type') ? 'pm' : 'am';

        return redirect()->route($router);
    }

    public function delOrder(Request $request){
        \DB::table('orders')->delete($request->input('id'));
        return redirect()->back();
    }

    // Excel 导出 composer require maatwebsite/excel ~2.0.0
    public function export(Request $request){

        $type = $request->input('type');
        $extra = $type ? '下午' : '上午';

        $datas = \DB::select('select id, name, menus from orders where type = ? and created_at = ?', [$type, date('Y-m-d')]);
        
        foreach($datas as $key => $data){
           $queue[$key][0] = $key+1;
           $queue[$key][1] = $data->name;
           $queue[$key][2] = $data->menus;
        }
        
        array_unshift($queue, ['序号','姓名','菜单']);
        
        $sheet = \Excel::create(iconv('UTF-8', 'GBK', '今日' . $extra . '订单(' . date('Y-m-d') . ')'),function($excel) use ($queue){
          $excel->sheet('score', function($sheet) use ($queue){
            $sheet->rows($queue);
            $sheet->setWidth(array(
                'A'     =>  30,
                'B'     =>  30, 
                'C'     =>  30
            ));
            $sheet->cells('A1:A100', function($cells) {
                $cells->setAlignment('center');
            });
             $sheet->cells('C1:C100', function($cells) {
                $cells->setAlignment('center');
            });
            $sheet->cells('B1:B100', function($cells) {
                $cells->setAlignment('center');
            });

            $sheet->cell('A1', function($cell) {
                $cell->setFontWeight('bold');
            });
            $sheet->cell('B1', function($cell) {
                $cell->setFontWeight('bold');
            });
            $sheet->cell('C1', function($cell) {
                $cell->setFontWeight('bold');
            });

          });
        })->export('xls');
    }

    // 用户管理
    public function users(){
        $users = \DB::table('users')->get();
        return view('admin.users.index', ['users' => $users]);
    }

    public function delUser(Request $request){
        \DB::table('users')->delete($request->input('id'));
        return redirect()->back();
    }

    public function userOrders(Request $request){
        $userName = \DB::table('users')->find($request->input('id'))->name;
        $userOrders = \DB::table('orders')->where('user_id', $request->input('id'))->get();
        return view('admin.users.orders', ['userOrders' => $userOrders, 'userName' => $userName]);
    }

    // 结算
    public function overview(){
        return view('admin.settlement.overview');
    }

    public function lastMonth(){
        $lastMonths = \DB::select("select *, count(*) as total from orders where date_format(created_at,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m') and user_id <> 0 group by user_id");
        $lastTotal = \DB::select("select count(*) as total from orders where date_format(created_at,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m') and user_id <> 0");

        return view('admin.settlement.lastMonth', ['lastMonths' => $lastMonths, 'lastTotal' => $lastTotal]);
    }

    public function currentMonth(){
        $currentMonths = \DB::select("select *, count(*) as total from orders where date_format(created_at,'%Y-%m')=date_format(now(),'%Y-%m') and user_id <> 0 group by user_id");
        $currentTotal = \DB::select("select count(*) as total from orders where date_format(created_at,'%Y-%m')=date_format(now(),'%Y-%m') and user_id <> 0");

        return view('admin.settlement.currentMonth', ['currentMonths' => $currentMonths, 'currentTotal' => $currentTotal]);
    }

    public function exportLast(Request $request){

        $datas = $currentMonths = \DB::select("select *, count(*) as total from orders where date_format(created_at,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m') and user_id <> 0 group by user_id");

        foreach($datas as $key => $data){
           $queue[$key][0] = $key+1;
           $queue[$key][1] = $data->name;
           $queue[$key][2] = $data->total;
        }
        
        array_unshift($queue, ['序号','姓名','小计']);
        
        $sheet = \Excel::create(iconv('UTF-8', 'GBK', '上月结算结果'),function($excel) use ($queue){
          $excel->sheet('score', function($sheet) use ($queue){
            $sheet->rows($queue);
            $sheet->setWidth(array(
                'A'     =>  30,
                'B'     =>  30, 
                'C'     =>  30
            ));
            $sheet->cells('A1:A100', function($cells) {
                $cells->setAlignment('center');
            });
             $sheet->cells('C1:C100', function($cells) {
                $cells->setAlignment('center');
            });
            $sheet->cells('B1:B100', function($cells) {
                $cells->setAlignment('center');
            });

            $sheet->cell('A1', function($cell) {
                $cell->setFontWeight('bold');
            });
            $sheet->cell('B1', function($cell) {
                $cell->setFontWeight('bold');
            });
            $sheet->cell('C1', function($cell) {
                $cell->setFontWeight('bold');
            });

          });
        })->export('xls');
    }

    public function exportCurrent(Request $request){

        $datas = $currentMonths = \DB::select("select *, count(*) as total from orders where date_format(created_at,'%Y-%m')=date_format(now(),'%Y-%m') and user_id <> 0 group by user_id");

        if(! $datas){
            return redirect()->back();
        }

        foreach($datas as $key => $data){
           $queue[$key][0] = $key+1;
           $queue[$key][1] = $data->name;
           $queue[$key][2] = $data->total;
        }
        
        array_unshift($queue, ['序号','姓名','小计']);
        
        $sheet = \Excel::create(iconv('UTF-8', 'GBK', '本月月结算结果'),function($excel) use ($queue){
          $excel->sheet('score', function($sheet) use ($queue){
            $sheet->rows($queue);
            $sheet->setWidth(array(
                'A'     =>  30,
                'B'     =>  30, 
                'C'     =>  30
            ));
            $sheet->cells('A1:A100', function($cells) {
                $cells->setAlignment('center');
            });
             $sheet->cells('C1:C100', function($cells) {
                $cells->setAlignment('center');
            });
            $sheet->cells('B1:B100', function($cells) {
                $cells->setAlignment('center');
            });

            $sheet->cell('A1', function($cell) {
                $cell->setFontWeight('bold');
            });
            $sheet->cell('B1', function($cell) {
                $cell->setFontWeight('bold');
            });
            $sheet->cell('C1', function($cell) {
                $cell->setFontWeight('bold');
            });

          });
        })->export('xls');
    }
}
