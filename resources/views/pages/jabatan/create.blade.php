@extends('layouts.template_default')
@section('title', 'Create Jabatan')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Create Jabatan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('jabatan.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="level">Jabatan</label>
                            <input type="text" class="form-control @error('level') is-invalid @enderror" id="level" name="level" placeholder="Jabatan" value="{{ old('level') }}" required/>
                            @error('level')
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
