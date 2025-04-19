@extends('layouts.app')

@section('title')
    Form Soal Ujian
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                @csrf @if ($isEdit)
                    @method('PUT')
                @endif
                @php
                    function isSelected($data1, $data2)
                    {
                        if ($data1 == $data2) {
                            return 'selected';
                        }
                    }
                @endphp
                <div class="row mb-4">
                    <label for="matapelajaran_id" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-10">
                        <select name="matapelajaran_id" class="form-control" required>
                            <option value="" selected>Silakan Pilih Mata Pelajaran</option>
                            @foreach ($matapelajaran as $item)
                                <option value="{{ $item->id }}"
                                    {{ $isEdit ? isSelected($data->matapelajaran_id, $item->id) : '' }}>{{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="konten" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-sm-10">
                        <textarea name="konten" class="summernote">{{ $isEdit ? $data->konten : '' }}</textarea>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="konten" class="col-sm-2 col-form-label">File Tugas</label>
                    <div class="col-sm-10">
                        <input name="file" type="file" />
                        <small class="form-text text-danger">
                            Kosongkan jika tidak ingin menambahkan atau mengubah file tugas
                        </small>
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
