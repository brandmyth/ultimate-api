@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Manage Product</h3>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">January - March</a>
                                        <a class="dropdown-item" href="#">March - June</a>
                                        <a class="dropdown-item" href="#">June - August</a>
                                        <a class="dropdown-item" href="#">August - November</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="forms-sample" action="{{ route('BulkProductUpload') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="category_id">Select Category</label>
                                                    <select class="form-control" id="category_id" name="category_id">
                                                        <option value="">Select</option>
                                                        @foreach ($categories as $section)
                                                            <optgroup label="{{ $section['name'] }}"></optgroup>
                                                            @foreach ($section['categories'] as $category)
                                                                <option value="{{ $category['id'] }}"
                                                                    @if (!empty($product['category_id']) && $product['category_id'] == $category['id']) selected @endif>
                                                                    &ensp;--&nbsp;{{ $category['category_name'] }}</option>
                                                                @foreach ($category['subcategories'] as $subcategory)
                                                                    <option value="{{ $subcategory['id'] }}"
                                                                        @if (!empty($product['category_id']) && $product['category_id'] == $subcategory['id']) selected @endif>
                                                                        &emsp;&ensp;-&nbsp;{{ $subcategory['category_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="brand_id">Select Brand</label>
                                                    <select class="form-control" id="brand_id" name="brand_id">
                                                        <option value="">Select</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand['id'] }}"
                                                                @if (!empty($product['brand_id']) && $product['brand_id'] == $brand['id']) selected @endif>
                                                                {{ $brand['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="excelFile">Input Excel File (.xlsx Only)</label>
                                                    <input class="form-control" type="file" id="excelFile"
                                                        name="excelFile">
                                                    @error('excelFile')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                {{-- <button class="btn btn-primary mr-2"></button> --}}
                                                <label for="downloadButton">Download the template -> Fill up with products
                                                    -> First row is a example how you will insert products</label>
                                                <a id="downloadButton" class="btn btn-primary mr-2"
                                                    href="{{ route('BulkProductUpload', ['download' => 'download']) }}">Download
                                                    Excel Template</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
