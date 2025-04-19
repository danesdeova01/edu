@extends('layouts.web')

@section('title')
    {{ $topik->nama }}
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item">{{ $topik->nama }}</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <iframe src="{{ asset('storage/materi/file/' . $topik->file) }}" frameborder="0" width="100%"
                height="500"></iframe>
        </div>
        <div class="col-md-12 mb-3">
            <a href="{{ asset('storage/materi/file/' . $topik->file) }}" target="_blank" class="btn btn-outline-primary mb-3">
                Download Materi
            </a>

            {!! $topik->konten !!}
        </div>
    </div>
@endsection
