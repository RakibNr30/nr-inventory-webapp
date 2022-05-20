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
                            <h3 class="card-title mt-1">Add Warehouse Product</h3>
                            <a href="{{ route('backend.cms.logistic.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.logistic.store'), 'method' => 'logistic', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_id" class="@error('product_id') text-danger @enderror">Product</label>
                                            <select id="product_id" name="product_id" class="form-control select2 @error('product_id') is-invalid @enderror">
                                                <option value="">Select a product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ old('product_id') ? (old('product_id') == $product->id ? 'selected' : '') : '' }}>{{ $product->title ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="influencer_id" class="@error('influencer_id') text-danger @enderror">Influencer</label>
                                            <select id="influencer_id" name="influencer_id" class="form-control select2 @error('influencer_id') is-invalid @enderror">
                                                <option value="">Select a influencer</option>
                                                @foreach($influencers as $influencer)
                                                    <option value="{{ $influencer->id }}" {{ old('influencer_id') ? (old('influencer_id') == $influencer->id ? 'selected' : '') : '' }}>
                                                        {{ $influencer->additionalInfo->first_name ?? '' }} {{ $influencer->additionalInfo->last_name ?? '' }} ({{ $influencer->email ?? '' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('influencer_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_count" class="@error('product_count') text-danger @enderror">Product Count</label>
                                            <input id="product_count" name="product_count" value="{{ old('product_count') }}" type="number" min="0" class="form-control @error('product_count') is-invalid @enderror" placeholder="Enter product count" autofocus>
                                            @error('product_count')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.cms.logistic.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
