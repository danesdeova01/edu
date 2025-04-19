@extends('layouts.app')

@section('title')
    Form Soal Ujian
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ $url }}" method="POST">
                @csrf @if ($isEdit)
                    @method('PUT')
                @endif
                @php
                    function isChecked($data1, $data2)
                    {
                        if ($data1 == $data2) {
                            return 'checked';
                        }
                    }
                @endphp
                <div class="row mb-4">
                    <label for="pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-sm-10">
                        <textarea name="pertanyaan" class="summernote">{{ $isEdit ? $data->pertanyaan : '' }}</textarea>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="pilihan_a" class="col-sm-2 col-form-label">Pilihan (A)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pilihan_a"
                            value="{{ $isEdit ? $data->pilihan_a : '' }}" placeholder="Masukkan Pilihan (A)" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="pilihan_b" class="col-sm-2 col-form-label">Pilihan (B)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pilihan_b"
                            value="{{ $isEdit ? $data->pilihan_b : '' }}" placeholder="Masukkan Pilihan (B)" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="pilihan_c" class="col-sm-2 col-form-label">Pilihan (C)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pilihan_c"
                            value="{{ $isEdit ? $data->pilihan_c : '' }}" placeholder="Masukkan Pilihan (C)" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="pilihan_d" class="col-sm-2 col-form-label">Pilihan (D)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pilihan_d"
                            value="{{ $isEdit ? $data->pilihan_d : '' }}" placeholder="Masukkan Pilihan (D)" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="pilihan_e" class="col-sm-2 col-form-label">Pilihan (E)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pilihan_e"
                            value="{{ $isEdit ? $data->pilihan_e : '' }}" placeholder="Masukkan Pilihan (E)" required>
                    </div>
                </div>

                <div class="row mb-4 d-flex align-items-center">
                    <label for="pilihan_e" class="col-sm-2 col-form-label">Kunci Jawaban</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline mr-4">
                            <input class="form-check-input" type="radio" name="kunci_jawaban" id="pilihA"
                                value="a" {{ $isEdit ? isChecked($data->kunci_jawaban, 'a') : '' }}>
                            <label class="form-check-label" for="pilihA">A</label>
                        </div>
                        <div class="form-check form-check-inline mr-4">
                            <input class="form-check-input" type="radio" name="kunci_jawaban" id="PilihB"
                                value="b" {{ $isEdit ? isChecked($data->kunci_jawaban, 'b') : '' }}>
                            <label class="form-check-label" for="PilihB">B</label>
                        </div>
                        <div class="form-check form-check-inline mr-4">
                            <input class="form-check-input" type="radio" name="kunci_jawaban" id="pilihC"
                                value="c" {{ $isEdit ? isChecked($data->kunci_jawaban, 'c') : '' }}>
                            <label class="form-check-label" for="pilihC">C</label>
                        </div>
                        <div class="form-check form-check-inline mr-4">
                            <input class="form-check-input" type="radio" name="kunci_jawaban" id="pilihD"
                                value="d" {{ $isEdit ? isChecked($data->kunci_jawaban, 'd') : '' }}>
                            <label class="form-check-label" for="pilihD">D</label>
                        </div>
                        <div class="form-check form-check-inline mr-4">
                            <input class="form-check-input" type="radio" name="kunci_jawaban" id="pilihE"
                                value="e" {{ $isEdit ? isChecked($data->kunci_jawaban, 'e') : '' }}>
                            <label class="form-check-label" for="pilihE">E</label>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ url('/admin/matapelajaran', []) }}" class="btn btn-warning ml-2">Kembali ke Daftar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
