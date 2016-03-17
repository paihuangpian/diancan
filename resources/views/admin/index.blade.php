@extends('admin.layouts.master')

@section('action')
<form>
	按日期：<input type="text" onClick="WdatePicker()" placeholder="选择日期"> <button type="submit">查询</button>
</form>
<form>
	按姓名：<input type="text" placeholder="输入姓名"> <button type="submit">查询</button>
</form>
<a href="">导出到Excel</a>
@endsection('action')

@section('content')
	<table>
		<tr><th>序号</th><th>订单号</th><th>姓名</th><th>菜单</th><th>备注</th><th>操作</th></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
		<tr><td>1</td><td>20160318102040</td><td>佘行</td><td>秋刀鱼 / 炸鸡 <a href="">更改</a></td><td></td><td><a href="">删除</a></td></tr>
	</table>
@endsection