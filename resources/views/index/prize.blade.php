
@extends('layouts.show')
@section('title','首页')
@section('show')
<table>
<div>
    <div>
    <a href="">
        <img src="/static/img/banner1.jpg"  />
    </a>
    </div>
</div>
</div>
    <h1>抽奖</h1>
    <button id="btn_prize">点击抽奖</button>
</table>

@endsection
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script>
    $(document).on("click","#btn_prize",function(){
        $.ajax({
            url:"/prize/add",
            type:"get",
            dataType:"json",
            success:function(res){
                if(res.error==400003){
                    alert('未登录')
                    window.location.href="/login";
                }
                if(res.error==4343){
                    alert('今天已抽奖，明天再来')
                    window.location.href="/";
                }
                if(res.error==1717){
                    alert('网关错误')
                }
                if(res.data.level==0){
                    alert('谢谢参与')
                }else if(res.data.level==1){
                    alert('恭喜获得一等奖')
                }else if(res.data.level==2){
                    alert('二等奖')
                }else if(res.data.level==3){
                    alert('三等奖')
                }
            }
        })
    })
</script>
