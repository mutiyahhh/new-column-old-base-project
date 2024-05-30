@extends('layouts.template_default')
@section('title', 'Update KPI')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Update KPI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('kpi.update', $kpi->id)}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_kpi">KPI</label>
                            <input type="text" class="form-control @error('name_kpi') is invalid

              @enderror"
                                id="name_kpi" name="name_kpi" placeholder="KPI" value="{{old('name_kpi') ?? $kpi->name_kpi}}" required/>
                            @error('name_kpi')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="p_measure">Performance Measure</label>
                            <input type="text" class="form-control @error('p_measure') is invalid

              @enderror"
                                id="p_measure" name="p_measure" placeholder="Performance Measure" value="{{old('p_measure') ?? $kpi->p_measure}}" required/>
                            @error('p_measure')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level_id">Jabatan</label>
                            <select class="form-control" id="level_id" name="level_id">
                                <option value="{{$kpi->level_id}}">{{$kpi->level->level}}</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
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
