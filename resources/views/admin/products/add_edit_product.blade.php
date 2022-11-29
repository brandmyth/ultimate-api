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
                    </div>
                </div>
            </div>
            {{-- {{dd($errors)}} --}}
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
                            <form class="forms-sample"
                                @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif
                                method="post" enctype="multipart/form-data">
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
                                                    <label for="product_name">Product Name</label>
                                                    <input type="text" class="form-control" id="product_name"
                                                        name="product_name"placeholder="Name"
                                                        @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                                                    @error('product_name')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="product_price">Product Price</label>
                                                    <input type="text" class="form-control" id="product_price"
                                                        name="product_price"placeholder="Price"
                                                        @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                                    @error('product_price')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_discount">Product Discount (%)</label>
                                                    <input type="number" min="0" max="100" class="form-control"
                                                        id="product_discount" name="product_discount"placeholder="Discount"
                                                        @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                                    @error('product_discount')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>



                                                <div class="form-group">
                                                    <label for="meta_title">Product Tags (Use Comma)</label>
                                                    <input type="text" class="form-control" id="product_tags"
                                                        name="product_tags"placeholder="Ex: Seeds, Healthy, Oil"
                                                        @if (!empty($product['product_tags'])) value="{{ $product['product_tags'] }}" @else value="{{ old('product_tags') }}" @endif>
                                                    @error('product_tags')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tax_id">Select TAX</label>
                                                    <select class="form-control" name="tax_id">
                                                        <option value="">Select</option>
                                                        @foreach ($taxes as $tax)
                                                            <option value="{{ $tax['id'] }}"
                                                                @if (!empty($product['tax_id']) && $product['tax_id'] == $tax['id']) selected @endif>
                                                                {{ $tax['title'] }} ( {{ $tax['percentage'] }}%) </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="short_description">Product Short
                                                                Description</label>
                                                            <textarea class="form-control" id="short_description" name="short_description" rows="3">{{ $product['short_description'] }}</textarea>
                                                            @error('short_description')
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Product Description</label>
                                                            <textarea class="form-control" id="description" name="description" rows="3">{{ $product['description'] }}</textarea>
                                                            @error('description')
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary mr-2">Submit</button>
                                                        <button type="reset" class="btn btn-light">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="product_image">product Image (Recommended size:
                                                        1000*1000)</label>
                                                    <input type="file" class="form-control" id="product_image"
                                                        name="product_image">
                                                    @if (!empty($product['product_image']))
                                                        <a target="_blank"
                                                            href="{{ url('frontend/images/product_images/large/' . $product['product_image']) }}">View
                                                            Image</a>&nbsp;|&nbsp;<a href="javascript:void(0)"
                                                            class="confirmDelete" module="product-image"
                                                            moduleid="{{ $product['id'] }}">Delete Image
                                                        </a>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="product_video">Product Video (Recommended size: Less than 2
                                                        MB)</label>
                                                    <input type="file" class="form-control" id="product_video"
                                                        name="product_video">
                                                    @if (!empty($product['product_video']))
                                                        <a target="_blank"
                                                            href="{{ url('frontend/videos/product_videos/' . $product['product_video']) }}">View
                                                            video</a>&nbsp;|&nbsp;<a href="javascript:void(0)"
                                                            class="confirmDelete" module="product-video"
                                                            moduleid="{{ $product['id'] }}">Delete Video
                                                        </a>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title</label>
                                                    <input type="text" class="form-control" id="meta_title"
                                                        name="meta_title"placeholder="Meta Title"
                                                        @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                                    @error('meta_title')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keyword</label>
                                                    <input type="text" class="form-control" id="meta_keywords"
                                                        name="meta_keywords"placeholder="Meta Keyword"
                                                        @if (!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                                                    @error('meta_keywords')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_description">Meta Description</label>
                                                    <input type="text" class="form-control" id="meta_description"
                                                        name="meta_description"placeholder="Meta Description"
                                                        @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif>
                                                    @error('meta_description')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="is_popular">Popular Product</label>
                                                    <input type="checkbox" id="is_popular" name="is_popular"
                                                        value="Yes"
                                                        @if (!empty($product['is_popular']) && $product['is_popular'] == 'Yes') checked="" @endif>
                                                    @error('is_popular')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="is_bestseller">Daily Best Sells</label>
                                                    <input type="checkbox" id="is_bestseller" name="is_bestseller"
                                                        value="Yes"
                                                        @if (!empty($product['is_bestseller']) && $product['is_bestseller'] == 'Yes') checked="" @endif>
                                                    @error('is_bestseller')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="is_featured">Featured Item</label>
                                                    <input type="checkbox" id="is_featured" name="is_featured"
                                                        value="Yes"
                                                        @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked="" @endif>
                                                    @error('is_featured')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="is_dealsday">Deals Of The Day</label>
                                                    <input type="checkbox" id="is_dealsday" name="is_dealsday"
                                                        value="Yes"
                                                        @if (!empty($product['is_dealsday']) && $product['is_dealsday'] == 'Yes') checked="" @endif>
                                                    @error('is_dealsday')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="product_collection_id">Product Collection</label>
                                                    <select class="form-control" id="product_collection_id"
                                                        name="product_collection_id">
                                                        <option value="">Select</option>
                                                        @foreach ($productCollection as $collection)
                                                            <option value="{{ $collection['id'] }}"
                                                                @if (!empty($product['product_collection_id']) && $product['product_collection_id'] == $collection['id']) selected @endif>
                                                                {{ $collection['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- <div class="form-group">
                                                    <label for="stock">Product Stock</label>
                                                    <input type="text" class="form-control" id="product_price"
                                                        name="stock[]"placeholder="Stock"
                                                        @if (!empty($product['stock'])) value="{{ $product['stock'] }}" @else value="{{ old('stock') }}" @endif>
                                                    @error('stock')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_code">Product Code SKU</label>
                                                    <input type="text" class="form-control" id="product_code"
                                                        name="product_code[]"placeholder="Sku"
                                                        @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                                                    @error('product_code')
                                                        <span class="text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_weight">Product Weight</label>
                                                    <input type="text" class="form-control" id="product_weight"
                                                        name="product_weight[]"placeholder="Weight"
                                                        @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_size">Product Size</label>
                                                    <input type="text" class="form-control" id="product_size"
                                                        name="product_size[]"placeholder="Color"
                                                        @if (!empty($product['product_size'])) value="{{ $product['product_size'] }}" @else value="{{ old('product_size') }}" @endif>
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_color">Product Color</label>
                                                    <input type="text" class="form-control" id="product_color"
                                                        name="product_color[]"placeholder="Color"
                                                        @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                                                </div> --}}

                                                <div class="form-group">
                                                    <div class="field_wrapper attributeDiv">
                                                        <div>
                                                            <a href="javascript:void(0);" class="btn add_button"
                                                                title="Add field">Add Attribute</a>
                                                        </div>
                                                        {{-- {{dd(json_decode($product['attributes']))}} --}}
                                                        @if (!empty($product['attributes']))
                                                            @foreach (json_decode($product['attributes']) as $attribute)
                                                                <div class="row" style="padding: 1rem">
                                                                    <select class="col-lg-2 form-control"
                                                                        name="attribute_name[]">
                                                                        <option value="">Select</option>
                                                                        @foreach ($attributes as $atbt)
                                                                            <option value="{{ $atbt['name'] }}"
                                                                                @if ($atbt['name'] == $attribute->attribute_name) selected @endif>
                                                                                {{ $atbt['name'] }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input class="col-lg-2 form-control" type="text"
                                                                        name="attribute_value[]" placeholder="Value"
                                                                        required
                                                                        value="{{ $attribute->attribute_value }}" />
                                                                    <input class="col-lg-2 form-control" type="number"
                                                                        name="attribute_price[]" min="1"
                                                                        placeholder="Price" required
                                                                        value="{{ $attribute->attribute_price }}" />
                                                                    <input class="col-lg-2 form-control" type="text"
                                                                        name="stock[]" placeholder="Stock" required
                                                                        value="{{ $attribute->stock }}" />
                                                                    <input class="col-lg-2 form-control" type="text"
                                                                        name="product_sku[]" placeholder="Sku" required
                                                                        value="{{ $attribute->product_sku }}" />
                                                                    &nbsp;<a href="javascript:void(0);"
                                                                        class="btn remove_button">-</a>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                                                        <button type="reset" class="btn btn-light">Cancel</button> -->
                            </form>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div>
                                        <a href="javascript:void(0);" class="btn btn-primary add_multiple_image"
                                            title="Add field">Add Multiple Image</a>
                                    </div>
                                    <div class="row add_image_div" style="padding-top: 1rem">
                                    </div>
                                    @if (!empty($product['images']))
                                        <div class="table-responsive pt-3">
                                            <table class="table table-bordered" id="attribute_table">
                                                <thead>
                                                    <tr>
                                                        <th> ID</th>
                                                        <th> Image </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product['images'] as $image)
                                                        <tr>
                                                            <td> {{ $image['id'] }}
                                                            </td>
                                                            <td>
                                                                <img class="img-fluid"
                                                                    src="{{ asset('frontend/images/product_images/small/' . $image['image']) }}">
                                                            </td>
                                                            <td>
                                                                @if ($image['status'] == 1)
                                                                    <a class="updateImageStatus"
                                                                        id="image-{{ $image['id'] }}"
                                                                        image_id="{{ $image['id'] }}"
                                                                        href="javascript:void(0)">
                                                                        <i style="font-size: 1.5rem;"
                                                                            class="mdi mdi-bookmark-check"
                                                                            status="Active"></i>
                                                                    </a>
                                                                @else
                                                                    <a class="updateImageStatus"
                                                                        id="image-{{ $image['id'] }}"
                                                                        image_id="{{ $image['id'] }}"
                                                                        href="javascript:void(0)">
                                                                        <i style="font-size: 1.5rem;"
                                                                            class="mdi mdi-bookmark-outline"
                                                                            status="Inactive"></i>
                                                                    </a>
                                                                @endif
                                                                &emsp;
                                                                <a href="javascript:void(0)" class="confirmDelete"
                                                                    module="image" moduleid="{{ $image['id'] }}"><i
                                                                        style="font-size: 1.5rem;"
                                                                        class="mdi mdi-file-excel-box"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                    {{-- @error('details')
                                        <p class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {

                $(".add_multiple_image").click(function() {
                    $('.add_image_div').append(
                        '<div class="row col-6"><input class="col-md-10 form-control-file" type="file" name="product_images[]" placeholder="Value" required />&nbsp;<div style="padding-bottom: 1rem"><a href="javascript:void(0);" class="btn btn-danger remove_button">-</a></div></div>'
                        ); //Add field html

                });

                $('.add_image_div').on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').remove(); //Remove field html

                });

            });
        </script>
    @endpush
@endsection
