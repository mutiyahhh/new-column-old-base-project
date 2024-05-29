@extends('layouts.template_default')
@section('title', 'Halaman Profile')
@section('admin', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Halaman Profile</h1>
                    </div>
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if (Auth()->user()->image)
                                    <img src="{{ Storage::url(Auth()->user()->image) }}" alt="profile"
                                    width="120px" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;" class="img-fluid">
                                     @else
                                     <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/img/user_default.png') }}" alt="User profile picture">
                                    @endif
                                </div>
                                <h3 class="profile-username text-center uppercase">{{ auth()->user()->name }}</h3>

                                <p class="text-muted text-center">{{ auth()->user()->nip }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Email :</b> <a class="float-right">{{ auth()->user()->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Nomor Hp :</b> <a class="float-right">{{ auth()->user()->no_hp }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender :</b> <a class="float-right">{{ auth()->user()->gender }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Cabang :</b> <a class="float-right">{{ auth()->user()->Cabang->cabang }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jabatan :</b> <a class="float-right">{{ auth()->user()->Level->level }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Date Account :</b> <a class="float-right">{{ auth()->user()->created_at->isoformat('DD MMMM Y') }}</a>
                                    </li>

                                </ul>

    <p class="btn btn-primary btn-block "></p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
       <!-- /.col -->
       <div class="col-md-8">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#updatePassword" data-toggle="tab">Update Password</a></li>
              <li class="nav-item"><a class="nav-link" href="#updateProfile" data-toggle="tab">Update Profile</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="updatePassword">
                <form action="{{ route('profile.updatePassword') }}" method="post" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="current_password" class="col-sm-4 col-form-label">Current password</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control @error('current_password') is invalid

                          @enderror" id="current_password" name="current_password" placeholder="Current password">
                        </div>
                        @error('current_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                    <div class="form-group row">
                      <label for="password" class="col-sm-4 col-form-label">New password</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control @error('password') is invalid

                        @enderror" id="password" name="password" placeholder="New password">
                      </div>
                      @error('password')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                    </div>

                    <div class="form-group row">
                      <label for="password_confirmation" class="col-sm-4 col-form-label">Password confirmation</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control @error('password_confirmation') is invalid

                        @enderror" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation">
                      </div>
                      @error('password_confirmation')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-4 col-sm-8">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" required> I agree to the terms and conditions
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="updateProfile">
                <form action="{{ route('profile.update', $profile->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control @error('name') is invalid

                          @enderror" id="name" name="name" value="{{old('name') ?? $profile->name}}" >
                        </div>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    <div class="form-group row">

                        <label for="nip" class="col-sm-4 col-form-label">nip</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control @error('nip') is invalid

                          @enderror" id="nip" name="nip" value="{{old('nip') ?? $profile->nip}}" readonly>
                        </div>
                        @error('nip')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-4 col-form-label">No Handphone</label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control @error('no_hp') is invalid

                          @enderror" id="no_hp" name="no_hp" value="{{old('no_hp') ?? $profile->no_hp}}" >
                        </div>
                        @error('no_hp')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control @error('email') is invalid

                          @enderror" id="email" name="email" value="{{old('email') ?? $profile->email}}" readonly >
                        </div>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="gender">Gender</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="gender" name="gender">
                                <option value="Pria" {{ $profile->gender == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Wanita" {{ $profile->gender == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Image</label>
                        <div class="col-sm-8">
                        @if ($profile->image)
                        <img src="{{Storage::url($profile->image)}}" alt="gambar" width="100px"
                            class="tumbnail img-fluid rounded-circle">
                    @else
                        <img alt="image" class="img-fluid tumbnail"
                            src="{{ asset('assets/img/user_default.png') }}" width="100px"
                            class="tumbnail img-fluid">
                    @endif

                    <input type="file" name="image" id="image" class="form-control @error('image') is invalid

                    @enderror">
                      </div>
                      @error('image')
    <span class="text-danger">{{$message}}</span>
@enderror
                      </div>

                    <div class="form-group row">
                      <div class="offset-sm-4 col-sm-8">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" required> I agree to the terms and conditions
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <!-- /.content-wrapper -->
    </div>
@endsection
