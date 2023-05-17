@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-dark">
                <div class="card-header bg-warning text-dark">
                    <h2 class="m-0">Add new customer</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('customers-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="customer_fname" value="{{ old('customer_fname') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="customer_lname" value="{{ old('customer_lname') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Personal Code</label>
                            <input type="text" class="form-control" name="customer_code" value="{{ old('customer_code') }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
