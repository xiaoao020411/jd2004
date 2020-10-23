
@extends('layouts.cartadd')
@section('title','结算页')
@section('cartadd')

        <!--主内容-->
        <form action="{{url('/order')}}" method="post" class="sui-form form-horizontal">
        @csrf
		<div class="checkout py-container">
			<div class="checkout-tit">
				<h4 class="tit-txt">填写并核对订单信息</h4>
			</div>
			<div class="checkout-steps">
				<!--收件人信息-->
				
				<div class="step-cont">
					<div class="addressInfo">
                        <input type="hidden" name="address_id" value="">
						<input type="hidden" name="pay_type" value="">
						<input type="hidden" name="rec_id" value="{{request()->cart_id}}">
						<ul class="addr-detail">
							<li class="addr-item">

                                @if($address)
                                @foreach($address as $v)
                                <div>
                                  <div address_id="{{$v['address_id']}}" class="con name choiceuser @if($v['is_default']==1) selected @endif"><a href="javascript:;" >{{$v['consignee']}}<span title="点击取消选择">&nbsp;</a></div>
                                  <div class="con address">{{$v['consignee']}} {{$v['address']}} {{$v['address_name']}} <span>{{substr_replace($v['tel'],'****',3,4)}}</span>
                                      @if($v['is_default']==1)
                                      <span class="base">默认地址</span>
                                      @endif
                                      <span class="edittext"><a data-toggle="modal" data-target=".edit" data-keyboard="false" >编辑</a>&nbsp;&nbsp;<a href="javascript:;">删除</a></span>
                                  </div>
                                  <div class="clearfix"></div>
                                </div>
                               @endforeach
                              @endif


							</li>


						</ul>

					<div class="hr"></div>

				</div>
				<div class="hr"></div>
				<!--支付和送货-->
				<div class="payshipInfo">
					<div class="step-tit">
						<h5>支付方式</h5>
					</div>
					<div class="step-cont">
						<ul class="payType">
							<li pay_type=1 class="selected">微信付款<span title="点击取消选择"></span></li>
                                <li pay_type=2 >支付宝<span title="点击取消选择"></span></li>
                                <li pay_type=3 >货到付款<span title="点击取消选择"></span></li>
						</ul>
					</div>
					<div class="hr"></div>
					<div class="step-tit">
						<h5>送货清单</h5>
					</div>
					<div class="step-cont">
						<ul class="send-detail">
                            @foreach ($goods as $v)
							<li>

								<div class="sendGoods">
                                        <ul class="yui3-g">
                                            <li class="yui3-u-1-6">
                                                <span><img src="/upload/{{$v->goods_img}}"/ width="100px" height="100px"></span>
                                            </li>
                                            <li class="yui3-u-7-12">
                                                <div class="desc">{{$v->goods_name}}</div>
                                                <div class="seven"></div>
                                            </li>
                                            <li class="yui3-u-1-12">
                                                <div class="price">￥{{$v->goods_num * $v->shop_price}}.00</div>
                                            </li>
                                            <li class="yui3-u-1-12">
                                                <div class="num">X{{$v->goods_num}}</div>
                                            </li>
                                            <li class="yui3-u-1-12">
                                                <div class="exit"></div>
                                            </li>
                                        </ul>
                                    </div>

                            </li>
                            @endforeach
							<li></li>
							<li></li>
						</ul>
					</div>
					<div class="hr"></div>
				</div>
				<div class="linkInfo">
					<div class="step-tit">
						<h5>发票信息</h5>
					</div>
					<div class="step-cont">
						<span>普通发票（电子）</span>
						<span>个人</span>
						<span>明细</span>
					</div>
				</div>
				<div class="cardInfo">
					<div class="step-tit">
						<h5>使用优惠/抵用</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="order-summary">
			<div class="static fr">
				<div class="list">
					<span><i class="number">1</i>件商品，总商品金额</span>
					<em class="allprice">¥5399.00</em>
				</div>
				<div class="list">
					<span>返现：</span>
					<em class="money">0.00</em>
				</div>
				<div class="list">
					<span>运费：</span>
					<em class="transport">0.00</em>
				</div>
			</div>
		</div>
		<div class="clearfix trade">
			<div class="fc-price">应付金额:　<span class="price">¥5399.00</span></div>
			<div class="fc-receiverInfo">寄送至:北京市海淀区三环内 中关村软件园9号楼 收货人：某某某 159****3201</div>
		</div>
		<div class="submit">
            <button class="sui-btn btn-danger btn-xlarge" type="submit">提交订单</button>
        </div>
        </form>
		<!--添加地址-->
		<!--确认地址-->
	</div>
        <div class="sui-modal-backdrop fade in" style="background:#000;;display: none;"></div>

    <script type="text/javascript" src="/static/jquery.min.js"></script>
    <script>
        //判断当前用户是否有收货地址  没有弹出收货地址框
	
    //四级联动
	
    //点击×或取消弹出框消失
	$('.hideclass').click(function(){
		$('.sui-modal').removeClass('in');
		$('.sui-modal-backdrop').hide();
		$('.sui-modal').removecss('margin-top','-186px');
		$('.sui-modal').hide();
	})
    //用户添加
	$(document).on('click','.useradressadd',function(){
		var consignee = $('input[name="consignee"]').val();
		var address_name = $('input[name="address"]').val();
		// alert(address_name);
        // return;
		var country = $('select[name="country"]').val();
		// alert(country);
		var province = $('select[name="province"]').val();
		// alert(province);
		var city = $('select[name="city"]').val();
		// alert(city);
		var district = $('select[name="district"]').val();
		// alert(district);
		var address = $('input[name="address"]').val();
		var tel = $('input[name="tel"]').val();
		var email = $('input[name="email"]').val();
		var address_name = $('input[name="address_name"]').val();
		$.get('/useraddressadd',{consignee:consignee,address_name:address_name,country:country,province:province,city:city,district:district,address:address,tel:tel,email:email,address_name:address_name},function(res){
                alert(res);
				$('li[class="addr-item"]').html(res);
		})
	})
    //页面加载事件
	$(function(){
		var address_id = $('.selected').attr('address_id');
		var pay_type = $('.payType .selected').attr('pay_type');
		$('input[name="address_id"]').val(address_id);
		$('input[name="pay_type"]').val(pay_type);
		//选择收货地址
		$('.choiceuser').click(function(){
            //alert(111);
			var address_id = $(this).attr('address_id');
			//alert(address_id);
			$('input[name="address_id"]').val(address_id);
			$(this).parents('div').siblings().find('div').removeClass("selected");
			$(this).addClass("selected");
		})
		//选择支付方式
		$('.payType li').click(function(){
			var pay_type = $(this).attr('pay_type');
            $(this).siblings('li').removeClass('selected');
            $(this).addClass("selected");
			// alert(pay_type);
			$('input[name="pay_type"]').val(pay_type);
		})
	})
    </script>

    @endsection