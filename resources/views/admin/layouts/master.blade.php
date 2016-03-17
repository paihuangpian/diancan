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
        <a href="" class="brand">格木订餐系统后台</a>
        <a href="{{ route('am') }}" @if(Route::currentRouteName() == 'am') class="active" @endif>中午</a>
        <a href="">晚上</a>
        <a href="">所有订单</a>
        <a href="{{ route('menus') }}" @if(Route::currentRouteName() == 'menus') class="active" @endif>菜单设置</a>
        <a href="">人员管理</a>
    </div>
    <div class="action">
        @yield('action')
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>