@extends('layouts.main_layout')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">VooIF</a>
      </div>
      <div class="container">
        <a class="link-primary" href="#">En</a>
        <a class="link-primary" href="#">pt_BR</a>        
      </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container my-5">
      <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">@lang('messages.welcome')</h1>
          <p class="col-md-8 fs-4">@lang('messages.welcome-text')</p>
          <button class="btn btn-primary btn-lg" type="button">@lang('messages.more')</button>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://jsdelivr.net"></script>
@endsection