@extends('layouts.app')

@section('title')
    Form Materi
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ $url }}" method="POST">
                @csrf @if ($isEdit)
                    @method('PUT')
                @endif
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Materi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ $isEdit ? $data->nama : '' }}"
                            placeholder="Contoh: Matematika" required>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ url('/admin/materi', []) }}" class="btn btn-warning ml-2">Kembali ke Daftar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
