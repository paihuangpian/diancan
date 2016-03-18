@extends('admin.layouts.master')

@section('content')

<form action="{{ route('postOrder') }}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="type" value="{{ $type }}">
	<p>姓名：<input type="text" name="name" value="{{ old('name') }}"> </p>
	<p>菜名：
		@foreach($tmenus as $tmenu)
			<input type="checkbox" value="{{ $tmenu->name }}" name="menus[]"> {{ $tmenu->name }}
		@endforeach
	</p>
	<p></p>
	<p><button type="submit">添加</button></p>
</form>

@endsection('content')