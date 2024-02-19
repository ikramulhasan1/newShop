@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trash</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('subcategories.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    {{-- Search --}}
                    <form action="" method="get">
                        <div class="card-header">
                            <div class="card-title">
                                <button type="button" onclick="window.location.href='{{ route('subcategories.trash') }}' "
                                    class="btn btn-sm btn-outline-danger">Reset</button>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px">
                                    <input type="text" value="{{ Request::get('keyword') }}" name="keyword"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th width="100">Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($subcategories) --}}
                                @foreach ($subcategories as $key => $subCategory)
                                    <tr>
                                        {{-- <td>{{ $key + $subCategories->firstItem() }}</td> --}}
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $subCategory->name }} </td>
                                        <td>{{ $subCategory->slug }} </td>
                                        <td>{{ $subCategory->category }} </td>

                                        {{-- @isset($subCategories) --}}
                                        {{-- @dd($subCategories->category) --}}

                                        {{-- @endisset --}}
                                        <td>
                                            @if ($subCategory->status == 1)
                                                <svg class="text-success-500 h-6 w-6 text-success"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @else
                                                <svg class="text-danger-500 h-6 w-6 text-danger"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @endif
                                        </td>
                                        <td class="d-flex ">
                                            <a title="Restore"
                                                href="{{ route('subcategories.restore', $subCategory->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25"
                                                    height="25" viewBox="0 0 48 48">
                                                    <linearGradient id="95F_jjTRbyNtAmgVFg~qQa_bDkQlpOV2TWB_gr1"
                                                        x1="9.858" x2="38.142" y1="9.858" y2="38.142"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-color="#05acb3"></stop>
                                                        <stop offset="1" stop-color="#038387"></stop>
                                                    </linearGradient>
                                                    <path fill="url(#95F_jjTRbyNtAmgVFg~qQa_bDkQlpOV2TWB_gr1)"
                                                        d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z">
                                                    </path>
                                                    <path
                                                        d="M33.015,15.079c-0.297-0.301-0.778-0.317-1.077-0.018l-2.795,2.795	c-0.272,0.272-0.269,0.699-0.021,0.993c3.257,3.865,1.569,9.537-1.962,11.534c-1.291,0.73-5.064,0.858-7.126-0.57	c-2.249-1.557-5.077-6.463-2.162-9.942l2.147,2.147C20.75,22.75,22,22.232,22,21.197V13c0-0.552-0.448-1-1-1h-8.468	c-0.934,0-1.402,1.13-0.742,1.791l2.25,2.25c-4.183,4.705-4.045,12.078,0.374,16.735c4.55,4.794,12.973,5.637,17.651,1.435	C37.02,29.76,39.608,21.751,33.015,15.079z"
                                                        opacity=".05"></path>
                                                    <path
                                                        d="M33.015,15.579c-0.289-0.308-0.778-0.317-1.077-0.018l-2.287,2.287	c-0.277,0.277-0.273,0.711-0.022,1.01c3.109,3.7,1.964,9.273-1.846,11.674c-1.969,1.24-5.624,1.314-7.972-0.285	c-3.181-2.162-4.879-7.369-1.941-10.876l2.037,2.037c0.587,0.587,1.592,0.171,1.592-0.659V13.5c0-0.552-0.448-1-1-1h-7.384	c-0.781,0-1.172,0.944-0.62,1.496l2.044,2.044c-4.235,4.764-4.035,12.185,0.595,16.754c4.541,4.495,12.363,4.917,16.969,0.719	C36.995,29.055,38.419,21.342,33.015,15.579z"
                                                        opacity=".07"></path>
                                                    <path fill="#fff"
                                                        d="M28.409,30.682c-2.634,1.771-6.184,1.771-8.817,0c-4.323-2.907-4.739-8.848-1.248-12.339	l-2.828-2.828c-4.79,4.79-4.676,12.654,0.341,17.298c4.532,4.195,11.754,4.196,16.287,0.002c4.826-4.465,5.117-11.911,0.873-16.736	c-0.279-0.317-0.778-0.317-1.077-0.018L30.16,17.84c-0.282,0.282-0.278,0.723-0.022,1.028	C33.098,22.404,32.522,27.916,28.409,30.682z">
                                                    </path>
                                                    <path fill="#fff"
                                                        d="M20,13h-6.3c-0.627,0-0.941,0.758-0.498,1.202l6.596,6.596C20.242,21.242,21,20.927,21,20.3V14	C21,13.448,20.552,13,20,13z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a title="Forever" href="{{ route('subcategories.delete', $subCategory->id) }}">
                                                <svg class=" " xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                    width="25" height="25" viewBox="0 0 64 64">
                                                    <ellipse cx="32" cy="61" opacity=".3" rx="19"
                                                        ry="3"></ellipse>
                                                    <path fill="#9c34c2"
                                                        d="M43.299,55H20.701c-1.535,0-2.823-1.159-2.984-2.686L14,17h36l-3.717,35.314	C46.122,53.841,44.834,55,43.299,55z">
                                                    </path>
                                                    <path fill="#ffa1ac"
                                                        d="M50,22H14c-1.657,0-3-1.343-3-3v-2c0-1.657,1.343-3,3-3h36c1.657,0,3,1.343,3,3v2	C53,20.657,51.657,22,50,22z">
                                                    </path>
                                                    <path
                                                        d="M43.965,26.469l-2.248,21.757C41.602,49.237,40.746,50,39.729,50H33c-2.762,0-4.997,2.239-4.997,5	h15.296c1.535,0,2.823-1.159,2.984-2.686l3.152-30.249C46.712,21.784,44.274,23.747,43.965,26.469z"
                                                        opacity=".15"></path>
                                                    <path fill="#fff"
                                                        d="M21.111,37.65l-1.585-16.205c-0.004-0.04-0.009-0.08-0.015-0.119	C19.346,20.102,20.244,19,21.48,19h9.385c2.762,0,4.997-2.239,4.997-5H14c-1.657,0-3,1.343-3,3v2c0,1.657,1.343,3,3,3h0.558	l2.139,21.174C19.441,42.868,21.418,40.395,21.111,37.65z"
                                                        opacity=".3"></path>
                                                    <line x1="17.5" x2="23.5" y1="17.5" y2="17.5"
                                                        fill="none" stroke="#fff" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3">
                                                    </line>
                                                    <path fill="#9c34c2"
                                                        d="M39,14H25v-2c0-1.657,1.343-3,3-3h8c1.657,0,3,1.343,3,3V14z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @empty
                                    <table>
                                        </tr>
                                        </th>
                                        <h4 style="text-align: center">No data available</h4>
                                        </th>
                                        </tr>
                                    </table>
                                @endforelse --}}

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        {{-- {{$subcategories->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('customJs')
    <script></script>
@endsection
