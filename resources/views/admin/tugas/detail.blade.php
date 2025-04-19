@extends('layouts.app')

@section('title')
    Detail Submit Tugas
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">No Induk</th>
                            <th class="text-center">Nama </th>
                            <th class="text-center">Jawaban</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas->jawabans as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ $item->no_induk }}
                                </td>
                                <td class="text-center">
                                    {{ $item->nama }}
                                </td>
                                <td class="text-center">
                                    @if ($item->file_jawab == null)
                                        <span class="badge badge-secondary">
                                            <small>Tidak ada</small>
                                        </span>
                                    @else
                                        <a href="{{ asset('storage/jawaban/file/' . $item->file_jawab) }}"
                                            class="badge badge-info">
                                            <small>Download</small>
                                        </a>
                                    @endif
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
