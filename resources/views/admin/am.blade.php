@extends('admin.layouts.master')

@if(isset($amOrders))

	@section('action')
	<form>
		按姓名：<input type="text" placeholder="输入姓名"> <button type="submit">查询</button>
	</form>
	<a href="{{ route('export', ['type' => 0]) }}">导出到Excel</a>
	或者
	<a href="{{ route('addOrder', ['type' => 0]) }}">新增一个</a>
	@endsection('action')

	@section('content')
	共 {{ count($amOrders) }} 条订单
		<table>
			<tr><th>序号</th><th>姓名</th><th>菜单</th><th>操作</th></tr>
			
			@foreach($amOrders as $key => $amOrder)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $amOrder->name }}</td>
				<td>{{ $amOrder->menus }}</td>
				<td><a href="{{ route('delOrder', ['id' => $amOrder->id]) }}">删除</a></td>
			</tr>
			@endforeach

		</table>
	@endsection

@else

	@section('content')
		<h1 style="font-family: Microsoft Yahei;font-weight: normal;">:( </h1>
		暂时没有人订餐哦~ (●'◡'●)
		<a href="javascript: window.location.reload();">点这里刷新</a>
		或者
		<a href="{{ route('addOrder', ['type' => 0]) }}">新增一个</a>
	@endsection

@endif