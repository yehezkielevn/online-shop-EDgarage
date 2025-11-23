@extends('layouts.app')

@section('content')

    <div id="hero">
        @include('sections.hero')
    </div>

    <div id="katalog">
        @include('sections.katalog')
    </div>

    <div id="tentang">
        @include('sections.tentang')
    </div>

    <div id="kontak">
        @include('sections.kontak')
    </div>

    @include('auth.login-modal')

@endsection