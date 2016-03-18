@extends('admin.layouts.master')

@section('action')
<a href="{{ route('tmenu') }}">今日菜单</a> /
<a href="{{ route('menus') }}">所有菜单</a> /
<a href="{{ route('addMenu') }}" class="active">添加菜单</a>
@endsection('action')

@section('content')

<form action="{{ route('postMenu') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<p><input type="text" placeholder="菜名" name="name" value="{{ old('name') }}"></input></p>
	<p><textarea placeholder="备注" cols=50 rows=5 name="remark">{{ old('remark') }}</textarea></p>
	<p><button type="submit">添加</button></p>
</form>

@endsection('content')