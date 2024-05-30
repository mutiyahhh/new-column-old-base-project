@extends('layouts.template_default')
@section('title', 'Create KPI')
@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="text-center">Create KPI</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('kpi.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_kpi">KPI</label>
                            <input type="text" class="form-control @error('name_kpi') is invalid

              @enderror"
                                id="name_kpi" name="name_kpi" placeholder="KPI" value="{{old('name_kpi')}}" required/>
                            @error('name_kpi')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="p_measure">Performance Measure</label>
                            <input type="text" class="form-control @error('p_measure') is invalid

              @enderror"
                                id="p_measure" name="p_measure" placeholder="Performance Measure" value="{{old('p_measure')}}" required/>
                            @error('p_measure')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level_id">Jabatan</label>
                            <select class="form-control" id="level_id" name="level_id">
                                <option disabled selected>-- Pilih Level User --</option>
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
