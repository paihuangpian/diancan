<!DOCTYPE html>
<html>
<head>
    <title>点餐系统后台</title>
    <link href="http://cdn.bootcss.com/normalize/3.0.3/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script type="text/javascript" src="{{ asset('js/My97DatePicker/WdatePicker.js') }}"></script>
</head>
<body>
    <div class="nav">
        <a class="brand">格木订餐系统后台</a>
        <a href="{{ route('am') }}" @if(Route::currentRouteName() == 'am') class="active" @endif>中午</a>
        <a href="{{ route('pm') }}" @if(Route::currentRouteName() == 'pm') class="active" @endif>晚上</a>
        <!-- <a href="">所有订单</a> -->
        <a href="{{ route('menus') }}" @if(Route::currentRouteName() == 'menus') class="active" @endif>菜单</a>
        <a href="{{ route('users') }}" @if(Route::currentRouteName() == 'users') class="active" @endif>用户</a>
        <a href="{{ route('settlement') }}" @if(Route::currentRouteName() == 'settlement') class="active" @endif>结算</a>
    </div>
    @if (count($errors) > 0 )
        <div class="errors">消息：
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="action">
        @yield('action')
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>