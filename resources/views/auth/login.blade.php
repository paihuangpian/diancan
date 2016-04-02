
<!DOCTYPE html>
<html>
<head>
  <title>格木网络欢迎您~</title>
  <style type="text/css">
  a{
    color: #333;
  }
  </style>
  <script type="text/javascript">
    var now = new Date();
    var hour = now.getHours();
    window.onload = function(){
      if(hour < 12){
        document.getElementById('type').value = 0;
      }else{
        document.getElementById('type').value = 1;
      }
      if(hour < 18 && hour > 9){
        document.getElementById('start').style.display = 'block';
      }else{
        document.getElementById('stop').style.display = 'block';
      }
    }
</script>
</head>
<body style="background: url(images/home.jpg) no-repeat #F4F4F4;background-size: cover;padding-top: 50px">

  <div style="text-align: center;">
    <h1 style="font-weight: normal;font-family: Microsoft yahei;font-size: 40px">:)</h1> 
    <h1 style="font-weight: normal;font-family: Microsoft yahei;font-size: 40px">格木网络欢迎你~</h1>

    <p style="color:#a40">点餐时间：<span style="color:#333">午饭：10:00 - 11:00 / 晚饭：14:00 - 16:00</span></p>
    <div style="width: 300px;margin:0 auto;padding:10px 30px;color:#fff;display: none;" id="stop">
      <b>休息中~ </b>
    </div>
    
   
      <div style="width: 300px;background: #e7e7e7;margin:0 auto;padding:10px 30px;" >
        <form method="POST" action="{{ url('/login') }}">
          {!! csrf_field() !!}

          <p>邮箱：<input type="email" name="email" value="{{ old('email') }}"></p>
          @if ($errors->has('email'))
            <p style="color:#f30;">{{ $errors->first('email') }}</p>
          @endif

          <p>密码：<input type="password" name="password"></p>
          @if ($errors->has('password'))
            <p style="color:#f30;">{{ $errors->first('password') }}</p>
          @endif

          <p><input type="checkbox" name="remember"> 记住</p>
                       
          <p><button type="submit" style="border: none;cursor:pointer;padding: 10px 30px;width: 100%;color:#fff;background: #a40">登录</button></p>

          <a class="btn btn-link" href="{{ url('/password/reset') }}">忘记密码？</a> / 
          <!-- <a href="{{ url('/login') }}">登录</a> -->
          <a href="{{ url('/register') }}">注册</a>
        </form>
      </div>
    
    <!-- app -->
    <!-- <div style="position: absolute;bottom: 0;left:0;right:0;">
        <p><img src="images/app.png"></p>
        <p>手机APP下载 / 目前仅支持Android系统</p>
    </div> -->
  </div>



</body>
</html>




  

