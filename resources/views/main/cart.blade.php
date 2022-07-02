@extends('main.layouts.app')
@section('content')
    <br>
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        <div class="row">
            @if ($cart)
                <div class="col-md-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach ($cart->items as $product)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product['name_en'] }}</h5>
                                <div class="card-text">
                                    {{-- Update Cart Form --}}
                                    <form action="{{ route('updateCart', $product['id']) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        ${{ $product['price'] * $product['qty'] }}
                                        <input type="number" name="qty" id="qty" value="{{ $product['qty'] }}">
                                        <button
                                            type="submit"
                                            class="btn btn-outline-info btn-sm"
                                            >
                                            Change
                                        </button>
                                    </form>
                                    {{-- Delete Cart Form --}}
                                    <form action="{{ route('deleteCart', $product['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-outline-danger btn-sm ml-4 float-right"
                                            style="margin-top:-30px">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <p><strong>Total : ${{ $cart->totalPrice }}</strong></p>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h3 class="card-title">
                                Your Cart
                                <hr>
                            </h3>
                            <div class="card-text">
                                <p>
                                Total Amount is ${{$cart->totalPrice}}
                                </p>
                                <p>
                                Total Quantities is {{$cart->totalQty}}
                                </p>
                                <h4 class="mb-3">Payment</h4>
                                    <form method="POST" action="{{ route('payment') }}">
                                        @csrf
                                        <div class="my-3">
                                            <div class="form-check">
                                                <input id="credit" name="paymentMethodId" value="2" type="radio" class="form-check-input" checked required>
                                                <label class="form-check-label" for="credit">Visa</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="credit" name="paymentMethodId" value="2" type="radio" class="form-check-input" checked required>
                                                <label class="form-check-label" for="credit">Master</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="credit" name="paymentMethodId" value="1" type="radio" class="form-check-input" checked required>
                                                <label class="form-check-label" for="credit">Knet</label>
                                            </div>
                                        </div>
                                        <hr class="my-4">

                                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>There are no items in the cart</p>
            @endif
        </div>
    </div>
@endsection
