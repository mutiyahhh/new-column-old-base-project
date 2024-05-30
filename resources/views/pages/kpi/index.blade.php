@extends('layouts.template_default')
@section('title', 'Halaman KPI')
@section('kpi','active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Halaman KPI</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Halaman KPI</li>
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
                            <div class="card-header">
                                <a class="btn btn-primary" href="{{route('kpi.create')}}"><i class="fa fa-plus"></i> Tambah KPI</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>KPI</th>
                                            <th>Performance Measure</th>
                                            <th>Jabatan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kpis as $kpi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $kpi->name_kpi }}</td>
                                                <td>{{ $kpi->p_measure }}</td>
                                                <td>{{ $kpi->Level->level}}</td>
                                                <td>

                                             <div class="text-center d-flex">
                                                <a href="{{ route('kpi.edit', $kpi->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <form action="{{ route('kpi.destroy', $kpi->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm delete_confirm" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                             </div>
                                                </td>

                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center p-5">Data Kosong</td>
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
