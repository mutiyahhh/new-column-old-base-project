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
                                    <td>{{ $jobs->job->tugas }}</td>
                                </tr>
                                <tr>
                                    <th>Detail Tugas</th>
                                    <td>{!! $jobs->job->detail_tugas !!}</td>
                                </tr>
                                <tr>
                                    <th>Gambar/Video</th>
                                    <td>
                                        @if($jobs->job->image)
                                            @if(pathinfo($jobs->job->image, PATHINFO_EXTENSION) == 'mp4')
                                                <video width="320" height="240" controls>
                                                    <source src="{{ Storage::url($jobs->job->image) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="{{ url(Storage::url($jobs->job->image)) }}" alt="gambar/vidio" width="320">
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
                    <!-- For Logic like and dislike -->
                    @if(auth()->user()->id != 1)
                        <div class="card-footer">
                            <div class="container">
                                <div class="row">
                                    <p>Apakah kalian menyukai artikel ini?</p>
                                    <input type="text" hidden id="related_job_id" value="{{ $related_job_id }}" />
                                </div>
                                <div class="row justify-content-start">
                                    @if ($jobs->status_review != null)
                                        @if ($jobs->status_review == 1)
                                            <div class="col-2 w-50">
                                                <button class="btn btn-default" style="border: none" onclick="updateLikeReviewByRelatedJobID({{ $related_job_id }})">
                                                    <div id="like-component">
                                                        <input type="text" hidden id="like-component-input" value="1" />
                                                        <img src="{{ asset('assets/img/like-black-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="col-2 w-50">
                                                <button class="btn btn-default" style="border: none" onclick="updateDislikeReviewByRelatedJobID({{ $related_job_id }})">
                                                    <div id="dislike-component">
                                                        <input type="text" hidden id="dislike-component-input" value="0" />
                                                        <img src="{{ asset('assets/img/dislike.png') }}" style="width: 50px;" class="" alt="User Image">
                                                    </div>
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-2 w-50">
                                                <button class="btn btn-default" style="border: none" onclick="updateLikeReviewByRelatedJobID({{ $related_job_id }})">
                                                    <div id="like-component">
                                                        <input type="text" hidden id="like-component-input" value="0" />
                                                        <img src="{{ asset('assets/img/like-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="col-2 w-50">
                                                <button class="btn btn-default" style="border: none" onclick="updateDislikeReviewByRelatedJobID({{ $related_job_id }})">
                                                    <div id="dislike-component">
                                                        <input type="text" hidden id="dislike-component-input" value="0" />
                                                        <img src="{{ asset('assets/img/dislike-black.png') }}" style="width: 50px;" class="" alt="User Image">
                                                    </div>
                                                </button>
                                            </div>
                                        @endif
                                    @else
                                        <div class="col-2 w-50">
                                            <button class="btn btn-default" style="border: none" onclick="updateLikeReviewByRelatedJobID({{ $related_job_id }})">
                                                <div id="like-component">
                                                    <input type="text" hidden id="like-component-input" value="0" />
                                                    <img src="{{ asset('assets/img/like-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                                                </div>
                                            </button>
                                        </div>
                                        <div class="col-2 w-50">
                                            <button class="btn btn-default" style="border: none" onclick="updateDislikeReviewByRelatedJobID({{ $related_job_id }})">
                                                <div id="dislike-component">
                                                    <input type="text" hidden id="dislike-component-input" value="0" />
                                                    <img src="{{ asset('assets/img/dislike.png') }}" style="width: 50px;" class="" alt="User Image">
                                                </div>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
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
@section('script')
    <script>

        function updateLikeReviewByRelatedJobID(id) {
            const _related_job_id = id;
            const _current_value_like_component = $('#like-component-input').val();
            const current_value_dislike = $('#dislike-component-input').val();
            const url = `/review/${_related_job_id}/related`;

            if(current_value_dislike == 2) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Maaf, status review anda saat ini dislike. Jika ingin memperbarui, maka dislike diperbarui dahulu.",
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                if(_current_value_like_component == 0){
                    $.ajax({
                        url: url,
                        method: 'PATCH',
                        data: {
                            review_like: 1,
                        },
                        success: function(response) {
                            const {
                                data: {
                                    status_review
                                }
                            } = response;
                            $('#like-component').html(`
                                <input type="text" hidden id="like-component-input" value="${status_review}" />
                                <img src="{{ asset('assets/img/like-black-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                            `)
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Maaf, Terjadi masalah pada sisi Server. Silahkan hubungi Tim IT",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            console.error("error: ", error);
                        }
                    });
                }else{
                    $.ajax({
                        url: url,
                        method: 'PATCH',
                        data: {
                            review_like: null,
                        },
                        success: function(response) {

                            $('#like-component').html(`
                                <input type="text" hidden id="like-component-input" value="0" />
                                <img src="{{ asset('assets/img/like-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                            `)
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Maaf, Terjadi masalah pada sisi Server. Silahkan hubungi Tim IT",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            console.error("error: ", error);
                        }
                    });
                }
            }

        }

        function updateDislikeReviewByRelatedJobID(id){
            const _related_job_id = id;
            const url = `/review/${_related_job_id}/related`;
            const _current_value_dislike_component = $('#dislike-component-input').val();
            const current_value_like = $('#like-component-input').val();

            if(current_value_like == 1) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Maaf, status review anda saat ini like. Jika ingin memperbarui, maka like diperbarui dahulu.",
                    showConfirmButton: false,
                    timer: 1500
                })
            }else{
                if(_current_value_dislike_component == 0) {
                    $.ajax({
                        url: url,
                        method: 'PATCH',
                        data: {
                            review_like: 2,
                        },
                        success: function(response) {
                            const {
                                data: {
                                    status_review
                                }
                            } = response;
                            $('#dislike-component').html(`
                                <input type="text" hidden id="dislike-component-input" value="${status_review}" />
                                <img src="{{ asset('assets/img/dislike-black.png') }}" style="width: 50px;" alt="User Image">
                            `)
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Maaf, Terjadi masalah pada sisi Server. Silahkan hubungi Tim IT",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            console.error("error: ", error);
                        }
                    });
                }else{
                    $.ajax({
                        url: url,
                        method: 'PATCH',
                        data: {
                            review_like: null,
                        },
                        success: function(response) {
                            $('#dislike-component').html(`
                                <input type="text" hidden id="dislike-component-input" value="0" />
                                <img src="{{ asset('assets/img/dislike.png') }}" style="width: 50px;" class="" alt="User Image">
                            `)
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Maaf, Terjadi masalah pada sisi Server. Silahkan hubungi Tim IT",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            console.error("error: ", error);
                        }
                    });
                }
            }

        }

    </script>
@endsection
