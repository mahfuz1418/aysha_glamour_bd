@extends('backend.layouts.master')

@section('title', 'Category')

@section('section')
<div class="content-wrapper" x-data="{category:  null }">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>

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
            <div class="d-flex justify-content-between my-1">
                <div>
                    <button type="button" class="btn btn-success addnew myCategory" data-toggle="modal" data-target="#addNew">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
                <form action="">
                    <div class="form-group d-flex">
                        <input class="form-control" type="search" placeholder="Search By Coupon Name" name="search" value="">
                        <button class="btn btn-info btn-sm ml-2">Search</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header d-flex">
                    <div>Categories Table</div>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-recycle"></i> Recycle Bin
                          </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Active Status</th>
                                <th scope="col">Register Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serials = ($categories->currentpage() - 1) * $categories->perpage() + 1;
                            @endphp
                            @forelse($categories as $category)
                                <tr>
                                    <th scope="row">{{ $serials++ }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td><span
                                            class="badge badge-{{ $category->active_status == 0 ? 'danger': 'success' }}">{{ $category->active_status == 0 ? 'Inactive': 'Active' }}</span>
                                    </td>
                                    <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                    <td>

                                        <button type="button" data-toggle="modal" data-target="#editNew"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-slug="{{ $category->slug }}"
                                            data-active_status="{{ $category->active_status }}"
                                            class="btn btn-success btn-sm editData">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('delete-category/'. $category->id) }}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-danger font-italic font-weight-bold">No Category Added</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="float-right my-2">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Add Category -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control" name="categoryName" id="categoryName"  placeholder="Enter Category Name" onkeyup="Updateslug()">

                            <span class="text-danger validate" data-field="categoryName"></span>
                        </div>

                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" class="form-control" readonly name="slug" id="slug"
                                placeholder="Slug Here..." >

                            <span class="text-danger validate" data-field="slug"></span>
                        </div>

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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- edit -->
    <div class="modal fade" id="editNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateData">
                    <div class="modal-body">
                        <input type="text" id="id_e" name="id_e" hidden>
                        <div class="form-group">
                            <label for="categoryName_e">Category Name</label>
                            <input type="text" class="form-control" name="categoryName_e" id="categoryName_e"
                                placeholder="Enter Category Name" onkeyup="UpdateslugE()">

                            <span class="text-danger validate_e" data-field="categoryName_e"></span>
                        </div>

                        <div class="form-group">
                            <label for="slug_e">Category Slug</label>
                            <input type="text" class="form-control" readonly name="slug_e" id="slug_e"
                                placeholder="Slug Here..." >

                            <span class="text-danger validate_e" data-field="slug_e"></span>
                        </div>

                        <div class="form-group">
                            <label for="active_status_e">Active Status</label>
                            <select class="form-control select2" name="active_status_e" id="active_status_e"
                                data-placeholder="Select Active Status" style="width: 100%">
                                <option value="">Choose Type</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                            <span class="text-danger validate_e" data-field="active_status_e"></span>
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

<!-- Recycle Bin -->
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Recycle Bin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('restore-all-Category') }}" class="btn btn-info"><i class="fas fa-recycle"></i> Restore All</a>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @forelse ($trashCategories as $tc)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $tc->name }}</td>
                            <td>
                                <a href="{{ url('restore-category/'. $tc->id) }}" class="btn btn-info btn-sm"><i class="fas fa-recycle"></i>
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

@endsection

@section('script')

    <script>
        function createSlug(categoryName)
        {
            const slug = categoryName.replace(/[^\w\s-]/g, '').replace(/\s+/g, '-');
            return slug.toLowerCase();
        }
        function Updateslug()
        {
            const categoryInput = document.getElementById('categoryName');
            const slugOutput = document.getElementById('slug');

            const categoryName = categoryInput.value;
            const slug = createSlug(categoryName);
            slugOutput.value = slug;
        }
        function UpdateslugE()
        {
            const categoryInput = document.getElementById('categoryName_e');
            const slugOutput = document.getElementById('slug_e');

            const categoryName = categoryInput.value;
            const slug = createSlug(categoryName);
            slugOutput.value = slug;
        }
    </script>

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
            // STORE CATEGORY
            $("#formData").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#formData")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('store-category') }}",
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
                $('#categoryName_e').val($(this).data('name'));
                $('#slug_e').val($(this).data('slug'));
                $('#active_status_e').val($(this).data('active_status')).trigger('change');
            });

            // EDIT CATEGORY
            $("#updateData").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#updateData")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('edit-category') }}",
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

    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif

@endsection
