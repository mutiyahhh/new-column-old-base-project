@extends('layouts.template_default')
@section('title', 'Halaman Relate')
@section('article-relate-position', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Halaman Article - Relate Job Position</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Relate</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Status Approval</th>
                                        <th>Type</th>
                                        <th>Tugas</th>
                                        <th>Gambar/Video</th>
                                        <th>Detail Tugas</th>
                                        <th>Jabatan</th>
                                        <th>Relate</th>
                                        <th>Author</th>
                                        <th>Total Like</th>
                                        <th>Total Dislike</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($relates as $relate)
                                        <tr>
                                            <td>
                                                @if($relate->status_approval == "processed")
                                                    <span class="badge badge-info">processed</span>
                                                @elseif($relate->status_approval == "approved")
                                                    <span class="badge badge-success">approved</span>
                                                @elseif($relate->status_approval == "not_approved")
                                                    <span class="badge badge-success">not approved</span>
                                                @else
                                                    <span class="badge badge-secondary">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $relate->job_type }}</td>
                                            <td>{{ $relate->job_tugas }}</td>
                                            <td>
                                                @if ($relate->job_image)
                                                    @if (pathinfo($relate->job_image, PATHINFO_EXTENSION) == 'mp4')
                                                        <video width="320" height="240" controls>
                                                            <source src="{{ Storage::url($relate->job_image) }}"
                                                                    type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                        <img src="{{ url(Storage::url($relate->job_image)) }}" alt="gambar/vidio"
                                                             width="320">
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{!!  \Illuminate\Support\Str::limit($relate->job_detail_tugas, 30, '...') !!}</td>
                                            <td>{{ $relate->job_level }}</td>
                                            <td>
                                                @if (isset($levelNames[$relate->job_id]))
                                                    @foreach ($levelNames[$relate->job_id] as $levelName)
                                                        {{ $levelName }}
                                                        @if (!$loop->last)
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $relate->username ?? '' }}</td>
                                            <td>{{ $relate->total_like}} </td>
                                            <td>{{ $relate->total_dislike}} </td>
                                            <td>
                                                <div class="text-center d-flex">
                                                    <a href="{{ route('job.getJobDetailIDByAdmin', $relate->job_id) }}" class="btn btn-primary btn-sm">Detail</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="p-5 text-center">Data Kosong</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
