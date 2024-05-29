@extends('layouts.template_default')
@section('title', 'Update Admin')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Update Admin</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.update' , $admin->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is invalid

              @enderror"
                                id="name" name="name" placeholder="Name" value="{{old('name') ?? $admin->name}}" required/>
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">Nip</label>
                            <input type="number" class="form-control @error('nip') is invalid

              @enderror"
                                id="nip" name="nip" placeholder="Nip" value="{{old('nip') ?? $admin->nip}}" required/>
                            @error('nip')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Nomor Handphone</label>
                            <input type="number" class="form-control @error('no_hp') is invalid

                @enderror"
                                id="no_hp" name="no_hp" placeholder="Nomor Handphone" value="{{old('no_hp') ?? $admin->no_hp}}" required/>
                            @error('no_hp')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is invalid

              @enderror"
                                id="email" name="email" placeholder="Email" value="{{old('email') ?? $admin->email}}"  required/>
                            @error('email')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                class="form-control @error('password') is invalid

              @enderror" id="password"
                                name="password" placeholder="Password" value="{{old('password')?? $admin->password}}" required />
                            @error('password')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level_id">Level User</label>
                            <select class="form-control" id="level_id" name="level_id">
                                <option value="{{$admin->level_id}}">{{$admin->level->level}}</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cabang_id">Cabang User</label>
                            <select class="form-control" id="cabang_id" name="cabang_id">
                                <option value="{{$admin->cabang_id}}">{{$admin->cabang->cabang}}</option>
                                @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->cabang }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option selected value="{{$admin->gender}}">{{$admin->gender}}</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                                   @if ($admin->image)
                                   <img src="{{ Storage::url($admin->image) }}" alt="gambar"
                                   width="120px" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;" class="img-fluid">
                                                    @else
                                                        <img alt="image" class="img-fluid tumbnail"
                                                            src="{{ asset('assets/img/user_default.png') }}" width="120px"
                                                            class="tumbnail img-fluid">
                                                    @endif
                            <input type="file" name="image" id="image" class="form- @error('image') is invalid

                            @enderror">
@error('image')
    <span class="text-danger">{{$message}}</span>
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
