@extends('backend.layouts.master')

@section('title', 'Dashboard')

@section('section')
<div class="content-wrapper" x-data="{category:  null }">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subcategory</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Subcategory</li>
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
                        <i class="fas fa-plus"></i> Add Subcategory
                    </button>
                </div>
                <form action="">
                    <div class="form-group d-flex">
                        <input class="form-control" type="search" placeholder="Search By Sub category" name="search" value="">
                        <button class="btn btn-info btn-sm ml-2">Search</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header d-flex">
                    <div>Subategories Table</div>
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
                                <th scope="col">Subcategory</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Categoy</th>
                                <th scope="col">Active Status</th>
                                <th scope="col">Register Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serials = ($subcategories->currentpage() - 1) * $subcategories->perpage() + 1;
                            @endphp
                            @forelse($subcategories as $sub_cat)
                                <tr>
                                    <th scope="row">{{ $serials++ }}</th>
                                    <td>{{ $sub_cat->name }}</td>
                                    <td>{{ $sub_cat->slug }}</td>
                                    <td>{{ $sub_cat->category->name }}</td>
                                    <td><span
                                            class="badge badge-{{ $sub_cat->active_status == 0 ? 'danger': 'success' }}">{{ $sub_cat->active_status == 0 ? 'Inactive': 'Active' }}</span>
                                    </td>
                                    <td>{{ $sub_cat->created_at->format('d/m/Y') }}</td>
                                    <td>

                                        <button type="button" data-toggle="modal" data-target="#editNew"
                                            data-id="{{ $sub_cat->id }}"
                                            data-category_name="{{ $sub_cat->parent_id }}"
                                            data-name="{{ $sub_cat->name }}"
                                            data-slug="{{ $sub_cat->slug }}"
                                            data-active_status="{{ $sub_cat->active_status }}"
                                            class="btn btn-success btn-sm editData">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('delete-category/'. $sub_cat->id) }}"
                                            id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

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
                        {{ $subcategories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Add Subcategory -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Subcategory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="parent_id">Select Category</label>
                            <select class="form-control select2" name="parent_id" id="parent_id" style="width: 100%"
                                data-placeholder="Select Subcategory">
                                <option value="" selected>Select Subcategory</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger validate" data-field="parent_id"></span>
                        </div>
                        <div class="form-group">
                            <label for="subcategoryName">Subategory Name</label>
                            <input type="text" class="form-control" name="subcategoryName" id="subcategoryName"
                                placeholder="Enter Subategory Name" onkeyup="Updateslug()">

                            <span class="text-danger validate" data-field="subcategoryName"></span>
                        </div>

                        <div class="form-group">
                            <label for="slug">Subcategory Slug</label>
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
                            <label for="parent_id">Select Category</label>
                            <select class="form-control select2" name="parent_id" id="parent_id_e" style="width: 100%"
                                data-placeholder="Select Subcategory">
                                <option value="" selected>Select Subcategory</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger validate" data-field="parent_id"></span>
                        </div>
                        <div class="form-group">
                            <label for="subcategoryName">Subcategory Name</label>
                            <input type="text" class="form-control" name="subcategoryName" id="subcategoryName_e"
                                placeholder="Enter Category Name" onkeyup="UpdateslugE()">

                            <span class="text-danger validate" data-field="subcategoryName"></span>
                        </div>

                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" class="form-control" readonly name="slug" id="slug_e"
                                placeholder="Slug Here..." >

                            <span class="text-danger validate" data-field="slug"></span>
                        </div>

                        <div class="form-group">
                            <label for="active_status">Active Status</label>
                            <select class="form-control select2" name="active_status" id="active_status_e"
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
</div>

<!-- Recycle Bin -->


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
            <a href="{{ route('restoreAllCategory') }}" class="btn btn-info"><i class="fas fa-recycle"></i> Restore All</a>
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
                {{-- <tbody>

                    @forelse ($trashCategories as $tc)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $tc->name }}</td>
                            <td>
                                <a href="{{ url('restore-category/'. $tc->id) }}"
                                    id="delete" class="btn btn-info btn-sm"><i class="fas fa-recycle"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-danger font-italic font-weight-bold">Empty Recycle Bin</td>
                        </tr>
                    @endforelse
                </tbody> --}}
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
        function createSlug(subcategoryName)
        {
            const slug = subcategoryName.replace(/[^\w\s-]/g, '').replace(/\s+/g, '-');
            return slug.toLowerCase();
        }

        function Updateslug()
        {
            const categoryInput = document.getElementById('subcategoryName');
            const slugOutput = document.getElementById('slug');

            const subcategoryName = categoryInput.value;
            const slug = createSlug(subcategoryName);
            slugOutput.value = slug;
        }
    </script>

    <script>
        function createSlugE(subcategoryName)
        {
            const slug = subcategoryName.replace(/[^\w\s-]/g, '').replace(/\s+/g, '-');
            return slug.toLowerCase();
        }

        function UpdateslugE()
        {
            const categoryInput = document.getElementById('subcategoryName_e');
            const slugOutput = document.getElementById('slug_e');

            const subcategoryName = categoryInput.value;
            const slug = createSlug(subcategoryName);
            slugOutput.value = slug;
        }
    </script>

    <script>
        $(document).ready(function () {

            // STORE SUBCATEGORY
            $("#formData").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#formData")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('store-subcategory') }}",
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
                $('#id_e').val($(this).data('id'));
                $('#subcategoryName_e').val($(this).data('name'));
                $('#slug_e').val($(this).data('slug'));
                $('#active_status_e').val($(this).data('active_status')).trigger('change');
                $('#parent_id_e').val($(this).data('category_name')).trigger('change');
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
        });
    </script>

    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif

@endsection
