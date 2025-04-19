@extends('layouts.app')

@section('title')
    Daftar Tugas
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ url('/admin/tugas/create', []) }}" class="btn btn-primary mb-4">
                Tambah Data
            </a>
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Materi</th>
                            <th class="text-center">File Tugas</th>
                            <th class="text-center">Submit</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ $item->matapelajaran->nama }}
                                </td>
                                <td class="text-center">
                                    @if ($item->file == null)
                                        <span class="badge badge-secondary">
                                            <small>Tidak ada</small>
                                        </span>
                                    @else
                                        <a href="{{ asset('storage/tugas/file/' . $item->file) }}" class="badge badge-info">
                                            <small>Download</small>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $item->jawabans->count() }} Orang
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('/admin/tugas/' . $item->id, []) }}"
                                            class="btn btn-sm btn-success">Detail</a>
                                        <a href="{{ url('/admin/tugas/' . $item->id . '/edit', []) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ url('/admin/tugas/' . $item->id) }}" class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-{{ $item->id }}').submit();">
                                            Hapus
                                        </a>
                                    </div>
                                    <form id="delete-{{ $item->id }}" action="{{ url('/admin/tugas/' . $item->id) }}"
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
