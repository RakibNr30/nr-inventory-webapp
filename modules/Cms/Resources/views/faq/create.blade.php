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
                            <h3 class="card-title mt-1">Create Faq</h3>
                            <a href="{{ route('backend.cms.faq.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Faq List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.faq.store'), 'method' => 'faq', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="question" class="@error('question') text-danger @enderror">Question</label>
                                            <input id="question" name="question" value="{{ old('question') }}" type="text" class="form-control @error('question') is-invalid @enderror" placeholder="Enter question" autofocus>
                                            @error('question')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="@error('answer') text-danger @enderror">Answer</label>
                                            <textarea id="description" name="answer" class="form-control" rows="3" placeholder="Enter answer">{{ old('answer') }}</textarea>
                                            @error('answer')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.cms.faq.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
