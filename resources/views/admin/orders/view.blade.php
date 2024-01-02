@extends('layouts.admin')
@section('title', 'Orders Detail')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div id="responseMessage" class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Orders Detail
                    <a href="{{ url('admin/orders') }}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                    <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-primary btn-sm float-end mx-1">
                        Download Invoice
                    </a>
                    <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">
                        View Invoice
                    </a>

                </h3>
            </div>
            <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Order Details</b></h5>
                            <hr>
                            <h6>Order ID: {{ $order->id }}</h6>
                            <h6>Tracking ID: {{ $order->tracking_no }}</h6>
                            <h6>Ordered Date: {{ $order->created_at }}</h6>
                            <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                            <h6 class="border p-2 text-success">
                                Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5><b>User Details</b></h5>
                            <hr>
                            <h6>Full Name: {{ $order->fullname }}</h6>
                            <h6>Email: {{ $order->email }}</h6>
                            <h6>Phone: {{ $order->phone }}</h6>
                            <h6>Address: {{ $order->address }}</h6>
                            <h6>Pin Code: {{ $order->pincode }}</h6>
                        </div>
                    </div>

                    <br/>
                    <h5><b>Order Item</b></h5>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Item ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice =0;
                                @endphp
                                @foreach ($order->orderItems as $orderItem)
                                    <tr>
                                        <td width="10%">{{ $orderItem->id }}</td>
                                        <td width="10%">
                                            @if ($orderItem->product->productImages)
                                                <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="">                                                @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif 
                                        </td>
                                        <td>
                                            {{ $orderItem->product->name }} 
                                            @if ($orderItem->productColor)
                                                ({{ $orderItem->productColor->color->name }})
                                            @endif
                                        </td>
                                        <td width="10%">{{ number_format($orderItem->price, 0, ',', '.') }}</td>
                                        <td width="10%">{{ $orderItem->quantity }}</td>
                                        <td width="10%" class="fw-bold">{{ number_format($orderItem->quantity * $orderItem->price, 0, ',', '.') }}</td>
                                        @php
                                            $totalPrice += $orderItem->quantity * $orderItem->price;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="fw-bold"><b>Total Amount:</b></td>
                                    <td colspan="1" class="fw-bold" style="color: red; font-size:16px"><b>{{ number_format($totalPrice, 0, ',', '.') }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>

                
                </div>
            </div>
        </div>
    </div>

        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Process (Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{ url('admin/orders/'.$order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <label>Update Order Status</label>
                            <div class="input-group">
                                <select name="order_status" class="form-select">
                                    <option value="">Select All Status</option>
                                    <option value="in progress" {{ Request::get('status') =='in progress' ? 'selected' :'' }}>In Progress</option>
                                    <option value="completed" {{ Request::get('status') =='completed' ? 'selected' :'' }}>Completed</option>
                                    <option value="pending" {{ Request::get('status') =='pending' ? 'selected' :'' }}>Pending</option>
                                    <option value="cancelled" {{ Request::get('status') =='cancelled' ? 'selected' :'' }}>Cancelled</option>
                                    <option value="out-for-delivery" {{ Request::get('status') =='out-for-delivery' ? 'selected' :'' }}>Out For Delivery</option>
                                </select>
                                <button type="submit" class="btn btn-primary text-white">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br/>
                        <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Check if the success message exists
        if ($('#responseMessage').length > 0) {
            // Hide the success message after 4000 milliseconds (4 seconds)
            setTimeout(function () {
                $('#responseMessage').fadeOut('slow');
            }, 2500);
        }
    });
</script>
@endsection