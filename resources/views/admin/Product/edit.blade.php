@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" value="{{ $product->title }}" name="title"
                                                    id="title" class="form-control" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="slug">Slug</label>
                                                <input type="text" value="{{ $product->slug }}" readonly name="slug"
                                                    id="slug" class="form-control" placeholder="Slug">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="editor">Description</label>
                                                <textarea name="description" id="editor" cols="30" rows="10" class="summernote" placeholder="Description">{!! $product->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Media</h2>
                                    <div id="image" class="">
                                        {{-- <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div> --}}
                                        <input type="file" value="{{ $product->image }}" name="image" id="">

                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Pricing</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Price</label>
                                                <input type="text" value="{{ $product->price }}" name="price"
                                                    id="price" class="form-control" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="compare_price">Compare at Price</label>
                                                <input type="text" value="{{ $product->compare_price }}"
                                                    name="compare_price" id="compare_price" class="form-control"
                                                    placeholder="Compare Price">
                                                <p class="text-muted mt-3">
                                                    To show a reduced price, move the product’s original price into Compare
                                                    at
                                                    price. Enter a lower value into Price.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Inventory</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="sku">SKU (Stock Keeping Unit)</label>
                                                <input type="text" value="{{ $product->sku }}" name="sku"
                                                    id="sku" class="form-control" placeholder="sku">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="barcode">Barcode</label>
                                                <input type="text" value="{{ $product->barcode }}" name="barcode"
                                                    id="barcode" class="form-control" placeholder="Barcode">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="track_qty"
                                                        value="{{ $product->track_qty }}" name="track_qty" checked>
                                                    <label for="track_qty" class="custom-control-label">Track
                                                        Quantity</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" min="0" value="{{ $product->qty }}"
                                                    name="qty" id="qty" class="form-control"
                                                    placeholder="Qty">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product status</h2>
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option {{ $product->status == '1' ? 'selected' : '' }} value="1">Active
                                            </option>
                                            <option {{ $product->status == '0' ? 'selected' : '' }} value="0">Block
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4  mb-3">Product category</h2>
                                    <div class="mb-3">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option {{ $product->category ? 'selected' : '' }}
                                                value="{{ $product->category }}">
                                                {{ $product->category }}
                                            </option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->name }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category">Sub category</label>
                                        <select name="sub_category" id="sub_category" class="form-control">
                                            <option {{ $product->sub_category ? 'selected' : '' }}
                                                value="{{ $product->sub_category }}">
                                                {{ $product->sub_category }}
                                            </option>
                                            @if ($subCategories->isNotEmpty())
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->name }}">{{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product brand</h2>
                                    <div class="mb-3">
                                        <select name="brand" id="status" class="form-control">
                                            <option {{ $product->brand ? 'selected' : '' }}
                                                value="{{ $product->brand }}">
                                                {{ $product->brand }}
                                            </option>
                                            @if ($brands->isNotEmpty())
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Featured product</h2>
                                    <div class="mb-3">
                                        <select name="is_featured" id="featured" class="form-control">
                                            <option {{ $category->is_featured == 'Yes' ? 'selected' : '' }}
                                                value="Yes">
                                                Yes
                                            </option>
                                            <option {{ $category->is_featured == 'No' ? 'selected' : '' }} value="No">
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Related Product --}}
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Related product</h2>
                                    <div class="mb-3">
                                        <select multiple name="related_products[]" id="related_products"
                                            class="related-products w-100 form-control">
                                            @if (!empty($product))
                                                {{-- @foreach ($product as $relProduct) --}}
                                                {{-- @dd($relatedProducts) --}}
                                                <option selected value="{{ $product->title }}">
                                                    {{ $product->title }}
                                                </option>
                                                {{-- @endforeach --}}
                                            @else
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button class="btn btn-primary">Update</button>
                        <a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('customJs')
    <script>
        // Select2
        $('.related-products').select2({
            ajax: {
                url: '{{ route('products.getproducts') }}',
                dataType: 'json',
                tags: true,
                multiple: true,
                minimumInputLength: 3,
                processResults: function(data) {
                    return {
                        results: data.tags
                    };
                }
            }
        });


        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
