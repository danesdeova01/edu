@extends('layouts.web')

@section('title')
    Materi
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item">Materi</div>
@endsection

@section('content')
    <div class="row mb-2">
        <div class="col-12">
            <div class="text-center">
                <h3 class="text-dark">Materi Terbaru</h3>
                <p class="text-muted">Ikuti Setiap Materi Terbaru untuk Mengasah Diri Kamu</p>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($matapelajarans as $matpel)
            <div class="col-12 col-md-4 col-lg-4">
                <article class="article article-style-c">
                    <div class="article-details">
                        <div class="article-title">
                            <h5>
                                {{ $matpel->nama }}
                            </h5>
                        </div>
                        <div class="article-category"><a href="#">{{ $matpel->materis->count() }} Topik</a>
                            <div class="bullet"></div> <a href="#">{{ $matpel->created_at->diffForHumans() }}</a>
                        </div>
                        <a href="{{ url('materi/' . $matpel->id, []) }}" class="btn btn-outline-primary w-100 mt-3">
                            Lihat Selengkapnya
                        </a>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@endsection
