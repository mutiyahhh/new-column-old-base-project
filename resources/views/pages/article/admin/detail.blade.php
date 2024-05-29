@extends('layouts.template_default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Pekerjaan</div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Tugas</th>
                                <td>{{ $job->tugas }}</td>
                            </tr>
                            <tr>
                                <th>Detail Tugas</th>
                                <td>{!! $job->detail_tugas !!}</td>
                            </tr>
                            <tr>
                                <th>Gambar/Video</th>
                                <td>
                                    @if($job->image)
                                        @if(pathinfo($job->image, PATHINFO_EXTENSION) == 'mp4')
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset('storage/' . $job->image) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/' . $job->image) }}" alt="Gambar Pekerjaan" width="320">
                                        @endif
                                    @else
                                        Tidak ada
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- For Logic like and dislike -->
                    @if(auth()->user()->id != 1)
                        <div class="card-footer">
                            <div class="container">
                                <div class="row">
                                    <p>Apakah kalian menyukai artikel ini?</p>
                                </div>
                                <div class="row justify-content-start">
                                    @if($job->status_approval != "approved")
                                        <div class="col-2 w-50">
                                            <button class="btn btn-default disabled" style="border: none" onclick="updateLikeReviewByJobID({{ $job->id }})" disabled>
                                                <div id="like-component">
                                                    <input type="text" hidden id="like-component-input" value="0" />
                                                    <img src="{{ asset('assets/img/like-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                                                </div>
                                            </button>
                                        </div>
                                        <div class="col-2 w-50">
                                            <button class="btn btn-default disabled" style="border: none" onclick="updateDislikeReviewByJobID({{ $job->id }})" disabled>
                                                <div id="dislike-component">
                                                    <input type="text" hidden id="dislike-component-input" value="0" />
                                                    <img src="{{ asset('assets/img/dislike.png') }}" style="width: 50px;" class="" alt="User Image">
                                                </div>
                                            </button>
                                        </div>
                                    @else
                                        @if ($job->status_review != null)
                                            @if ($job->status_review == 1)
                                                <div class="col-2 w-50">
                                                    <button class="btn btn-default" style="border: none" onclick="updateLikeReviewByJobID({{ $job->id }})">
                                                        <div id="like-component">
                                                            <input type="text" hidden id="like-component-input" value="1" />
                                                            <img src="{{ asset('assets/img/like-black-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="col-2 w-50">
                                                    <button class="btn btn-default" style="border: none" onclick="updateDislikeReviewByJobID({{ $job->id }})">
                                                        <div id="dislike-component">
                                                            <input type="text" hidden id="dislike-component-input" value="0" />
                                                            <img src="{{ asset('assets/img/dislike.png') }}" style="width: 50px;" class="" alt="User Image">
                                                        </div>
                                                    </button>
                                                </div>
                                            @else
                                                <div class="col-2 w-50">
                                                    <button class="btn btn-default" style="border: none" onclick="updateLikeReviewByJobID({{ $job->id }})">
                                                        <div id="like-component">
                                                            <input type="text" hidden id="like-component-input" value="0" />
                                                            <img src="{{ asset('assets/img/like-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="col-2 w-50">
                                                    <button class="btn btn-default" style="border: none" onclick="updateDislikeReviewByJobID({{ $job->id }})">
                                                        <div id="dislike-component">
                                                            <input type="text" hidden id="dislike-component-input" value="0" />
                                                            <img src="{{ asset('assets/img/dislike-black.png') }}" style="width: 50px;" class="" alt="User Image">
                                                        </div>
                                                    </button>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-2 w-50">
                                                <button class="btn btn-default" style="border: none" onclick="updateLikeReviewByJobID({{ $job->id }})">
                                                    <div id="like-component">
                                                        <input type="text" hidden id="like-component-input" value="0" />
                                                        <img src="{{ asset('assets/img/like-no_flip.png') }}" style="width: 50px; margin-left: 50px" alt="User Image">
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="col-2 w-50">
                                                <button class="btn btn-default" style="border: none" onclick="updateDislikeReviewByJobID({{ $job->id }})">
                                                    <div id="dislike-component">
                                                        <input type="text" hidden id="dislike-component-input" value="0" />
                                                        <img src="{{ asset('assets/img/dislike.png') }}" style="width: 50px;" class="" alt="User Image">
                                                    </div>
                                                </button>
                                            </div>
                                        @endif
                                    @endif


                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- For Logic Approval admin -->
                    @if(auth()->user()->id == 1)
                        <div class="card-footer">
                            <div class="container">
                                <div class="row">
                                    <p>
                                        Status Approval ini adalah <b>{{ $job->status_approval  }}</b>. Silahkan klik button dibawah untuk approval
                                    </p>
                                </div>
                                @if($job->status_approval == "processed")
                                    <button class="btn btn-success btn-sm" onclick="approvalByJobID({{ $job->id }}, 'approved')">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="approvalByJobID({{ $job->id }}, 'not_approved')">
                                        <i class="fa fa-times"></i> Not Approve
                                    </button>
                                @else
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="fa fa-times"></i> Not Approve
                                    </button>
                                @endif
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>

        function updateLikeReviewByJobID(id) {
            const _job_id = id;
            const _current_value_like_component = $('#like-component-input').val();
            const current_value_dislike = $('#dislike-component-input').val();
            const url = `/review/${_job_id}/job`;

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

        function updateDislikeReviewByJobID(id){
            const _job_id = id;
            const url = `/review/${_job_id}/job`;
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

        function approvalByJobID(id, approval) {
            const job_id = id;
            const status_approval = approval;
            const url = `/job/${job_id}/approval`;

            console.info("status_approval: ", status_approval)
            console.info("job_id: ", job_id)
            if(status_approval === "approved"){
                Swal.fire({
                    title: "Apakah kamu yakin?",
                    text: "untuk mensetujuinya/ Approved!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'PATCH',
                            data: {
                                approval: status_approval,
                            },
                            success: function(response) {
                                const {
                                    message, status_code, status
                                } = response;
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Berhasil mensetujui/ approved!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Maaf, Terjadi masalah pada sisi Server. Silahkan hubungi Tim IT",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });
                    }
                });
            }else if(status_approval === "not_approved"){
                Swal.fire({
                    title: "Apakah kamu yakin?",
                    text: "untuk Menolak/ Not Approved!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'PATCH',
                            data: {
                                approval: status_approval,
                            },
                            success: function(response) {
                                const {
                                    message, status_code, status
                                } = response;
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Berhasil meolak/ not approved!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Maaf, Terjadi masalah pada sisi Server. Silahkan hubungi Tim IT",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });
                    }
                });
            }
        }

    </script>
@endsection
