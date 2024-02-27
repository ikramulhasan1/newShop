@extends('frontend.master')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @if ($categories)
                                    @foreach ($categories as $key => $category)
                                        <div class="accordion-item">
                                            @if ($category->sub_category->isNotEmpty())
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne-{{ $key }}"
                                                        aria-expanded="false" aria-controls="collapseOne">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                            @else
                                                <a href="{{ route('front.shop', $category->slug) }}"
                                                    class="nav-item nav-link  {{ $categorySelected == $category->id ? 'text-primary' : '' }}">
                                                    {{ $category->name }}</a>
                                            @endif

                                            <div id="collapseOne-{{ $key }}"
                                                class="accordion-collapse collapse {{ $categorySelected == $category->id ? 'show' : '' }}"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample"
                                                style="">
                                                <div class="accordion-body">
                                                    <div class="navbar-nav">
                                                        @foreach ($category->sub_category as $subCategory)
                                                            {{-- @dd($subCategory) --}}
                                                            <a href="{{ route('front.shop', [$category->slug, $subCategory->slug]) }}"
                                                                class="nav-item nav-link {{ $categorySelected == $subCategory->id ? 'text-primary' : '' }}">{{ $subCategory->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                Category Not Avaiable
                                            </button>
                                        </h2>
                                        {{-- <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div class="navbar-nav">
                                                    <a href="" class="nav-item nav-link">Mobile</a>
                                                    <a href="" class="nav-item nav-link">Tablets</a>
                                                    <a href="" class="nav-item nav-link">Laptops</a>
                                                    <a href="" class="nav-item nav-link">Speakers</a>
                                                    <a href="" class="nav-item nav-link">Watches</a>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Brand</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @forelse ($brands as $brand)
                                <div class="form-check mb-2">
                                    <input class="form-check-input brand-label" type="checkbox" name="brand[]"
                                        value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                    <label class="form-check-label" for="brand-{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @empty
                                <h2 class="">Category Not Avaiable</h2>
                            @endforelse
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="js-range-slider" name="my_range" value="" />
                        </div>
                    </div>
                </div>

                {{-- Products --}}
                @if ($products)
                    <div class="col-md-9">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <div class="ml-2">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                                data-bs-toggle="dropdown">Sorting</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Latest</a>
                                                <a class="dropdown-item" href="#">Price High</a>
                                                <a class="dropdown-item" href="#">Price Low</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @forelse ($products as $product)
                                {{-- @php
                                    $productImage = $product->image->first();
                                @endphp --}}
                                <div class="col-md-4">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            @if ($product->image)
                                                <a href="{{ route('front.product', $product->slug) }}"
                                                    class="product-img"><img class="card-img-top"
                                                        src="{{ asset('storage/product-images/' . $product->image) }}"
                                                        alt=""></a>
                                            @else
                                                <a href="" class="product-img"><img class="card-img-top"
                                                        src="{{ asset('ui/frontend/images/defult/150x150.png') }}"
                                                        alt=""></a>
                                            @endif

                                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                            <div class="product-action">
                                                <a class="btn btn-dark" href="#">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-center mt-3">
                                            <a class="h6 link"
                                                href="{{ route('front.product', $product->slug) }}">{{ $product->title }}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>{{ $product->price }}</strong></span>
                                                @if ($product->compare_price > $product->price)
                                                    <span
                                                        class="h6 text-underline"><del>{{ $product->compare_price }}</del></span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <div class="card product-card">
                                        <div class="card-body text-center m-1">
                                            <h2>Product not Available</h2>

                                        </div>
                                    </div>
                                </div>
                            @endforelse


                        </div>
                    </div>
                @else
                @endif

            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </section>
@endsection

@section('custom.Js')
    <script>
        rangeSlider = $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 1000,
            from: 0,
            step: 10,
            to: 500,
            skin: "round",
            max_postfix: "+",
            prefix: "$",
            onFinish: function() {
                apply_Filters()
            }
        });

        // Saving it's instance to var
        var slider = $(".js-range-slider").data("ionRangeSlider");

        $(".brand-label").change(function() {
            apply_filters()
        });

        function apply_filters() {
            var brands = [];

            $(".brands-label").each(function() {
                if ($(this).is(":checked") == true) {
                    brands.push($(this).val());
                }
            })
            console.log(brands);
        }
    </script>
@endsection
