@extends('admin.layouts.master')

@section('action')
	<a href="{{ route('lastMonth') }}" @if(Route::currentRouteName() == 'lastMonth') class="active" @endif>上月</a>
	<a href="{{ route('currentMonth') }}" @if(Route::currentRouteName() == 'currentMonth') class="active" @endif>本月</a>
	[ <a href="{{ route('exportLast') }}">导出到Excel</a> ]
@endsection

@section('content')
	<table>
		<tr><th>用户</th><th>小计(总：{{ $lastTotal[0]->total }})</th></tr>
		@foreach($lastMonths as $lastMonth)
			<tr>
				<td>
					{{ $lastMonth->name }}
				</td>
				<td>
					{{ $lastMonth->total }}
				</td>
			</tr>
		@endforeach
	</table>
@endsection
