@extends('layouts.main_layout')

@section('content')
@include('navigation_bar')

<div class="container my-5">
  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">@lang('messages.welcome')</h1>
      <p class="col-md-8 fs-4">@lang('messages.welcome-text')</p>
      <button class="btn btn-primary btn-lg" type="button">@lang('messages.more')</button>
    </div>
    <button class="btn btn-primary btn-md" type="button"><a class="link-light link-underline-opacity-0" href="{{ route('json') }}">@lang('messages.json-view')</a></button>
    <button class="btn btn-primary btn-md" type="button"><a class="link-light link-underline-opacity-0" href="{{ route('parameters') }}">@lang('messages.parameters-view')</a></button>
    <button class="btn btn-primary btn-md" type="button"><a class="link-light link-underline-opacity-0" href="{{ route('pluralization') }}">@lang('messages.pluralization-view')</a></button>
  </div>
</div>
@endsection