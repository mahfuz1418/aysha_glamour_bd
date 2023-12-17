@extends('backend.layouts.master')

@section('title', 'Product')

@section('section')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>


                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Products</li>
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
                        <i class="fas fa-plus"></i> Add Product
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
                <div class="card-header">Products Table</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">Serial</th>
                                    <th scope="col" style="width: 10%">Thumbnail</th>
                                    <th scope="col" style="width: 10%">Product Name</th>
                                    <th scope="col" style="width: 10%">Category Name</th>
                                    <th scope="col" style="width: 10%">Subcategory Name</th>
                                    <th scope="col" style="width: 10%">Slug</th>
                                    <th scope="col" style="width: 10%">Selling Price</th>
                                    <th scope="col" style="width: 10%">Active Status</th>
                                    <th scope="col" style="width: 10%">Pin Status</th>
                                    <th scope="col" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serials = ($products->currentpage() - 1) * $products->perpage() + 1;
                                @endphp
                                @foreach($products as $product)
                                    <tr>
                                        <th scope="row">{{ $serials++ }}</th>
                                        <td>
                                            <img width="100px" src="{{ asset($product->thumbnail) }}" alt="" srcset="">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->subcategory->name }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>{{ $product->selling_price }} $</td>
                                        <td><span class="badge badge-{{ $product->active_status == 0 ? 'danger': 'success' }}">{{ $product->active_status == 0 ? 'Inactive': 'Active' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $product->pinned == 0 ? 'danger': 'success' }}">{{ $product->pinned == 0 ? 'Unpinned': 'Pinned' }}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button"
                                                    class="btn btn-primary btn-sm rounded-pill btn-rounded dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    Options
                                                </button>
                                                <div class="dropdown-menu text-center bg-light-blue">
                                                    <button type="button" data-id="{{ $product->id }}"
                                                        data-name="{{ $product->name }}"
                                                        data-category_id="{{ $product->category_id }}"
                                                        data-sub_category_id="{{ $product->sub_category_id }}"
                                                        data-slug="{{ $product->slug }}"
                                                        data-selling_price="{{ $product->selling_price }}"
                                                        data-active_status="{{ $product->active_status }}"
                                                        class="btn btn-success btn-sm editData myProduct btn-block">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    {{-- @if ($product->pinned == 1)
                                                        <a href="{{ route('update-pin-status', ['id' => $product->id , 'status' => $product->pinned ]) }}"  class="btn btn-danger btn-sm btn-block"><i class="fas fa-thumbtack"></i> Unpin Product</a>
                                                    @else
                                                        <a href="{{ route('update-pin-status', ['id' => $product->id , 'status' => $product->pinned ]) }}"  class="btn btn-success btn-sm btn-block"><i class="fas fa-thumbtack"></i> Pin Product</a>
                                                    @endif --}}

                                                    <a href="{{ url('product-advantages/'. $product->id) }}"
                                                        class="btn btn-info btn-sm btn-block"> <i class="fas fa-angle-double-right"></i> Stock</a>

                                                    <a href="{{ url('product-description/'. $product->id) }}"
                                                        class="btn btn-info btn-sm btn-block"> <i class="fas fa-angle-double-right"></i> Description</a>

                                                    <a href="{{ url('delete-product/'. $product->id) }}"
                                                        id="delete" class="btn btn-danger btn-sm btn-block"><i
                                                            class="fas fa-trash"></i>Delete</a>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-right my-2">
                            {{-- {{ $products->links() }} --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formData">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="thumbnail">Product Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                placeholder="Enter Product thumbnail"
                                value="">
                            <span class="text-danger validate" data-field="thumbnail"></span>
                        </div>
                        <div>
                            <img class="d-none" src="" id="previewThumbnail" width="200px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category Name</label>
                            <select class="form-control select2 category_id" name="category_id" id="category_id"
                                style="width: 100%" data-placeholder="Select Category">
                                <option value="" selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger validate" data-field="category_id"></span>
                        </div>

                        <div class="form-group">
                            <label for="sub_category_id">Sub Category Name</label>
                            <select class="form-control select2" name="sub_category_id" id="sub_category_id"
                                style="width: 100%" data-placeholder="Select Subcategory">
                                <option value="" selected>Select Subcategory</option>
                            </select>


                            <span class="text-danger validate" data-field="sub_category_id"></span>
                        </div>


                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter Product Name"
                                value="" onkeyup="Updateslug()">

                            <span class="text-danger validate" data-field="name"></span>
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" readonly name="slug" id="slug"
                                placeholder="Enter Slug">

                            <span class="text-danger validate" data-field="slug"></span>
                        </div>

                        <div class="form-group">
                            <label for="selling_price">Selling Price</label>
                            <input type="number" class="form-control" name="selling_price" id="selling_price"
                                placeholder="Enter Selling Price">

                            <span class="text-danger validate" data-field="selling_price"></span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editData">
                    <input type="hidden" id="id_e" name="id">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="thumbnail_e">Product Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail_e"
                                placeholder="Enter Product thumbnail"
                                value="">

                            <span class="text-danger" id="error_thumbnail_e"></span>
                        </div>
                        <div>
                            <img class="d-none" src="" id="previewThumbnail_e" width="200px" alt="">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category Name</label>
                            <select class="form-control select2 category_id" name="category_id" id="category_id_e"
                                style="width: 100%" data-placeholder="Select Category">
                                <option value="" selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger validate" data-field="category_id"></span>
                        </div>

                        {{-- <div class="form-group">
                            <label for="sub_category_id_e">Sub Category Name</label>
                            <select class="form-control select2" name="sub_category_id" id="sub_category_id_e"
                                style="width: 100%" data-placeholder="Select Subcategory">
                                <option value="" selected>Select Subcategory</option>
                            </select>


                            <span class="text-danger" id="error_subcategory_e"></span>
                        </div> --}}
                        <div class="form-group">
                            <label for="name_e">Product Name</label>
                            <input type="text" class="form-control" name="name" id="name_e"
                                placeholder="Enter Product Name" name="name"
                                value="">

                            <span class="text-danger" id="error_name_e"></span>
                        </div>

                        <div class="form-group">
                            <label for="slug_e">Slug</label>
                            <input type="text" class="form-control" readonly name="slug" id="slug_e"
                                placeholder="Enter Slug">

                            <span class="text-danger" id="error_slug_e"></span>
                        </div>

                        <div class="form-group">
                            <label for="selling_price_e">Selling Price</label>
                            <input type="number" class="form-control" name="selling_price" id="selling_price_e"
                                placeholder="Enter Selling Price">

                            <span class="text-danger" id="error_selling_price_e"></span>
                        </div>
                        <div class="form-group">
                            <label for="active_status_e">Active Status</label>
                            <select class="form-control select2" name="active_status" id="active_status_e"
                                data-placeholder="Select Active Status" style="width: 100%">
                                <option selected>Choose Type</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>

                            <span class="text-danger" id="error_active_status_e"></span>
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
</div>

@endsection

@section('script')

    <script>
        function createSlug(productName)
        {
            const slug = productName.replace(/[^\w\s-]/g, '').replace(/\s+/g, '-');
            return slug.toLowerCase();
        }

        function Updateslug()
        {
            const productInput = document.getElementById('name');
            const slugOutput = document.getElementById('slug');

            const productName = productInput.value;
            const slug = createSlug(productName);
            slugOutput.value = slug;
        }
    </script>

    <script>
        $(document).ready(function () {
            //SHOW IMAGE WHEN UPLOAD
            $("#thumbnail").change(function() {
                pleasePreview(this, 'previewThumbnail');
            });

            // STORE PRODUCT
            $("#formData").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#formData")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('store-product') }}",
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
                $('#category_id_e').val($(this).data('category_id')).trigger('change');
                // $('#sub_category_id').val($(this).data('sub_category_id')).trigger('change');

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


            //GET SUBCATEGORY VIA CATEGORY (AJAX)
            $("#category_id").change(function (e) {
                e.preventDefault();
                var category_id = $(this).val();
                getSubcategory(category_id);
            });
            $("#category_id_e").change(function (e) {
                e.preventDefault();
                var category_id = $(this).val();
                getSubcategory(category_id);
            });

            function getSubcategory(category_id) {
                if (category_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get-subcategory') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            category_id: category_id
                        },
                        success: function (response) {
                            var options = '';
                            // options += '<option selected>Select Subcategory</option>';

                            if (response.subcategory.length > 0) {
                                $.each(response.subcategory, function (indexInArray, valueOfElement) {
                                    options += `<option value="${valueOfElement.id}" ${sub_category_id == valueOfElement.id ? "selected" : ""}>${valueOfElement.name}</option>`;
                                    $('#sub_category_id').html(options);
                                });
                            } else {
                                options += '<option selected>No Subcategory Added In This Category</option>';
                                $('#sub_category_id').html(options);

                            }
                        }
                    });
                }
            }
        });
    </script>

@endsection
