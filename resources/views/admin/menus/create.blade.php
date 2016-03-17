@extends('admin.layouts.master')

@section('content')

<?php if(isset($errors)){echo '菜名必须填写哦，亲~';}?>

<form action="{{ route('postMenu') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<p><input type="text" placeholder="菜名" name="name"></input></p>
	<p><textarea placeholder="备注" cols=50 rows=5 name="remark"></textarea></p>
	<p><button type="submit">添加</button></p>
</form>

@endsection('content')