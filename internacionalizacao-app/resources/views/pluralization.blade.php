@extends('layouts.main_layout')

@section('content')
@include('navigation_bar')

<div class="container my-5">
    <h1 class="display-5 fw-bold">@lang('messages.pluralization-title')</h1>
</div>

<div class="container w-25 my-5">
    <form action="{{ route('pluralizationPost') }}" method="post" class="form-inline">
        @csrf

        <div class="form-group mx-sm-3 mb-5">
            <label for="oranges-number" class="sr-only mb-3">@lang('messages.pluralization-input')</label>
            <input type="number" name="oranges-number" id="oranges-number" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mx-sm-3 mb-5">Enviar</button>
    </form>
</div>

@if ($number)
<div class="row">
    <h3 class="display-6">Condição binária</h3>
    <p>{{ trans_choice('pluralization.oranges-binary', $number) }}</p>

    <h3 class="display-6">Múltiplas condições</h3>
    <p>{{ trans_choice('pluralization.oranges-complex', $number) }}</p>
</div>
@endif
@endsection