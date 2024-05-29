@extends('layouts.template_default')
@section('title', 'Create Main Jobs')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Create Main Jobs</h3>
                </div>
                {{-- show error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tugas">Tugas</label>
                            <input type="text" class="form-control @error('tugas') is invalid @enderror"
                                id="tugas" name="tugas" placeholder="tugas" value="{{ old('tugas') }}" required />
                            @error('tugas')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="detail_tugas">Detail Tugas</label>

                            <textarea id="summernote" class="form-control" name="detail_tugas">
                              </textarea>
                            @error('detail_tugas')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Type Jobs</label>
                            <select name="type" id="type"
                                class="form-control @error('type') is invalid
                            @enderror"
                                required>
                                <option selected disabled>-- Pilih Type --</option>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                            </select>

                        </div>
                        @error('type')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="level_id">Tugas Untuk Jabatan</label>
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option disabled selected>-- Pilih Tugas Jabatan --</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cabang_id">Tugas Untuk Cabang</label>
                            <select class="form-control" id="cabang_id" name="cabang_id" required>
                                <option disabled selected>-- Pilih Tugas Cabang --</option>
                                @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->cabang }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="related_level_id">Relate Jobs</label>
                            <select class="form-control js-example-basic-multiple" id="related_level_id" name="related_level_id[]"
                                required multiple="multiple">
                                <option disabled>-- Pilih Relate Jobs --</option>
                                @foreach ($related_job as $related)
                                    <option value="{{ $related->id }}">{{ $related->level }}</option>
                                @endforeach

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" accept="image/*"
                                class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                                placeholder="image" />
                            <p><span class="text-xs text-danger">*sesuaikan gambar dengan detail pekerjaan</span></p>
                            @error('image')
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
