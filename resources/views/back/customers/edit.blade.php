@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit customer</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('customers-update', $customer)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="customer_fname" value="{{$customer->fname}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="customer_lname" value="{{$customer->lname}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Personal Code</label>
                            <input type="text" class="form-control" name="customer_code" value="{{$customer->code}}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary mt-4">Save</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
