@extends('admin.layouts.master')

@if(isset($users))

	@section('action')
	<form>
		按姓名：<input type="text" placeholder="输入姓名"> <button type="submit">查询</button>
	</form>
	@endsection('action')

	@section('content')
	共 {{ count($users) }} 个用户
		<table>
			<tr><th>序号</th><th>姓名</th><th>邮箱</th><th>注册时间</th><th>操作</th></tr>
			
			@foreach($users as $key => $user)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->created_at }}</td>
				<td><a href="{{ route('delUser', ['id' => $user->id]) }}">删除</a> / <a href="{{ route('userOrders', ['id' => $user->id]) }}">历史订单</a></td>
			</tr>
			@endforeach

		</table>
	@endsection
@endif