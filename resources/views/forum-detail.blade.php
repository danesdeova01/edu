@extends('layouts.web')

@section('title')
{{ $forum->judul }}
@endsection

@section('breadcrumb')
<div class="breadcrumb-item">Forum Diskusi</div>
<div class="breadcrumb-item">{{ $forum->judul }}</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="card" style="border-radius: 1rem">
            <div class="card-body">
                <h4 class="mb-3">{{ $forum->judul }}</h4>
                <p>{{ $forum->konten }}</p>
                <small class="text-muted">
                    Oleh {{ $forum->user->name }} | {{ $forum->created_at->diffForHumans() }}
                </small>
            </div>
        </div>
    </div>

    <div class="col-12 mb-3">
        <h5 class="mb-3">Balasan:</h5>
        @forelse($forum->replies as $reply)
        @php
        $isOwnReply = auth()->id() === $reply->user_id;
        @endphp
        <div class="d-flex mb-3 {{ $isOwnReply ? 'justify-content-end' : 'justify-content-start' }}">
            <div class="card"
                style="max-width: 75%; border-radius: 1rem; background-color: {{ $isOwnReply ? '#cce5ff' : '#f1f1f1' }}">
                <div class="card-body p-3">
                    <p class="mb-2">{{ $reply->konten }}</p>
                    <small class="text-muted">
                        Oleh {{ $isOwnReply ? 'Anda' : $reply->user->name }} | {{ $reply->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Belum ada balasan.</p>
        @endforelse
    </div>

    <div class="col-12 mt-4">
        <div class="card" style="border-radius: 1rem">
            <div class="card-body">
                <form method="POST" action="{{ url('forum/' . $forum->id, [])}}">
                    @csrf
                    <div class="form-group">
                        <label>Tambahkan Balasan</label>
                        <textarea name="konten" rows="3" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Balas</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection