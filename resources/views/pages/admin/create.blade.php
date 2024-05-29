@extends('layouts.template_default')
@section('title', 'Create Admin')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Create Admin</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is invalid

              @enderror"
                                id="name" name="name" placeholder="Name" value="{{old('name')}}" required/>
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">Nip</label>
                            <input type="number" class="form-control @error('nip') is invalid

              @enderror"
                                id="nip" name="nip" placeholder="Nip" value="{{old('nip')}}" required/>
                            @error('nip')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Nomor Handphone</label>
                            <input type="number" class="form-control @error('no_hp') is invalid

                @enderror"
                                id="no_hp" name="no_hp" placeholder="Nomor Handphone" value="{{old('no_hp')}}" required/>
                            @error('no_hp')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is invalid

              @enderror"
                                id="email" name="email" placeholder="Email" value="{{old('email')}}" required/>
                            @error('email')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control @error('gender') is invalid
                            @enderror" required>
                             <option selected disabled>-- Pilih Gender --</option>
                             <option value="Pria">Pria</option>
                             <option value="Wanita">Wanita</option>
                            </select>
                                 @error('gender')
                                 <span class="text-danger"> {{ $message }}</span>
                             @enderror
                             </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                class="form-control @error('password') is invalid

              @enderror" id="password"
                                name="password" placeholder="Password" required />
                            @error('password')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level_id">Level User</label>
                            <select class="form-control" id="level_id" name="level_id">
                                <option disabled selected>-- Pilih Level User --</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cabang_id">Cabang</label>
                            <select class="form-control" id="cabang_id" name="cabang_id">
                                <option disabled selected>-- Pilih Cabang User --</option>
                                @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->cabang }}</option>
                                @endforeach

                            </select>
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
