@extends('layouts.template_default')
@section('title', 'Update Function')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Update Function</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('function.update', $function->id)}}" method="POST"> <!-- Perubahan di sini -->
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="function">Function</label>
                            <input type="text" class="form-control @error('function') is-invalid @enderror" id="function" name="function" placeholder="Function" value="{{ old('function') ?? $function->function }}" required/> <!-- Perubahan di sini -->
                            @error('function')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
