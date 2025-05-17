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
            <div id="timer-container">
                <span><strong>Waktu Tersisa:</strong></span>
                <span id="timer"></span>
            </div>
        </div>
    </div>

    <form id="kuisForm" class="row mb-2" method="POST" action="{{ url('kuis', []) }}">
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

                        @if ($soal->jenis_soal == 'pilihan_ganda')
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
                        @elseif($soal->jenis_soal == 'uraian_singkat')
                            <div class="form-group mt-3">
                                <label for="uraian_{{ $soal->id }}">Jawaban Uraian:</label>
                                <textarea class="form-control" name="uraian[{{ $soal->id }}]" rows="3"></textarea>
                            </div>
                        @elseif($soal->jenis_soal == 'pilihan_ganda_kompleks')
                            <div class="form-group mt-3">
                                <label for="pilihan_ganda_kompleks_{{ $soal->id }}">Pilih Beberapa Jawaban:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pilihan[{{ $soal->id }}][]"
                                        value="a">
                                    <label class="form-check-label" for="pilihan_ganda_kompleks_{{ $soal->id }}">
                                        {{ $soal->pilihan_a }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pilihan[{{ $soal->id }}][]"
                                        value="b">
                                    <label class="form-check-label" for="pilihan_ganda_kompleks_{{ $soal->id }}">
                                        {{ $soal->pilihan_b }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pilihan[{{ $soal->id }}][]"
                                        value="c">
                                    <label class="form-check-label" for="pilihan_ganda_kompleks_{{ $soal->id }}">
                                        {{ $soal->pilihan_c }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pilihan[{{ $soal->id }}][]"
                                        value="d">
                                    <label class="form-check-label" for="pilihan_ganda_kompleks_{{ $soal->id }}">
                                        {{ $soal->pilihan_d }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pilihan[{{ $soal->id }}][]"
                                        value="e">
                                    <label class="form-check-label" for="pilihan_ganda_kompleks_{{ $soal->id }}">
                                        {{ $soal->pilihan_e }}
                                    </label>
                                </div>
                            </div>
                        @elseif($soal->jenis_soal == 'menjodohkan')
                            <div class="form-group mt-3">
                                <label for="menjodohkan_{{ $soal->id }}">Pilih jawaban untuk soal ini:</label>
                                <select name="menjodohkan[{{ $soal->id }}]" class="form-control">
                                    <option value="" disabled selected>-- Pilih jawaban --</option>
                                    @foreach ($optionMenjodohkan as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach

            <button class="btn btn-primary btn-block" type="submit"
                onclick="localStorage.removeItem('waktuMulaiKuis'); return confirm('Apakah Anda Yakin Dengan Jawaban Anda?')">
                Submit Jawaban Anda
            </button>

        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waktuMenit = {{ $jenisUjian->timer ?? 30 }};
            const totalDetik = waktuMenit * 60;
            const timerElement = document.getElementById('timer');
            const form = document.querySelector('form');

            let waktuMulai = localStorage.getItem('waktuMulaiKuis');

            if (!waktuMulai) {

                waktuMulai = new Date().getTime();
                localStorage.setItem('waktuMulaiKuis', waktuMulai);
            } else {
                waktuMulai = parseInt(waktuMulai);
            }

            function formatWaktu(s) {
                const m = Math.floor(s / 60);
                const d = s % 60;
                return `${m.toString().padStart(2, '0')}:${d.toString().padStart(2, '0')}`;
            }

            const hitungMundur = setInterval(() => {
                const sekarang = new Date().getTime();
                const selisih = Math.floor((sekarang - waktuMulai) / 1000);
                const waktuTersisa = totalDetik - selisih;

                if (waktuTersisa <= 0) {
                    clearInterval(hitungMundur);
                    timerElement.innerText = "00:00";
                    alert('Waktu habis! Jawaban kamu akan otomatis disubmit.');
                    localStorage.removeItem('waktuMulaiKuis');
                    form.submit();
                } else {
                    timerElement.innerText = formatWaktu(waktuTersisa);
                }
            }, 1000);
        });
    </script>
@endsection
