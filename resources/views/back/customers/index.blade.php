@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header"> --}}
                <div class="card-header bg-warning text-dark">
                    <form action="{{route('customers-index')}}" method="get">
                        <div class="container">
                            <div class="row justify-content-center">
                                {{-- <div class="col-md-4"> --}}
                                <div class="col-3">
                                    {{-- <h2 class="m-0">CUSTOMER LIST</h2> --}}
                                    <h2 class="custlist">CUSTOMER LIST</h2>

                                    {{-- <h2 class="m-auto">CUSTOMER LIST</h2> --}}
                                </div>

                                {{-- <div class="col-md-4"> --}}
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Sort by</label>
                                        <select class="form-select" name="sort">
                                            <option>default</option>
                                            @foreach($sortSelect as $value => $name)
                                            <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="mb-3">
                                        <label class="form-label">Per page</label>
                                        <select class="form-select" name="per_page">
                                            @foreach($perPageSelect as $value)
                                            <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="head-buttons">
                                        <button type="submit" class="btn btn-outline-primary mt-3">Show</button>
                                        <a href="{{route('customers-index')}}" class="btn btn-outline-info mt-3">Reset</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>


                    <form action="{{route('customers-index')}}" method="get">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Search balance</label>
                                        <input type="text" class="form-control" name="s" value="{{$s}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="head-buttons">
                                        <button type="submit" class="btn btn-outline-primary mt-3">Go</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>


                {{-- <h2 class="m-0">CUSTOMER LIST</h2> --}}
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($customers as $customer)
                    <li class="list-group-item">
                        <div class="list-table">
                            <div class="list-table__content">
                                <h2 class="fw-weight-bolder">{{$customer->fname}} {{$customer->lname}}</h2>
                                <h3>code: {{$customer->code}}</h3>
                                <h3>IBAN: {{$customer->account_code}}</h3>
                                <h2>balance: {{$customer->balance}} eur.</h2>
                            </div>
                            <div class="list table__buttons">
                                {{-- <button type="submit" class="btn btn-outline-success">Edit</button> --}}
                                <a href="{{route('customers-add', $customer)}}" class="btn btn-outline-success m-1">Add</a>
                                <a href="{{route('customers-withdraw', $customer)}}" class="btn btn-outline-success m-1">Withdraw</a>
                                {{-- <a href="{{route('customers-edit', $customer)}}" class="btn btn-outline-success">Edit</a> --}}
                                <form action="{{route('customers-delete', $customer)}}" method="post">
                                    <button type="submit" class="btn btn-outline-danger m-1">Delete</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item">No customers yet</li>
                    @endforelse
                </ul>
            </div>
        </div>
        @if($perPageShow != 'all')
        <div class="m-2">{{ $customers->links() }}</div>
        @endif
    </div>
</div>
</div>
@endsection
