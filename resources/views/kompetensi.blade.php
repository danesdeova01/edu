@extends('layouts.web')

@section('title')
    Kompetensi
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item">Kompetensi</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! $kompetensi->deskripsi !!}
        </div>
    </div>
@endsection
