
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
				

				</div>
				<div class="hr"></div>
				<!--支付和送货-->
				<div class="payshipInfo">
					<div class="step-tit">
						<h5>支付方式</h5>
					</div>
					<div class="step-cont">
						<ul class="payType">
							<li class="selected">支付宝付款<span title="点击取消选择"></span></li>
							<li>货到付款<span title="点击取消选择"></span></li>
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
            <a class="sui-btn btn-danger btn-xlarge" href="{{url('pay')}}">提交订单</a>
        </div>
        </form>
        <!--添加地址-->
        <div  tabindex="-1" role="dialog" data-hasfoot="false" class="sui-modal hide fade edit">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" data-dismiss="modal" aria-hidden="true" class="sui-close hideclass">×</button>
                                      <h4 id="myModalLabel" class="modal-title">添加收货地址</h4>
                                    </div>
                                    <div class="modal-body">
                                    <form action="" method="post" class="sui-form form-horizontal">
                                        @csrf
                                             <div class="control-group">
                                              <label class="control-label">收货人：</label>
                                              <div class="controls">
                                                <input type="text" name="consignee" class="input-medium">
                                              </div>
                                            </div>

                                            
                                             <div class="control-group">
                                              <label class="control-label">联系电话：</label>
                                              <div class="controls">
                                                <input type="text" name="tel" class="input-medium">
                                              </div>
                                            </div>
                                             <div class="control-group">
                                              <label class="control-label">邮箱：</label>
                                              <div class="controls">
                                                <input type="text" name="email" class="input-medium">
                                              </div>
                                            </div>
                                             <div class="control-group">
                                              <label class="control-label">地址别名：</label>
                                              <div class="controls">
                                                <input type="text" name="address_name" class="input-medium">
                                              </div>
                                              <div class="othername">
                                                  建议填写常用地址：<a href="#" class="sui-btn btn-default">家里</a>　<a href="#" class="sui-btn btn-default">父母家</a>　<a href="#" class="sui-btn btn-default">公司</a>
                                              </div>
                                            </div>
                                            </form>



                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" data-ok="modal" class="sui-btn btn-primary btn-large useradressadd">确定</button>
                                      <button type="button" data-dismiss="modal" class="sui-btn btn-default btn-large hideclass">取消</button>
                                    </div>
                                  </div>
                                </div>

                              </div>

                               <!--确认地址-->
          </div>
    <div class="sui-modal-backdrop fade in" style="background:#000;;display: none;"></div>

    <script type="text/javascript" src="/static/js/plugins/jquery/jquery.min.js"></script>
    <script>
        //判断当前用户是否有收货地址  没有弹出收货地址框
	@if(!count($address))
	$(function(){
		$('.sui-modal').addClass('in');
		$('.sui-modal-backdrop').show();
		$('.sui-modal').css('margin-top','-186px');
		$('.sui-modal').show();
	})
	@endif
    //四级联动
	
		var obj = $(this);
		// alert(region_id);
		$.get('/getsonaddress',{region_id:region_id},function(res){
			if(res.code=='0'){
				var address =res.data;
				var str='<option value="0">请选择==</option>';
				for(var i=0;i<address.length;i++){
					str += '<option value="'+address[i].region_id+'">'+address[i].region_name+'</option>';
				}
				// alert(str);
				obj.next().html(str);
			}
		},'json')
	})
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
    </script>

    @endsection