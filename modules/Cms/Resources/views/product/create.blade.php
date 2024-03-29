@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Create Product</h3>
                            <a href="{{ route('backend.cms.product.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Product List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.product.store'), 'method' => 'product', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_id" class="@error('brand_id') text-danger @enderror">Product Brand</label>
                                            <select id="brand_id" name="brand_id" class="form-control select2 @error('brand_id') is-invalid @enderror">
                                                <option value="">Select a brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id') ? (old('brand_id') == $brand->id ? 'selected' : '') : '' }}>{{ $brand->additionalInfo->first_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                            <input id="title" name="title" value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" autofocus>
                                            @error('title')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
<!--                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_id" class="@error('product_id') text-danger @enderror">Product ID</label>
                                            <input id="product_id" name="product_id" value="{{ old('product_id') }}" type="text" class="form-control @error('product_id') is-invalid @enderror" placeholder="Enter product id" autofocus>
                                            @error('product_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="@error('image') text-danger @enderror">Upload Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="image" value="{{ old('image') }}" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                                                <label class="custom-file-label font-weight-normal" for="customFile">Choose file</label>
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
<!--                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="priority" class="@error('priority') text-danger @enderror">Priority</label>
                                            <input id="priority" name="priority" value="{{ old('priority') }}" type="number" min="0" class="form-control @error('priority') is-invalid @enderror" placeholder="Enter priority" autofocus>
                                            @error('priority')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock_amount" class="@error('stock_amount') text-danger @enderror">Stock Amount</label>
                                            <input id="stock_amount" name="stock_amount" value="{{ old('stock_amount') }}" type="number" min="0" class="form-control @error('stock_amount') is-invalid @enderror" placeholder="Enter stock amount" autofocus>
                                            @error('stock_amount')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="details" class="@error('details') text-danger @enderror">Description</label>
                                            <textarea id="description" name="details" class="form-control" rows="3" placeholder="Enter details">{{ old('details') }}</textarea>
                                            @error('details')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.cms.product.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
