@extends('admin.layouts.master')

@section('action')
	<a href="{{ route('lastMonth') }}">上月</a>
	<a href="{{ route('currentMonth') }}" @if(Route::currentRouteName() == 'currentMonth') class="active" @endif>本月</a>
@endsection


