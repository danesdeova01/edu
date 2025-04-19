@extends('layouts.app')

@section('title')
    Kompetensi
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ $url }}" method="POST">
                @csrf @if ($isEdit)
                    @method('PUT')
                @endif
                <div class="row mb-4">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" class="summernote">{{ $data->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
