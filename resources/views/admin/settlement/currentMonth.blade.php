@extends('admin.layouts.master')

@section('action')
	<a href="{{ route('lastMonth') }}" @if(Route::currentRouteName() == 'lastMonth') class="active" @endif>上月</a>
	<a href="{{ route('currentMonth') }}" @if(Route::currentRouteName() == 'currentMonth') class="active" @endif>本月</a>
	[ <a href="{{ route('exportCurrent') }}">导出到Excel</a> ]
@endsection

@section('content')
	<table>
		<tr><th>用户</th><th>小计(总：{{ $currentTotal[0]->total }})</th></tr>
		@foreach($currentMonths as $currentMonth)
			<tr>
				<td>
					{{ $currentMonth->name }}
				</td>
				<td>
					{{ $currentMonth->total }}
				</td>
			</tr>
		@endforeach
	</table>
@endsection
