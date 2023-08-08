@extends('layout')

@if(Auth::user()->role == 'admin')
    @section('title', 'Dashboard Admin | Perdinku')
@endif

@if(Auth::user()->role == 'sdm')
    @section('title', 'Dashboard SDM | Perdinku')
@endif

@if(Auth::user()->role == 'pegawai')
    @section('title', 'Dashboard Pegawai | Perdinku')
@endif

@section('body')
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
@include('navbar')
@include('sidebar')
@include('content')

@if(Auth::user()->role == 'admin')
    @include('modals.userModal')
    @include('modals.deleteModal')
@endif

@if(Auth::user()->role == 'sdm')
    @if(request()->is('master-city'))
        @include('modals.cityModal')
        @include('modals.deleteModal')
    @else
        @include('modals.viewPedinModal')
    @endif
@endif

@if(Auth::user()->role == 'pegawai')
    @include('modals.addPerdinModal')
@endif

@include('toast')

@endsection