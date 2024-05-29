@extends('layouts.template_default')
@section('title', 'Update Cabang')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Update Cabang</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('cabang.update', $cabang->id)}}" method="POST">
                    @csrf
                    @method('PATCH') <!-- Perubahan di sini -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cabang">Cabang</label>
                            <input type="text" class="form-control @error('cabang') is-invalid @enderror" id="cabang" name="cabang" placeholder="Cabang" value="{{ old('cabang') ?? $cabang->cabang }}" required/> <!-- Perubahan di sini -->
                            @error('cabang')
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
