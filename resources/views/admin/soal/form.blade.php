@extends('layouts.app')

@section('title')
    Form Soal Ujian
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ $url }}" method="POST">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                @php
                    function isChecked($data1, $data2)
                    {
                        if (is_array($data1)) {
                            return in_array($data2, $data1) ? 'checked' : '';
                        }
                        return $data1 == $data2 ? 'checked' : '';
                    }
                @endphp

                <!-- Materi -->
                <div class="row mb-4">
                    <label for="matapelajaran_id" class="col-sm-2 col-form-label">Materi</label>
                    <div class="col-sm-10">
                        <select name="topik" class="form-control" required>
                            @foreach ($mata_pelajarans as $item)
                                <option value="{{ $item->id }}"
                                    {{ $isEdit && $data->id == $item->id ? 'selected' : '' }}>
                                    Materi {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Jenis Ujian -->
                <div class="row mb-4">
                    <label for="jenis_ujian" class="col-sm-2 col-form-label">Jenis Ujian</label>
                    <div class="col-sm-10">
                        <select name="jenis_ujian" class="form-control" required>
                            <option value="UTS" {{ $isEdit && $data->jenis_ujian == 'UTS' ? 'selected' : '' }}>UTS (Ujian
                                Tengah Semester)</option>
                            <option value="UAS" {{ $isEdit && $data->jenis_ujian == 'UAS' ? 'selected' : '' }}>UAS (Ujian
                                Akhir Semester)</option>
                        </select>
                    </div>
                </div>

                <!-- Jenis Soal -->
                <div class="row mb-4">
                    <label for="jenis_soal" class="col-sm-2 col-form-label">Jenis Soal</label>
                    <div class="col-sm-10">
                        <select name="jenis_soal" id="jenisSoal" class="form-control" required>
                            <option value="pilihan_ganda"
                                {{ $isEdit && $data->jenis_soal == 'pilihan_ganda' ? 'selected' : '' }}>Pilihan Ganda
                            </option>
                            <option value="pilihan_ganda_kompleks"
                                {{ $isEdit && $data->jenis_soal == 'pilihan_ganda_kompleks' ? 'selected' : '' }}>Pilihan
                                Ganda Kompleks</option>
                            <option value="menjodohkan"
                                {{ $isEdit && $data->jenis_soal == 'menjodohkan' ? 'selected' : '' }}>Menjodohkan</option>
                            <option value="uraian_singkat"
                                {{ $isEdit && $data->jenis_soal == 'uraian_singkat' ? 'selected' : '' }}>Uraian Singkat
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Pertanyaan -->
                <div class="row mb-4">
                    <label for="pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-sm-10">
                        <textarea name="pertanyaan" class="summernote">{{ $isEdit ? $data->pertanyaan : '' }}</textarea>
                    </div>
                </div>

                <!-- Pilihan A-E -->
                <div class="pilihan-section">
                    @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                        <div class="row mb-4">
                            <label for="pilihan_{{ $opt }}" class="col-sm-2 col-form-label">Pilihan
                                ({{ strtoupper($opt) }})
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pilihan_{{ $opt }}"
                                    value="{{ $isEdit ? $data->{'pilihan_' . $opt} : '' }}"
                                    placeholder="Masukkan Pilihan ({{ strtoupper($opt) }})">
                            </div>
                        </div>
                    @endforeach

                    <!-- Kunci Jawaban -->
                    <div class="row mb-4 d-flex align-items-center">
                        <label class="col-sm-2 col-form-label">Kunci Jawaban</label>
                        <div class="col-sm-10" id="kunciJawabanContainer">
                            <!-- Akan diisi oleh JS -->
                        </div>
                    </div>
                </div>

                <!-- Jawaban Uraian -->
                <div class="uraian-section" style="display: none;">
                    <div class="row mb-4">
                        <label for="jawaban_uraian" class="col-sm-2 col-form-label">Jawaban Uraian</label>
                        <div class="col-sm-10">
                            <textarea name="jawaban_uraian" class="form-control">{{ $isEdit ? $data->uraian ?? '' : '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Menjodohkan -->
                <div class="menjodohkan-section" style="display: none;">
                    <div class="row mb-4">
                        <label for="menjodohkan" class="col-sm-2 col-form-label">Pasangan Soal</label>
                        <div class="col-sm-10">
                            <textarea name="menjodohkan" class="form-control" placeholder="Pernyataan...">{{ $isEdit ? $data->pencocokan ?? '' : '' }}</textarea>
                            <small class="form-text text-muted">Tulis 1 option jawaban saja. Pada halaman ujian, option
                                jawaban akan digabung dengan jenis soal menjodohkan lainnya lalu diacak.</small>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ url('/admin/matapelajaran') }}" class="btn btn-warning ml-2">Kembali ke Daftar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function toggleJenisSoalFields() {
            const jenis = document.getElementById('jenisSoal').value;
            const pilihanSection = document.querySelector('.pilihan-section');
            const uraianSection = document.querySelector('.uraian-section');
            const menjodohkanSection = document.querySelector('.menjodohkan-section');
            const kunciJawabanContainer = document.getElementById('kunciJawabanContainer');

            pilihanSection.style.display = 'none';
            uraianSection.style.display = 'none';
            menjodohkanSection.style.display = 'none';
            kunciJawabanContainer.innerHTML = '';

            if (jenis === 'pilihan_ganda' || jenis === 'pilihan_ganda_kompleks') {
                pilihanSection.style.display = 'block';

                let html = '';
                const options = ['a', 'b', 'c', 'd', 'e'];

                options.forEach(opt => {
                    const label = opt.toUpperCase();
                    const isEdit = @json($isEdit);
                    const jenisSoal = @json($isEdit ? $data->jenis_soal : '');
                    const kunciJawaban = @json($isEdit ? $data->kunci_jawaban : '');

                    let checked = '';
                    if (isEdit && kunciJawaban) {
                        if (jenis === 'pilihan_ganda_kompleks') {
                            try {
                                let kunciArray = typeof kunciJawaban === 'string' ? JSON.parse(kunciJawaban) :
                                    kunciJawaban;
                                if (Array.isArray(kunciArray) && kunciArray.includes(opt)) {
                                    checked = 'checked';
                                }
                            } catch (e) {}
                        } else if (jenis === 'pilihan_ganda') {
                            if (kunciJawaban === opt) {
                                checked = 'checked';
                            }
                        }
                    }

                    if (jenis === 'pilihan_ganda') {
                        html += `
                            <div class="form-check form-check-inline mr-4">
                                <input class="form-check-input" type="radio" name="kunci_jawaban" id="pilih${label}" value="${opt}" ${checked}>
                                <label class="form-check-label" for="pilih${label}">${label}</label>
                            </div>
                        `;
                    } else {
                        html += `
                            <div class="form-check form-check-inline mr-4">
                                <input class="form-check-input" type="checkbox" name="kunci_jawaban[]" id="pilih${label}" value="${opt}" ${checked}>
                                <label class="form-check-label" for="pilih${label}">${label}</label>
                            </div>
                        `;
                    }
                });

                kunciJawabanContainer.innerHTML = html;
            } else if (jenis === 'uraian_singkat') {
                uraianSection.style.display = 'block';
            } else if (jenis === 'menjodohkan') {
                menjodohkanSection.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('jenisSoal').addEventListener('change', toggleJenisSoalFields);
            toggleJenisSoalFields(); // Initialize
        });

        $(".summernote").summernote({
            dialogsInBody: true,
            minHeight: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ]
        });
    </script>
@endsection
