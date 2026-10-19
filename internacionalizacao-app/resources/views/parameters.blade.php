@extends('layouts.main_layout')

@section('content')
@include('navigation_bar')

<div class="container my-5">
    <h1 class="display-5 fw-bold">@lang('messages.parameters-title')</h1>
</div>

<div class="container w-25 my-5">

    <form action="/parameters" method="post" class="form-inline">
        @csrf

        <div class="form-group mx-sm-3 mb-5">
            <label for="name-text" class="sr-only mb-3">@lang('messages.parameters-input')</label>
            <input type="text" name="name-text" id="name-text" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mx-sm-3 mb-5">Enviar</button>
    </form>
</div>

@if ($name)
<div class="row">    
    <p>@lang('parameters.meet-you-uppercase', ['name' => $name])</p>
    <p>@lang('Prazer em conhecê-lo, :Name', ['name' => $name])</p>
</div>
@endif
@endsection