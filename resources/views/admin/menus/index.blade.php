@extends('admin.layouts.master')

@section('action')
<a href="{{ route('addMenu') }}">添加菜单</a>
@endsection('action')

@section('content')
	<table>
		<tr><th>菜名</th><th>备注</th><th>操作</th></tr>
		<tr>
			
		</tr>
	</table>
@endsection