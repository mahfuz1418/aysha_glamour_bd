@extends('backend.layouts.master')

@section('title', 'Home Slidder')

@section('section')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Home Slider</h1>


                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Home Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between my-1">
                <div>
                    <button type="button" class="btn btn-success myProduct" data-toggle="modal" data-target="#addNew">
                        <i class="fas fa-plus"></i> Add Slider
                    </button>
                </div>
                <form action="">
                    <div class="form-group d-flex">
                        <input class="form-control" type="search" placeholder="Search By Product Name" name="search" value="">
                        <button class="btn btn-info btn-sm ml-2">Search</button>
                    </div>
                </form>

            </div>
            <div class="card">
                <div class="card-header d-flex">
                    <div class="card-header">Slider Table</div>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-recycle"></i> Recycle Bin
                          </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 10%">Thumbnail</th>
                                    <th scope="col" style="width: 10%">Heading</th>
                                    <th scope="col" style="width: 10%">Paragraph</th>
                                    <th scope="col" style="width: 10%">Active Status</th>
                                    <th scope="col" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serials = ($sliders->currentpage() - 1) * $sliders->perpage() + 1;
                                @endphp

                                @forelse($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $serials++ }}</th>
                                        <td>
                                            <img width="200px" src="{{ asset($slider->thumbnail) }}" alt="" srcset="">
                                        </td>
                                        <td>{{ $slider->slider_heading }}</td>
                                        <td>{{ $slider->slider_paragraph }}</td>
                                        <td><span class="badge badge-{{ $slider->active_status == 0 ? 'danger': 'success' }}">{{ $slider->active_status == 0 ? 'Inactive': 'Active' }}</span>
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#editNew"
                                            data-id="{{ $slider->id }}"
                                            data-thumbnail="{{ $slider->thumbnail }}"
                                            data-slider_heading="{{ $slider->slider_heading }}"
                                            data-slider_paragraph="{{ $slider->slider_paragraph }}"
                                            data-active_status="{{ $slider->active_status }}"
                                            class="btn btn-success btn-sm editData">
                                            <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="{{ url('delete-slider/'. $slider->id) }}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-danger font-italic font-weight-bold">Empty Slider</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right my-2">
                            {{ $sliders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--add Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="thumbnail">Slider Image <small class="text-danger"></small></label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                            <span class="text-danger validate" data-field="thumbnail"></span>
                        </div>
                        <div>
                            <img class="d-none" src="" id="previewThumbnail" width="180px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="slider_heading">Slider Heading</label>
                            <input type="text" class="form-control" name="slider_heading" id="slider_heading" placeholder="Enter Slider Heading">
                            <span class="text-danger validate" data-field="slider_heading"></span>
                        </div>
                        <div class="form-group">
                            <label for="slider_paragraph">Slider Paragraph</label>
                            <textarea name="slider_paragraph" class="form-control" id="slider_paragraph" cols="30" rows="3"></textarea>
                            <span class="text-danger validate" data-field="slider_paragraph"></span>
                        </div>
                        <div class="form-group">
                            <label for="active_status">Active Status</label>
                            <select class="form-control select2" name="active_status" id="active_status"
                                data-placeholder="Select Active Status" style="width: 100%">
                                <option selected>Choose Type</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                            <span class="text-danger validate" data-field="active_status"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- edit -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateData">
                    <input type="hidden" id="id_e" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="thumbnail_e">Slider Image <small class="text-danger"></small></label>
                            <input type="file" class="form-control" name="thumbnail_e" id="thumbnail_e">
                            <span class="text-danger validate_e" data-field="thumbnail_e"></span>
                        </div>
                        <div>
                            <img class="d-none" src="" id="previewThumbnail_e" width="180px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="slider_heading_e">Slider Heading</label>
                            <input type="text" class="form-control" name="slider_heading_e" id="slider_heading_e" placeholder="Enter Slider Heading">
                            <span class="text-danger validate_e" data-field="slider_heading_e"></span>
                        </div>
                        <div class="form-group">
                            <label for="slider_paragraph_e">Slider Paragraph</label>
                            <textarea name="slider_paragraph_e" class="form-control" id="slider_paragraph_e" cols="30" rows="3"></textarea>
                            <span class="text-danger validate_e" data-field="slider_paragraph_e"></span>
                        </div>
                        <div class="form-group">
                            <label for="active_status_e">Active Status</label>
                            <select class="form-control select2" name="active_status_e" id="active_status_e"
                                data-placeholder="Select Active Status" style="width: 100%">
                                <option selected>Choose Type</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                            <span class="text-danger validate_e" data-field="active_status_e"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Recycle Bin -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Recycle Bin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('restore-all-slider') }}" class="btn btn-info mr-1"><i class="fas fa-recycle"></i> Restore All</a>
                <a href="{{ route('force-delete-all-slider') }}" class="btn btn-danger"><i class="fas fa-trash"></i> Delete All</a>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Slider Heading</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        @forelse ($trashSlider as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img style="height: 50px" src="{{ asset($item->thumbnail) }}" alt=""></td>
                                <td>{{ $item->slider_heading }}</td>
                                <td>
                                    <a href="{{ url('restore-slider/'. $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-recycle"></i>
                                    </a>
                                    <a href="{{ url('force-delete-slider/'. $item->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-danger font-italic font-weight-bold">Empty Recycle Bin</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function () {
        //SHOW IMAGE WHEN UPLOAD
        $("#thumbnail").change(function() {
            pleasePreview(this, 'previewThumbnail');
        });
        $("#thumbnail_e").change(function() {
            pleasePreview(this, 'previewThumbnail_e');
        });

        // STORE SLIDER
        $("#formData").submit(function(e) {
            e.preventDefault();
            var formdata = new FormData($("#formData")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('store-slider') }}",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formdata,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success);
                    }
                },
                error: function (error) {
                    $('.validate').text('');
                    $.each(error.responseJSON.errors, function (field_name, error) {
                            const errorElement = $('.validate[data-field="' + field_name + '"]');
                            if (errorElement.length > 0) {
                            errorElement.text(error[0]);
                            toastr.error(error);
                            }
                    });
                },
                complete: function(done) {
                    if (done.status == 200) {
                        window.location.reload();
                    }
                }

            });
        });

        // SHOW DATA WHEN CLICK ON EDIT BUTTON
        $('.editData').click(function (e) {
                e.preventDefault();
                $('#editmodal').modal('show');
                $('.validate_e').text('');

                $('#id_e').val($(this).data('id'));
                $('#slider_heading_e').val($(this).data('slider_heading'));
                $('#slider_paragraph_e').val($(this).data('slider_paragraph'));
                $('#active_status_e').val($(this).data('active_status')).trigger('change');

        });
        // EDIT SLIDER
        $("#updateData").submit(function(e) {
            e.preventDefault();
            var formdata = new FormData($("#updateData")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('edit-slider') }}",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formdata,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success);
                    }
                },
                error: function (error) {
                    $('.validate_e').text('');
                    $.each(error.responseJSON.errors, function (field_name, error) {
                            const errorElement = $('.validate_e[data-field="' + field_name + '"]');
                            if (errorElement.length > 0) {
                            errorElement.text(error[0]);
                            toastr.error(error);
                            }
                    });
                },
                complete: function(done) {
                    if (done.status == 200) {
                        window.location.reload();
                    }
                }

            });
        });
    });
</script>

@endsection
