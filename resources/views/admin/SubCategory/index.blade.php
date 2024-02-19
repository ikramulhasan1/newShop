@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sub-category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('subcategories.create') }}" class="btn btn-primary">New subCategories</a>
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
                                <button type="button" onclick="window.location.href='{{ route('subcategories.index') }}' "
                                    class="btn btn-sm btn-outline-danger">Reset</button>
                                <a href="{{ route('subcategories.trash') }}" class="btn btn-sm btn-danger">Trash</a>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px;">
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
                                            <a href="{{ route('subcategories.edit', $subCategory->id) }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#" class="text-danger w-4 h-4 mr-1">
                                                <form action="{{ route('subcategories.destroy', $subCategory->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="border-0 bg-transparent text-danger w-4 h-4 mr-1">
                                                        <svg wire:loading.remove.delay="" wire:target=""
                                                            class="filament-link-icon w-4 h-4 mr-1"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path ath fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </form>
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
