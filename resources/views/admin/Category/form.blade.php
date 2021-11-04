@extends('admin.layout.layout')

@section('title', 'Add New Category')


@section('lable', 'Add New Category')

@section('content')
<form method="POST" action="{{ url('/add') }}">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title d-inline">Enter Information to add new Category</h3>
            <div class="text-right">
                <a href="{{ url('/') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body">

            @if (session('sucess'))
            <div class="alert alert-success m-2"> {{ session('sucess') }}</div>
            @endif
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="Text" class="form-control" id="name" placeholder="Enter Name" name="Name"
                        value="{{ old('Name') }}">
                    @error('Name')
                    <div class="alert alert-danger m-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
@endsection

@section('css')
@endsection

@section('script')

@endsection