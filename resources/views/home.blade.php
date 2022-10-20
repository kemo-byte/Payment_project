@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        <form action="{{ route('pay') }}" method="post">
                            @csrf
                            <input type="hidden" name="name" value="{{ $item['name'] }}" class="form-control ">
                            <input type="hidden" name="price" value="{{ $item['price'] }}" class="form-control">
                            <input type="submit" value="Buy Now" class="btn btn-success">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
