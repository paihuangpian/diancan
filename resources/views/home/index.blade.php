<!DOCTYPE html>
<html>
<head>
  <title>格木网络欢迎您~</title>
  <script type="text/javascript">
    var now = new Date();
    var hour = now.getHours();
    window.onload = function(){
      if(hour < 12){
        document.getElementById('type').value = 0;
      }else{
        document.getElementById('type').value = 1;
      }
      if(hour < 17 && hour > 9){
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
    <div style="width: 300px;background: #e7e7e7;margin:0 auto;padding:10px 30px;;display: none;" id="start">
    @if (count($errors) > 0 )
        <div class="errors" style="background-color: #fe9;padding: 0 10px;">消息：
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
      <form action="{{ route('homeOrder') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="type" name="type">
        <p><input type="text" name="name" style="border:none;height: 40px;width: 100%" placeholder="姓名" value="{{ old('name') }}"></p>
        <p style="text-align:left">
        @foreach($tmenus as $tmenu)
          <input type="checkbox" name="menus[]" value="{{ $tmenu->name }}"> {{ $tmenu->name }}
        @endforeach
        </p>
        <p>
        <button type="submit" style="border: none;cursor:pointer;padding: 10px 30px;width: 100%;color:#fff;background: #a40" href="">
          立即订餐
        </button>
      </form>
    </div>
  </div>
  


</body>
</html>
