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
                            <h3 class="card-title mt-1">Faq Details</h3>
                            <a href="{{ route('backend.cms.faq.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Faq List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="question" class="@error('question') text-danger @enderror">Question</label>
                                        <input id="question" name="question" value="{{ $faq->question ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('question')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('answer') text-danger @enderror">Answer</label>
                                        <input id="description" name="answer" value="{{ $faq->answer ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('answer')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.cms.faq.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
