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
                                                <a href="{{ url('delete-size/'. $size->id) }}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

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
                                                <a href="{{ url('delete-color/'. $color->id) }}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

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


</div>


@endsection

@section('script')

    <script>
        $(document).ready(function () {
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
