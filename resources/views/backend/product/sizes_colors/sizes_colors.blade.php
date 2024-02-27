@extends('backend.layouts.master')

@section('title', 'Sizes & Colors')

@section('section')
<div class="content-wrapper" x-data="{category:  null }">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sizes & Colors</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12 d-flex">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <form id="addSize">
                                        <div class="mb-3">
                                          <label for="size" class="form-label">Size</label>
                                          <input type="text" class="form-control" id="size" name="size" placeholder="Add Sizes">
                                          <span class="text-danger validate" data-field="size"></span>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Size</button>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Serial</th>
                                        <th scope="col">Sizes</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serials = ($sizes->currentpage() - 1) * $sizes->perpage() + 1;
                                    @endphp
                                    @forelse($sizes as $size)
                                        <tr>
                                            <th scope="row">{{ $serials++ }}</th>
                                            <td>{{ $size->size }}</td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#editSize"
                                                    data-id="{{ $size->id }}"
                                                    data-size="{{ $size->size }}"
                                                    class="btn btn-success btn-sm editData">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-danger font-italic font-weight-bold">No Size Added</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="float-right my-2">
                                {{ $sizes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <form id="addColor">
                                        <div class="mb-3">
                                          <label for="color" class="form-label">Add Color</label>
                                          <input type="text" class="form-control" id="color" name="color" placeholder="Add Colors">
                                          <span class="text-danger validate" data-field="color"></span>

                                          <div class="form-group">
                                            <label>Color picker with addon:</label>

                                            <div class="input-group my-colorpicker2">
                                              <input type="text" class="form-control" name="color_code" placeholder="Enter Color Code">

                                              <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-square"></i></span>
                                              </div>
                                            </div>
                                            <span class="text-danger validate" data-field="color_code"></span>
                                            <!-- /.input group -->
                                          </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Color</button>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Serial</th>
                                        <th scope="col">Colors</th>
                                        <th scope="col">Color Code & Color</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serials = ($colors->currentpage() - 1) * $colors->perpage() + 1;
                                    @endphp
                                    @forelse($colors as $color)
                                        <tr>
                                            <th scope="row">{{ $serials++ }}</th>
                                            <td>{{ $color->color }}</td>
                                            <td class="d-flex">
                                                {{ $color->color_code }}
                                                <div style="background-color: {{ $color->color_code }}; width: 20px; padding: 10px 20px; height: 10px; border: 2px solid gray; margin: 0px 10px; "></div>
                                            </td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#editColor"
                                                    data-id="{{ $color->id }}"
                                                    data-color="{{ $color->color }}"
                                                    data-color_code="{{ $color->color_code }}"
                                                    class="btn btn-success btn-sm editColorBtn">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-danger font-italic font-weight-bold">No Color Added</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="float-right my-2">
                                {{ $colors->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!---Edit Size Modal--->
    <div class="modal fade" id="editSize" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Size</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="editSizeData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="size_e">Size</label>
                            <input type="text" hidden name="id_e" id="id_e">
                            <input type="text" class="form-control" name="size_e" id="size_e" >

                            <span class="text-danger validate_e" data-field="size_e"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!---Edit Color Modal--->
    <div class="modal fade" id="editColor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Color</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="editColorForm">
                    {{-- <input type="text" name="id_e" id="id_c_e"> --}}
                    <div class="mb-3">
                      <label for="color_e" class="form-label">Edit Color</label>
                      <input type="text" class="form-control" id="color_e" name="color_e" placeholder="Add Colors">
                      <span class="text-danger validate_e" data-field="color_e"></span>

                      <div class="form-group">
                        <label>Edit Color Code</label>

                        <div class="input-group my-colorpicker2">
                          <input type="text" class="form-control" id="color_code_e" name="color_code_e" placeholder="Enter Color Code">

                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                          </div>
                        </div>
                        <span class="text-danger validate_e" data-field="color_code_e"></span>
                        <!-- /.input group -->
                      </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>


    </div>


@endsection

@section('script')

    <script>
        $(document).ready(function () {

            // SHOW DATA WHEN CLICK ON EDIT SIZE BUTTON
            $('.editData').click(function (e) {
                $('#id_e').val($(this).data('id'));
                $('#size_e').val($(this).data('size'));
            });

            // SHOW DATA WHEN CLICK ON EDIT COLOR BUTTON
            $('.editColorBtn').click(function (e) {
                $('#id_c_e').val($(this).data('id'));
                $('#color_e').val($(this).data('color'));
                $('#color_code_e').val($(this).data('color_code'));
            });

            // STORE SIZE
            $("#addSize").submit(function(e) {
                e.preventDefault();
                var addSize = new FormData($("#addSize")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('add-sizes') }}",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: addSize,
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

            // EDIT SIZE
            $("#editSizeData").submit(function(e) {
                e.preventDefault();
                var editSize = new FormData($("#editSizeData")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('edit-size') }}",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: editSize,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        }
                    },
                    error: function (error) {
                        $('.validate').text('');
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
            // STORE COLOR
            $("#addColor").submit(function(e) {
                e.preventDefault();
                var addSize = new FormData($("#addColor")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('add-colors') }}",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: addSize,
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

             // EDIT COLOR
             $("#editColorForm").submit(function(e) {
                e.preventDefault();
                var editcolor = new FormData($("#editColorForm")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('edit-color') }}",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: editcolor,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        }
                    },
                    error: function (error) {
                        $('.validate').text('');
                        $.each(error.responseJSON.errors, function (field_name, error) {
                             const errorElement = $('.validate_e[data-field="' + field_name + '"]');
                             if (errorElement.length > 0) {
                                errorElement.text(error[0]);
                                toastr.error(error);
                             }
                        });
                    },
                    // complete: function(done) {
                    //     if (done.status == 200) {
                    //         window.location.reload();
                    //     }
                    // }

                });
            });

            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })
        });
    </script>

    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif

@endsection
