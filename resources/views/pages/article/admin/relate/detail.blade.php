@extends('layouts.template_default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Article - Detail Relate</div>
                    <div class="card-body">
                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Tugas</th>
                                    <td>{{ $jobs->tugas }}</td>
                                </tr>
                                <tr>
                                    <th>Detail Tugas</th>
                                    <td>{!! $jobs->detail_tugas !!}</td>
                                </tr>
                                <tr>
                                    <th>Gambar/Video</th>
                                    <td>
                                        @if($jobs->image)
                                            @if(pathinfo($jobs->image, PATHINFO_EXTENSION) == 'mp4')
                                                <video width="320" height="240" controls>
                                                    <source src="{{ Storage::url($jobs->image) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="{{ url(Storage::url($jobs->image)) }}" alt="gambar/vidio" width="320">
                                            @endif
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- End of Table --}}
                    </div>
                    {{-- End of card-body --}}
                </div>
                {{-- End of card --}}
            </div>
            {{-- End of col-md-8 --}}
        </div>
        {{-- End of row --}}
    </div>
    {{-- End of container --}}
@endsection
