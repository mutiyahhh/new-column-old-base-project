@extends('layouts.template_default')
@section('title', 'SISTEM SOP')
@section('dashboard', 'active ')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">sistem sop</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
      <div class="container-fluid">
        <div class="alert alert-success" role="alert">
            Selamat datang, <b class="text-dark"><i>{{auth()->user()->name}}</i></b>! Berikut adalah panduan kerja yang disesuaikan untuk Anda.
          </div>
          <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Job Descriptions</h4>
                    </div>
                    <div class="card-body">
                        <!-- Deskripsi Pekerjaan -->
                        <h5 class="card-title">Deskripsi Pekerjaan</h5>
                        <p class="card-text"><i>Deskripsi pekerjaan yang komprehensif untuk membantu pengguna memahami tugas dan tanggung jawab mereka secara detail.</i></p>
                        <!-- Proses Kerja -->
                        <h5 class="card-title">Proses Kerja</h5>
                        <p class="card-text"><i>Informasi tentang prosedur kerja, kebijakan, dan instruksi yang relevan juga dapat disertakan.</i></p>
                        <!-- Dokumen Terkait -->
                        <h5 class="card-title">Dokumen Terkait</h5>
                        <p class="card-text"><i>Integrasi dengan sistem manajemen dokumen untuk menyimpan dan mengakses panduan kerja, formulir, atau dokumen terkait lainnya.</i></p>
                    </div>
                </div>
            </div>
        </div>
            <!-- Document Management -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Download Document Management</h4>
                        </div>
                        <div class="card-body">
                            <!-- List Dokumen -->
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon ion ion-document-text"></i>
                                    <p>Panduan Kerja
                                    </p>
                                </a>

                        <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon ion ion-clipboard"></i>
                                    <p>simpan sesuatu
                                    </p>
                                </a>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon ion ion-document"></i>
                                    <p>simpan sesuatu
                                    </p>
                                </a>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
<!-- KPI  -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>KPI</h4>
            </div>
            <div class="card-body">
                <!-- List Dokumen -->
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>KPI</h5>
                            <ul>
                               @foreach ($kpis as $kpi )
                                   <li>{{$kpi->name_kpi}}</li>
                               @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Performance Measure</h5>
                            <ul>
                                @foreach ($kpis as $mea )
                                   <li>{{$mea->p_measure}}</li>
                               @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </ul>
            </div>
        </div>
    </div>
</div>
            <!-- Daily, Weekly, Monthly Tasks -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daily, Weekly, Monthly Tasks</h4>
                        </div>
                        <div class="card-body">
                            <!-- Jadwal Tugas -->
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Harian</h5>
                                    <ul>
                                        <li>Briefing pagi</li>
                                        <li>Rapat tim</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Mingguan</h5>
                                    <ul>
                                        <li>Pelaporan mingguan</li>
                                        <li>Review kinerja</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>Bulanan</h5>
                                    <ul>
                                        <li>Rapat evaluasi</li>
                                        <li>Perencanaan strategis</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>

    </div>
@endsection
