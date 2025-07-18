@extends('layouts.app')

@section('title')
    Latihan Kuis
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <strong>Timer Ujian</strong>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/jenis-ujian/update') }}" method="POST">
                @csrf
                <div class="row align-items-end">
                    @foreach ($jenisUjian as $ujian)
                        <div class="col-md-4">
                            <label for="nama_{{ $ujian->id }}" class="form-label">{{ $ujian->nama }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $ujian->nama }}" readonly>
                                <input type="number" class="form-control" id="timer_{{ $ujian->id }}"
                                    name="timer[{{ $ujian->id }}]" value="{{ $ujian->timer }}" required>
                                <span class="input-group-text">menit</span>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ url('/admin/kuis/create', []) }}" class="btn btn-primary mb-4">
                Tambah Data
            </a>
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Pertanyaan</th>
                            <th class="text-left">Materi</th>
                            <th class="text-left">Jenis Soal</th>
                            <th class="text-left">Jenis Ujian</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($soals as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">{!! $item->pertanyaan !!}</td>
                                <td class="text-left">{!! optional($item->materi)->nama ?? '-' !!}</td>
                                <td class="text-left">{!! $item->jenis_soal ?? '-' !!}</td>
                                <td class="text-left">{!! $item->jenis_ujian ?? '-' !!}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('/admin/kuis/' . $item->id . '/edit', []) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ url('/admin/kuis/' . $item->id) }}" class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-{{ $item->id }}').submit();">
                                            Hapus
                                        </a>
                                    </div>
                                    <form id="delete-{{ $item->id }}" action="{{ url('/admin/kuis/' . $item->id) }}"
                                        method="POST" class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".datatable").dataTable();
    </script>
@endsection
