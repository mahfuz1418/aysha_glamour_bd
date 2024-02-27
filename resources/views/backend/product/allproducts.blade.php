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
                    <a type="button" class="btn btn-success" href="{{ route('add-product') }}">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
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
                    <div class="card-header">Products Table</div>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-recycle"></i> Recycle Bin
                          </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 10%">Thumbnail</th>
                                    <th scope="col" style="width: 10%">Product Name</th>
                                    <th scope="col" style="width: 5%">Category</th>
                                    <th scope="col" style="width: 5%">Subcategory</th>
                                    <th scope="col" style="width: 20%">Price & Size & Stock</th>
                                    <th scope="col" style="width: 10%">Colors</th>
                                    <th scope="col" style="width: 5%">Active & Pin Status</th>
                                    <th scope="col" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serials = ($products->currentpage() - 1) * $products->perpage() + 1;
                                @endphp

                                  @forelse($products as $product)
                                    <tr>
                                        <th scope="row">{{ $serials++ }}</th>
                                        <td>
                                            <img width="80px" src="{{ asset($product->thumbnail) }}" alt="" srcset="">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td>{{ $product->sub_category_name }}</td>
                                        <td>
                                            @php
                                                $product_att = \App\Models\ProductAttribute::where('product_id', $product->id)->get();
                                            @endphp
                                            @foreach ($product_att as $att)
                                            <ul>
                                                <li>
                                                    {{ $att->price }}-[{{ $att->productsize->size }}]-[{{ $att->stock }}P]
                                                </li>
                                            </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $product_att = \App\Models\ProductColor::where('product_id', $product->id)->get();
                                            @endphp
                                            @foreach ($product_att as $att)
                                            <ul>
                                                <li>
                                                    {{ $att->productcolor->color }}
                                                </li>
                                            </ul>
                                            @endforeach
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $product->active_status == 0 ? 'danger': 'success' }}">{{ $product->active_status == 0 ? 'Inactive': 'Active' }} </span>
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
                                                        data-stock="{{ $product->stock }}"
                                                        data-sub_category_id="{{ $product->sub_category_id }}"
                                                        data-slug="{{ $product->slug }}"
                                                        data-selling_price="{{ $product->selling_price }}"
                                                        data-sizes="{{ $product->sizes }}"
                                                        data-colors="{{ $product->colors }}"
                                                        data-active_status="{{ $product->active_status }}"
                                                        class="btn btn-success btn-sm  showDetails btn-block" data-toggle="modal" data-target="#showDetails">
                                                        <i class="fas fa-eye"></i> Show Details
                                                    </button>

                                                    <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-success btn-sm  btn-block">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    @if ($product->pinned == 1)
                                                        <a href="{{ route('update-pin-status', ['id' => $product->id , 'status' => $product->pinned ]) }}"  class="btn btn-danger btn-sm btn-block"><i class="fas fa-thumbtack"></i> Unpin Product</a>
                                                    @else
                                                        <a href="{{ route('update-pin-status', ['id' => $product->id , 'status' => $product->pinned ]) }}"  class="btn btn-success btn-sm btn-block"><i class="fas fa-thumbtack"></i> Pin Product</a>
                                                    @endif

                                                    <a href="{{ url('delete-product/'. $product->id) }}"
                                                        id="delete" class="btn btn-danger btn-sm btn-block"><i
                                                            class="fas fa-trash"></i> Delete</a>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-danger font-italic font-weight-bold">Empty Product</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right my-2">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="showDetails" tabindex="-1" role="dialog" aria-labelledby="showDetails" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                <a href="{{ route('restore-all-Product') }}" class="btn btn-info mr-1"><i class="fas fa-recycle"></i> Restore All</a>
                <a href="{{ route('force-delete-all-product') }}" class="btn btn-danger"><i class="fas fa-trash"></i> Delete All</a>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        @forelse ($trashProducts as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td><img style="height: 50px" src="{{ asset($item->thumbnail) }}" alt=""></td>
                                <td>
                                    <a href="{{ url('restore-product/'. $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-recycle"></i>
                                    </a>
                                    <a href="{{ url('force-delete-product/'. $item->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
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

        function UpdateslugE()
        {
            const productInput = document.getElementById('name_e');
            const slugOutput = document.getElementById('slug_e');

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
            $("#thumbnail_e").change(function() {
                pleasePreview(this, 'previewThumbnail_e');
            });


            //SHOW IMAGE WHEN hover image
            $("#hover_image").change(function() {
                pleasePreview(this, 'hoverImage');
            });
            $("#hover_image_e").change(function() {
                pleasePreview(this, 'hoverImage_e');
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
                $('.validate_e').text('');

                var category_id = $(this).data('category_id');
                console.log(category_id);
                var subcategory_id = $(this).data('sub_category_id');
                $('#category_id_e').val(category_id).trigger('change');
                getSubcategory(category_id, subcategory_id);

                $('#id_e').val($(this).data('id'));
                $('#name_e').val($(this).data('sizes'));
                $('#slug_e').val($(this).data('slug'));
                $('#selling_price_e').val($(this).data('selling_price'));
                $('#stock_e').val($(this).data('stock'));
                // $('#sizes_e').val($(this).data('sizes')).trigger('change');
                // $('#colors_e').val($(this).data('colors')).trigger('change');
                $('#active_status_e').val($(this).data('active_status')).trigger('change');
            });

            // EDIT Products
            $("#updateData").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#updateData")[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('update-product') }}",
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

            //GET SUBCATEGORY VIA CATEGORY (AJAX)
            $("#category_id").change(function (e) {
                e.preventDefault();
                var category_id = $(this).val();
                getSubcategory(category_id, null);
            });

            $("#category_id_e").change(function (e) {
                e.preventDefault();
                var category_id = $(this).val();
                getSubcategory(category_id, null);
            });

            function getSubcategory(category_id, subcategory_id) {
                console.log(category_id, subcategory_id);
                if (subcategory_id == null || subcategory_id) {
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
                                    options += `<option value="${valueOfElement.id}" ${subcategory_id == valueOfElement.id ? "selected" : ""}>${valueOfElement.name}</option>`;
                                    $('#sub_category_id').html(options);
                                    $('#sub_category_id_e').html(options);
                                });
                            } else {
                                options += '<option selected>No Subcategory Added In This Category</option>';
                                $('#sub_category_id').html(options);
                                $('#sub_category_id_e').html(options);

                            }
                        }
                    });
                }
            }
        });
    </script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    @if (Session::has('message'))
    <script>
        toastr.success("{{ Session::get('message') }}");
    </script>
    @endif

@endsection
