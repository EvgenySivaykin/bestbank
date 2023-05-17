@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-dark">
                <div class="card-header">
                    <h3 class="card-title">Withdraw money from {{$customer->fname}} {{$customer->lname}}</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">IBAN: {{$customer->account_code}}</p>
                    <p class="card-text">balance: {{$customer->balance}} eur.</p>
                    <form action="{{route('customers-updateWithdraw', $customer)}}" method="post">
                        <div class="mb-3">
                            {{-- {{dump(Session::has('no'))}}
                            {{var_dump($errors)}}
                            {{dump(old('balance'))}} --}}

                            <label class="form-label">withdraw here</label>
                            <input type="text" class="form-control" name="balance" placeholder="0.00" @if (Session::has('no') || count($errors)> 0 ) value={{ old('balance') }} @endif>


                        </div>
                        <button type="submit" class="btn btn-outline-primary mt-4">Withdraw</button>

                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
