@extends('layouts.web')

@section('title')
    Latihan Kuis
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item">Latihan Kuis</div>
@endsection

@section('content')
    <div class="row mb-2">
        <div class="col-12">
            <div class="text-center">
                <h3 class="text-dark">Latihan Kuis</h3>
                <p class="text-muted">
                    Silakan kerjakan soal-soal dibawah ini dengan teliti dan benar
                </p>
            </div>
        </div>
    </div>

    <form class="row mb-2" method="POST" action="{{ url('kuis', []) }}">
        @csrf
        <div class="col-md-2 col-12">
            <div class="row">
                @foreach ($soals as $soal)
                    <div class="col-md-3 col-6">
                        <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                            data-target="#soal{{ $soal->id }}" aria-expanded="false"
                            aria-controls="soal{{ $soal->id }}">
                            {{ $loop->iteration }}
                        </button>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-md-10 col-12">
            @foreach ($soals as $soal)
                <input type="hidden" name="id[]" value="{{ $soal->id }}">
                <input type="hidden" name="jumlah" value="{{ $soals->count() }}">
                <div class="collapse multi-collapse" id="soal{{ $soal->id }}">
                    <div class="card card-body mb-1">
                        <h3 class="mb-1"> Soal. {{ $loop->iteration }}</h3>
                        {!! $soal->pertanyaan !!}
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="pilihan[{{ $soal->id }}]"
                                value="a">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ $soal->pilihan_a }}
                            </label>
                            <br>
                            <input class="form-check-input" type="radio" name="pilihan[{{ $soal->id }}]"
                                value="b">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ $soal->pilihan_b }}
                            </label>
                            <br>
                            <input class="form-check-input" type="radio" name="pilihan[{{ $soal->id }}]"
                                value="c">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ $soal->pilihan_c }}
                            </label>
                            <br>
                            <input class="form-check-input" type="radio" name="pilihan[{{ $soal->id }}]"
                                value="d">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ $soal->pilihan_d }}
                            </label>
                            <br>
                            <input class="form-check-input" type="radio" name="pilihan[{{ $soal->id }}]"
                                value="e">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ $soal->pilihan_e }}
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
            <button class="btn btn-primary btn-block" type="submit"
                onclick="return confirm('Apakah Anda Yakin Dengan Jawaban Anda?')">
                Submit Jawaban Anda
            </button>
        </div>
        </div>

    </form>
@endsection
