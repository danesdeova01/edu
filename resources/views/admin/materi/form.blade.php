@extends('layouts.app')

@section('title')
    Form Topik
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
                    <label for="nama" class="col-sm-2 col-form-label">Nama Topik</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ $isEdit ? $data->nama : '' }}"
                            placeholder="Contoh: Aljabar Linier" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="matapelajaran_id" class="col-sm-2 col-form-label">Materi</label>
                    <div class="col-sm-10">
                        <select name="matapelajaran_id" class="form-control" required>
                            <option value="" selected>Silakan Pilih Materi</option>
                            @foreach ($matapelajaran as $item)
                                <option value="{{ $item->id }}"
                                    {{ $isEdit ? isSelected($data->matapelajaran_id, $item->id) : '' }}>{{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="konten" class="col-sm-2 col-form-label">Konten</label>
                    <div class="col-sm-10">
                        <textarea name="konten" class="summernote">{{ $isEdit ? $data->konten : '' }}</textarea>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="konten" class="col-sm-2 col-form-label">
                        File Topik <sup class="text-danger">*.pdf</sup>
                    </label>
                    <div class="col-sm-10">
                        <input name="file" type="file" @if (!$isEdit) required @endif />
                        @if ($isEdit)
                            <small class="form-text text-danger">
                                Kosongkan jika tidak ingin mengubah file topik
                            </small>
                        @else
                            <small class="form-text text-danger">
                                File harus berekstensi PDF
                            </small>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ url('/admin/topik', []) }}" class="btn btn-warning ml-2">Kembali ke Daftar</a>
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
