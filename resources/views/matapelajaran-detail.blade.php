@extends('layouts.web')

@section('title')
    {{ $matapelajaran->nama }}
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item">Materi</div>
    <div class="breadcrumb-item">{{ $matapelajaran->nama }}</div>
@endsection

@section('content')
    <div class="row">
        @foreach ($matapelajaran->materis as $data)
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 mb-3">
                <div class="card" style="border-radius: 1rem">
                    <div class="card-body">
                        <h3 class="badge badge-primary mb-3">{{ $loop->iteration }}</h3>
                        <p class="m-0">{{ $data->nama }}</p>
                        <div style="font-size: .90rem" class="mt-4">
                            <a href="{{ url('topik/' . $data->id) }}"
                                class="d-flex text-decoration-none align-items-center justify-content-between">
                                <span>
                                    Detail Topik
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
