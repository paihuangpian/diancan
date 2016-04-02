@extends('admin.layouts.master')

@if(isset($userOrders))

	@section('action')
	<form>
		按日期：起始<input type="text"  onClick="WdatePicker()">
		结束<input type="text"  onClick="WdatePicker()">
		<button type="submit">查询</button>
	</form>
	@endsection('action')

	@section('content')
	{{ $userName }} 共 {{ count($userOrders) }} 个订单
		<table>
			<tr><th>序号</th><th>菜单</th><th>时间</th><th>操作</th></tr>
			
			@foreach($userOrders as $key => $userOrder)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $userOrder->menus }}</td>
				<td>{{ $userOrder->created_at }} {{ $userOrder->type ? '下午' : '上午' }}</td>
				<td></td>
			</tr>
			@endforeach

		</table>
	@endsection
@endif