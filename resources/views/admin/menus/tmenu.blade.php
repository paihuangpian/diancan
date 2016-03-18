@extends('admin.layouts.master')

@section('action')
<a href="{{ route('tmenu') }}" class="active">当前菜单</a> /
<a href="{{ route('menus') }}">所有菜单</a> /
<a href="{{ route('addMenu') }}">添加菜单</a>
@endsection('action')

@section('content')
<p><b>当前：</b>
@if($tmenus)
	@foreach($tmenus as $tmenu)
		<span style="padding: 3px 5px;background-color: #f9a;color:#fff;border: solid 1px #f67">{{ $tmenu->name }}
		<a href="{{ route('delTmenu', ['id' => $tmenu->id]) }}" style="color:#fff;border-left:solid 1px #f6a;padding-left: 5px">×</a></span>
	@endforeach
@else
	你今天还没有添加任何菜单哦，亲~
@endif
</p>
<p><b>所有(勾选存在的菜单到当前菜单，并点击更新)：</b>

<?php
	$tmenuNames = [];
	foreach($tmenus as $tmenu){
		$tmenuNames[] = $tmenu->name;
	} 
	// dump($tmenuNames);
?>
<form action="{{ route('tmenu') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	@foreach($menus as $menu)
		<input type="checkbox" name="menus[]" value="{{ $menu->name }}" @if(in_array($menu->name, $tmenuNames)) checked="checked" @endif> {{ $menu->name }}
	@endforeach
	<button>更新</button>
</form>
</p>
@endsection