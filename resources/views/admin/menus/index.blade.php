@extends('admin.layouts.master')

@section('action')
<a href="{{ route('tmenu') }}">今日菜单</a> /
<a href="{{ route('menus') }}" class="active">所有菜单</a> /
<a href="{{ route('addMenu') }}">添加菜单</a>
@endsection('action')

@section('content')
	<table>
		<tr><th>菜名</th><th>备注</th><th>操作</th></tr>
		@foreach($menus as $menu)
		<tr>
			<td>{{ $menu->name }}</td>
			<td>{{ $menu->remark }}</td>
			<td><a href="{{ route('delMenu', ['id' => $menu->id]) }}">删除</a><td>
		</tr>
		@endforeach
	</table>
@endsection