@extends('admin.layouts.master')

@if(!$amOrders)

	@section('action')
	<form>
		按姓名：<input type="text" placeholder="输入姓名"> <button type="submit">查询</button>
	</form>
	<a href="">导出到Excel</a>
	@endsection('action')

	@section('content')
			<table>
				<tr><th>序号</th><th>姓名</th><th>菜单</th><th>备注</th><th>操作</th></tr>
				
				@foreach($amOrders as $key => $amOrder)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $amOrder->name }}</td>
					<td>秋刀鱼 / 炸鸡 <a href="">更改</a></td>
					<td></td>
					<td><a href="">删除</a></td>
				</tr>
				@endforeach

			</table>
	@endsection

@else

	@section('content')
		<h1 style="font-family: Microsoft Yahei;font-weight: normal;">:( </h1>
		
		<a href="javascript: window.location.reload();">暂时没有人订餐哦~ 点这里试一下(●'◡'●)</a>
	@endsection

@endif