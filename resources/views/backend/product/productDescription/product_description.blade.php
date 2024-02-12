@extends('backend.layouts.master')

@section('title', 'Product')

@section('section')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Description({{ $product->name }})</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                        <li class="breadcrumb-item active">Product Description</li>
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
                    <button type="button" class="btn btn-success addnew" data-toggle="modal" data-target="#addNew">
                        <i class="fas fa-plus"></i> Add Description
                    </button>
                </div>
                <div class="form-group">
                    <input class="form-control" type="search" placeholder="Search By Category Name">
                </div>
            </div>

                    <div class="card">
                        <div class="card-header">Products Description</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%">Serial</th>
                                        <th scope="col" style="width: 40%">Content</th>
                                        <th scope="col" style="width: 10%">Active Status</th>
                                        <th scope="col" style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serials = ($productDescriptions->currentpage() - 1) * $productDescriptions->perpage() + 1;
                                    @endphp
                                    @foreach($productDescriptions as $detail)
                                        <tr>
                                            <th scope="row">{{ $serials++ }}</th>
                                            <td>
                                                {!! Str::words($detail->content, 40, ' .... ')  !!}
                                                @if (Str::of($detail->content)->wordCount() > 40)
                                                   <a class="showdes" style="cursor: pointer;" data-description="{{ $detail ->content }}">
                                                    See More
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $detail->active_status == 0 ? 'danger': 'success' }}">{{ $detail->active_status == 0 ? 'Inactive': 'Active' }}</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm rounded-pill btn-rounded dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        Options
                                                    </button>
                                                    <div class="dropdown-menu text-center bg-light-blue">

                                                        <a data-toggle="modal" data-target="#editNew"
                                                            class="btn btn-info btn-sm btn-block editDetail"

                                                            data-id="{{ $detail->id }}"
                                                            data-content="{{ $detail->content }}"
                                                            data-active_status="{{ $detail->active_status }}"> <i class="fas fa-edit"></i> Edit</a>

                                                        <a href="{{ url('delete-Description/'. $detail->id) }}"
                                                            id="delete" class="btn btn-danger btn-sm btn-block"><i
                                                                class="fas fa-trash"></i> Delete</a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="float-right my-2">
                                {{ $productDescriptions->links() }}
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </section>
</div>
</section>

<div class="modal fade" id="addNew">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Description Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formData">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="modal-body">
                <div class="form-group">
                    <label for="active_status">Active Status</label>
                    <select class="form-control select2" name="active_status" id="active_status"
                        data-placeholder="Select Active Status" style="width: 100%">
                        <option value="">Choose Type</option>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    <span class="text-danger validate" data-field="active_status"></span>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea type="text" class="" id="summernote" name="content"  placeholder="Enter Description" > </textarea>
                    <span class="text-danger validate" data-field="content"></span>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
  <!-- /.modal -->
<!-- edit form  -->
  <div class="modal fade" id="editNew">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Description Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editData">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="id_e" id="id_e">
            <div class="modal-body">
                <div class="form-group">
                    <label for="active_status_e">Active Status</label>
                    <select class="form-control select2" name="active_status_e" id="active_status_e"
                        data-placeholder="Select Active Status" style="width: 100%">
                        <option value="">Choose Type</option>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    <span class="text-danger validate_e" data-field="active_status"></span>

                </div>

                <div class="form-group">
                    <label for="content_e">Content</label>
                    <textarea type="text" class="form-control" name="content_e" id="content_e"  > </textarea>
                    <span class="text-danger validate_e" data-field="content"></span>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
  <!-- /.modal -->


{{-- show Description  --}}
<div class="modal fade" id="showdes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Show Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                    <div class="form-group" >
                        <label for="description">Description</label>

                        <p id="description"></p>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    {{-- CLEAR TEXT BY CLICKING BUTTON  --}}
    {{-- <script>
        document.querySelector('.myCategory').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('#categoryName').value = "";
            document.querySelector('#slug').value = "";
        });
    </script> --}}

    <script>


        $(document).ready(function () {
            // STORE PRODUCT DESCRIPTION
            $("#formData").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#formData")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('store-product-description') }}",
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

            $('.showdes').click(function (e) {
                e.preventDefault();
                $('#showdes').modal('show');
                $("#description").html($(this).data('description'));
            });

            // SHOW DATA WHEN CLICK ON EDIT BUTTON
            $('.editDetail').click(function (e) {
                e.preventDefault();
                $('#editmodal').modal('show');
                $('#id_e').val($(this).data('id'));
                $('#content_e').summernote('code', $(this).data('content'))
                $('#active_status_e').val($(this).data('active_status')).trigger('change');
            });

            // EDIT PRODUCT DESCRIPTION
            // $("#updateData").submit(function(e) {
            //     e.preventDefault();
            //     var formdata = new FormData($("#updateData")[0]);
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('edit-category') }}",
            //         contentType: false,
            //         processData: false,
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         data: formdata,
            //         success: function(response) {
            //             if (response.success) {
            //                 toastr.success(response.success);
            //             }
            //         },
            //         error: function (error) {
            //             $('.validate').text('');
            //             $.each(error.responseJSON.errors, function (field_name, error) {
            //                  const errorElement = $('.validate[data-field="' + field_name + '"]');
            //                  if (errorElement.length > 0) {
            //                     errorElement.text(error[0]);
            //                     toastr.error(error);
            //                  }
            //             });
            //         },
            //         complete: function(done) {
            //             if (done.status == 200) {
            //                 window.location.reload();
            //             }
            //         }

            //     });
            // });
        });
    </script>
    <script type="text/javascript">
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 200
                });
                $('#content_e').summernote({
                    height: 200
                });
            });
    </script>
    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif

@endsection
