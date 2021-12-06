@extends('layouts.CommonLayout')

@section('content')

<section id="checkout">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="checkout-area">
            <form action="{{ route('PlaceOrder')}}" method="post">
            @csrf
                <div class="row">
                <div class="col-md-8">
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::get('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('danger') }}
                        </div>
                    @endif
                    <div class="checkout-left">
                    <div class="panel-group" id="accordion">
                        <!-- Coupon section -->
                        <div class="panel panel-default aa-checkout-coupon">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Have a Coupon?
                            </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                            <input type="text" placeholder="Coupon Code" class="aa-coupon-code">
                            <input type="submit" value="Apply Coupon" class="aa-browse-btn">
                            </div>
                        </div>
                        </div>
                        <!-- Login section -->
                        
                        <!-- Billing Details -->
                        
                        <!-- Shipping Address -->
                        <div class="panel panel-default aa-checkout-billaddress">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                Delivery Address
                            </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapsin">
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                    <input type="hidden" name="userName" value="{{ Session::get('userNames') }}">
                                    <input type="text" placeholder="Name*" id="name" name="name" value="{{ old('name') }}">
                                    <span class="text-danger">@error('Name') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="nameError"></span>
                                </div>                             
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill" id="district">
                                    <select name="district" id="district">
                                        <option value="" selected>Select Your District</option>
                                    </select>
                                    <span class="text-danger">@error('district') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="districtError"></span>
                                </div>                             
                                </div>                            
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="tel" placeholder="Phone*" id="phone" name="phone" value="{{ old('phone') }}">
                                    <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="phoneError"></span>
                                </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                    <textarea cols="8" rows="3" name="address" id="address" placeholder="Address*">{{old('address')}}</textarea>
                                    <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="addressError"></span>
                                </div>                             
                                </div>                            
                            </div>               
                            <div class="row">
                                <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                    <textarea cols="8" rows="3" id="note" name="note" placeholder="Special Notes (Optional)">{{ old('note') }}</textarea>
                                    <span class="text-danger">@error('note') {{ $message }} @enderror</span>
                                    <span class="text-danger" id="noteError"></span>
                                </div>                             
                                </div>                            
                            </div>              
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkout-right">
                    <h4>Order Summary</h4>
                    <div class="aa-order-summary-area">
                        <table class="table table-responsive">
                        <thead>
                            <tr>
                            <th>Product</th>
                            <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                            <td>{{$item->productName}} ({{$item->color}})<strong> x  {{$item->quantity}}</strong></td>
                            <td>{{$item->price * $item->quantity}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Subtotal</th>
                            <td>{{$subtotal}}</td>
                            </tr>
                            <tr>
                            <th>Tax (3%)</th>
                            <td>{{$tax}}</td>
                            </tr>
                            <tr>
                            <th>Total</th>
                            <td>{{$total}}</td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <h4>Payment Method</h4>
                    <div class="aa-payment-method">                    
                        <label for="cashdelivery"><input type="radio" id="cashdelivery" name="paymentMethod" value="Cash"> Cash on Delivery </label>
                        <label for="paypal"><input type="radio" id="paypal" name="paymentMethod" value="PayPal"> Via Paypal </label>
                        <span class="text-danger">@error('paymentMethod') {{ $message }} @enderror</span>
                        <span class="text-danger" id="paymentMethodError"></span>
                        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0"  style="margin-top:5px" alt="PayPal Acceptance Mark">    
                        <input type="submit" id="do" value="Place Order" class="aa-browse-btn">                
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                    token="if you have any token validation"
                    postdata="your javascript arrays or objects which requires in backend"
                    order="If you already have the transaction generated for current order"
                    endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                    </button>

                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </section>
    <!-- / Cart view section -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function(){
        $.ajax({

            url:"https://bdapis.herokuapp.com/api/v1.1/districts/",

            complete:function(xmlHttp, status){

                if(xmlHttp.status==200){
                    
                    str="";
                    var data = xmlHttp.responseJSON.data;
                    
                    str+="<option value='' name='district' selected>Select Your District</option>"
                    for(var i=0; i<data.length; i++){
                        str+="<option name='district' value="+data[i].district+">"+data[i].district+"</option>"
                    }
                    $("#district select").html(str);
                }else{
                    alert(xmlHttp.statusText);
                }

            }

        })

    })

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $("#do").click(function(){
        alert($('#district').find(":selected").text());
        var n=0;
        if($("#name").val()==""){
            $("#nameError").text("You can't leave this empty.");
            n++;
        }
        if($("#phone").val()==""){
            $("#phoneError").text("You can't leave this empty.");
            n++;
        }
        if($("#address").val()==""){
            $("#addressError").text("You can't leave this empty.");
            n++;
        }
        if($("#note").val()==""){
            $("#noteError").text("You can't leave this empty.");
            n++;
        }
        if($('#district').find(":selected").text()=="Select Your District"){
            $("#districtError").text("You can't leave this empty.");
            n++;
        }
        if($('input[name="paymentMethod"]:checked').val()==""){
            $("#paymentMethodError").text("You can't leave this empty.");
            n++;
        }
        if(n>0){
            return false;
        }
    });

</script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

        <script>
            var obj = {};
            obj.cus_name = 'dsd';
            obj.cus_phone = 'dsd';
            obj.cus_email = 'dsd';
            obj.cus_addr1 = 'dsd';
            obj.amount = 'dsd';
        
            $('#sslczPayBtn').prop('postdata', obj);
        
            (function (window, document) {
                var loader = function () {
                    var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                    // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                    script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                    tag.parentNode.insertBefore(script, tag);
                };
        
                window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
            })(window, document);
        </script>



@stop