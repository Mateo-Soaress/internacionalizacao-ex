@extends('layouts.main_layout')

@section('content')
@include('navigation_bar')

<div class="container my-5">
  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">@lang('Bem-vindo ao BooKing')</h1>
      <p class="col-md-8 fs-4">@lang('Encontre os melhores preços no rei dos voos')</p>
      <button class="btn btn-primary btn-lg" type="button">@lang('Saiba mais')</button>
    </div>
    <button class="btn btn-primary btn-md" type="button"><a class="link-light link-underline-opacity-0" href="{{ route('index') }}">@lang('Vá para a página anterior')</a></button>
    <button class="btn btn-primary btn-md" type="button"><a class="link-light link-underline-opacity-0" href="{{ route('parameters') }}">@lang('Vá para a página de teste de parâmetros')</a></button>
    <button class="btn btn-primary btn-md" type="button"><a class="link-light link-underline-opacity-0" href="{{ route('pluralization') }}">@lang('Vá para a página de teste de pluralização')</a></button>
  </div>
</div>
@endsection