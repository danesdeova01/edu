@extends('layouts.web')

@section('title')
    Kirim Tugas
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item">Kirim Tugas</div>
@endsection

@section('content')
    <div class="row mb-2">
        <div class="col-md-4 col-12">
            @foreach ($tugas as $data)
                <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                    data-target="#tugas{{ $data->id }}" aria-expanded="false" aria-controls="tugas{{ $data->id }}">
                    {{ $loop->iteration . '. ' . $data->matapelajaran->nama }}
                </button>
            @endforeach
        </div>
        <div class="col-md-8 col-12">
            @foreach ($tugas as $data)
                <div class="collapse multi-collapse" id="tugas{{ $data->id }}">
                    <div class="card card-body">
                        {!! $data->konten !!}

                        <div class="mt-3">
                            <a href="{{ $data->file != null ? asset('storage/tugas/file/' . $data->file) : '#' }}"
                                target="_blank" class="btn btn-primary">
                                Download File Tugas
                            </a>
                            <a href="{{ url('kirimtugas/submit/' . $data->id) }}" class="btn btn-warning ml-2">
                                Kirim Jawaban
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
