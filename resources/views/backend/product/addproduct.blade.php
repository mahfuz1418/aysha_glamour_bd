@extends('backend.layouts.master')

@section('title', 'Product')
@section('section')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Add Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Add Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="formData">
                      <div class="card-body">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold bg-info p-2" >Add Product Image</h5>
                                    <div class="col-12 row my-3">
                                        <div class="col-lg-2 col-md-4 col-sm-6" >
                                            <label for="">Thumbnail <small class="text-danger">(Required)</small></label>
                                            <input name="image1" type="file" class="dropify1" data-height="100" />
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6" >
                                            <label for="">Hover Img <small class="text-danger">(Required)</small></label>
                                            <input name="image2" type="file" class="dropify2" data-height="100" />
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6" >
                                            <label for="">Image No 3 <small class="text-info">(Optional)</small></label>
                                            <input name="image3" type="file" class="dropify3" data-height="100" />
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6" >
                                            <label for="">Image No 4 <small class="text-info">(Optional)</small></label>
                                            <input name="image4" type="file" class="dropify4" data-height="100" />
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6" >
                                            <label for="">Image No 5 <small class="text-info">(Optional)</small></label>
                                            <input name="image5" type="file" class="dropify5" data-height="100" />
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-6" >
                                            <label for="">Image No 6 <small class="text-info">(Optional)</small></label>
                                            <input name="image6" type="file" class="dropify6" data-height="100" />
                                        </div>
                                    </div>
                                    <span class="text-danger validate" data-field="image1"></span><br>
                                    <span class="text-danger validate" data-field="image2"></span>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category_id">Category Name</label>
                                    <select class="form-control category_id" name="category_id" id="category_id"
                                        style="width: 100%" data-placeholder="Select Category">
                                        <option value="" selected>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger validate" data-field="category_id"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sub_category_id">Sub Category Name</label>
                                    <select class="form-control" name="sub_category_id" id="sub_category_id"
                                        style="width: 100%" data-placeholder="Select Subcategory">
                                        <option value="" selected>Select Subcategory</option>
                                    </select>
                                    <span class="text-danger validate" data-field="sub_category_id"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Product Name"
                                        value="" onkeyup="Updateslug()">

                                    <span class="text-danger validate" data-field="name"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" readonly name="slug" id="slug"
                                        placeholder="Slug will be autometic generate">

                                    <span class="text-danger validate" data-field="slug"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="slug">Description</label>
                                    <textarea id="summernote" name="description" ></textarea>
                                    <span class="text-danger validate" data-field="description"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Select Colors</label>
                                    <div class="select2-purple">
                                      <select class="select2" multiple="multiple" data-placeholder="Select Colors" data-dropdown-css-class="select2-purple" name="colors[]" style="width: 100%;">
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->color }}</option>
                                        @endforeach
                                      </select>
                                    <span class="text-danger validate" data-field="colors"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="active_status">Active Status</label>
                                    <select class="form-control" name="active_status" id="active_status"
                                        data-placeholder="Select Active Status" style="width: 100%">
                                        <option selected>Choose Type</option>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>

                                    <span class="text-danger validate" data-field="active_status"></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 row" >
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch mb-2">
                                        <input type="checkbox" name="checkdata" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Select Sizes and Enter Price</label>
                                    </div>
                                    <div class="select2-purple" style="display: none" id="content1">
                                        <select class="select2" multiple="multiple" data-placeholder="Select Sizes" data-dropdown-css-class="select2-purple" name="sizes[]" id="sizes" style="width: 100%;">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}"><p class="text-uppercase">{{ $size->size }}</p></option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger validate" data-field="sizes"></span>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none" id="content2" >
                                    <table class="table table-bordered" id="processedDataTable">
                                        <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Data will be dynamically added here -->

                                        </tbody>
                                    </table>
                                </div>
                                <div  id="nosize">

                                    <div class="form-group">
                                        <label for="selling_price">Selling Price</label>
                                        <input type="number" class="form-control" name="selling_price" id="selling_price"
                                            placeholder="Enter Selling Price">
                                        <span class="text-danger validate" data-field="selling_price"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" name="stock" id="stock"
                                            placeholder="Add Stock">
                                            <span class="text-danger validate" data-field="stock"></span>
                                    </div>

                            </div>
                            </div>

                        </div>

                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card -->

                </div>
                <!--/.col (left) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->


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
            // By check box show size data
            $('#customSwitch1').change(function() {
                if ($(this).is(':checked')) {
                    $('#content1').show(); // Show HTML content if checkbox is checked
                    $('#content2').show(); // Show HTML content if checkbox is checked
                    $('#nosize').hide(); // Hide HTML content if checkbox is unchecked
                    $('#selling_price').val('');
                    $('#stock').val('');

                } else {
                    $('#content1').hide(); // Hide HTML content if checkbox is unchecked
                    $('#content2').hide(); // Hide HTML content if checkbox is unchecked
                    $('#nosize').show(); // Hide HTML content if checkbox is unchecked
                    $('#sizes').val('');
                }
            });
            //Get value from multiple selection
            $('#sizes').change(function(e) {
                e.preventDefault();
                var selectedSizes = $('#sizes').val();
                getSizes(selectedSizes);
            });
            function getSizes(selectedSizes) {
                if (selectedSizes) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get-sizes') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            selectedSizes: selectedSizes
                        },
                        success: function (response) {
                            $('#processedDataTable tbody').text('');
                            response.processedData.forEach(function(data) {
                                var newRow = '<tr>' +
                                                '<td>' + data.size + '</td>' +
                                                '<td><input type="number" name="price[]" class="form-control"></td>' +
                                                '<td><input type="number" name="stockbysize[]" class="form-control"></td>' +
                                            '</tr>';
                                $('#processedDataTable tbody').append(newRow);
                            });
                        }
                    });
                }
            }

            //Summernote
            $('#summernote').summernote({
                placeholder: 'Enter Product Description Here',
                tabsize: 2,
                height: 200
            });
            //Dropify
            $('.dropify1').dropify({
                messages: {
                        'default': 'Drag and drop a image here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove':  'X',
                        'error':   'Ooops, something wrong happended.'
                    }
            });
            $('.dropify2').dropify({
                messages: {
                        'default': 'Drag and drop a image here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove':  'X',
                        'error':   'Ooops, something wrong happended.'
                    }
            });
            $('.dropify3').dropify({
                messages: {
                        'default': 'Drag and drop a image here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove':  'X',
                        'error':   'Ooops, something wrong happended.'
                    }
            });
            $('.dropify4').dropify({
                messages: {
                        'default': 'Drag and drop a image here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove':  'X',
                        'error':   'Ooops, something wrong happended.'
                    }
            });
            $('.dropify5').dropify({
                messages: {
                        'default': 'Drag and drop a image here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove':  'X',
                        'error':   'Ooops, something wrong happended.'
                    }
            });
            $('.dropify6').dropify({
                messages: {
                        'default': 'Drag and drop a image here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove':  'X',
                        'error':   'Ooops, something wrong happended.'
                    }
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


