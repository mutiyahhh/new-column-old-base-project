@extends('layouts.template_default')
@section('title', 'Update Jabatan')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Update Jabatan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('jabatan.update', $jabatan->id)}}" method="POST">
                    @csrf
                    @method('PATCH') <!-- Perubahan di sini -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="level">jabatan</label>
                            <input type="text" class="form-control @error('level') is-invalid @enderror" id="level" name="level" placeholder="level" value="{{ old('level') ?? $jabatan->level }}" required/> <!-- Perubahan di sini -->
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
