@extends('layouts.template_default')
@section('title', 'Halaman Jobs')
@section('article-admin-job', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Halaman Main Jobs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Jobs</li>
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
                                        <!--<th>Tanggal Dibuat</th>
                                        <th>Status Approval</th>-->
                                        <th>Type</th>
                                        <th>Tugas</th>
                                        <th>Gambar/Video</th>
                                        <th>Detail Tugas</th>
                                        <th>Jabatan</th>
                                        <th>Relate</th>
                                        <!--<th>Author</th>-->
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($jobs as $job)
                                        <tr>
                                            <!--<td> $job->created_at  }}</td>-->
                                            <!--<td>
                                                if$job->status_approval == "processed")
                                                    <span class="badge badge-info">processed</span>
                                                elseif($job->status_approval == "approved")
                                                    <span class="badge badge-success">approved</span>
                                                elseif($job->status_approval == "not_approved")
                                                    <span class="badge badge-success">not approved</span>
                                                else
                                                    <span class="badge badge-secondary">N/A</span>
                                                endif
                                            </td>-->
                                            <td>{{ $job->type }}</td>
                                            <!--<td> $loop->iteration }}</td>-->
                                            <td>{{ $job->tugas }}</td>
                                            <td>
                                                @if ($job->image)
                                                    @if (pathinfo($job->image, PATHINFO_EXTENSION) == 'mp4')
                                                        <video width="320" height="240" controls>
                                                            <source src="{{ Storage::url($job->image) }}"
                                                                    type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                        <img src="{{ url(Storage::url($job->image)) }}" alt="gambar/vidio"
                                                             width="250" height="250">
                                                    @endif
                                                @endif
                                            </td>

                                            <td>{!!  \Illuminate\Support\Str::limit($job->detail_tugas, 30, '...') !!}</td>
                                            <td>{{ $job->level->level }}</td>
                                            <td>
                                                @foreach($levelNames as $level)
                                                    @if($level["job_id"] == $job->id)
                                                        @if(count($level["level"]) == 0)
                                                            <span class="badge badge-danger">N/A</span>
                                                        @else
                                                            @foreach($level["level"] as $valueLevel)
                                                                <span class="badge badge-secondary">{{ $valueLevel }}</span>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <!--<td> $job->cabang->cabang }}</td>-->
                                            <!--<td> $job->user->name ?? '' }}</td>-->
                                            <td>
                                                <div class="text-center d-flex">
                                                    <a href="{{ route('article.admin.related.getAdminDetailRelatedJobIDArticle', $job->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="p-5 text-center">Data Kosong</td>
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
