@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                {{-- Header card --}}
                <div class="card-title">
                  <div class="d-flex align-items-center">
                    <h2>{{ $question->title }}</h2>
                    <div class="ml-auto">
                      <a href="{{ route('questions.index' )}}" class="btn btn-outline-secondary">Back to all questions</a>
                    </div>
                  </div>
                </div>

                <hr>
                {{-- Body card --}}
                <div class="media">
                  <div class="d-flex flex-column vote-controls">
                    <a title="This question is useful" 
                      class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                      onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit();"
                      >
                      <i class="fas fa-caret-up fa-3x"></i>
                    </a>
                    <form id="up-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote"  style="display: none" method="POST">
                        @csrf
                        <input type="hidden" value="1" name="vote">
                    </form>
                    <span class="votes-count">
                      {{ $question->votes_count }}
                    </span>
                    <a title="This question is not userful" 
                      class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                      onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit();"
                      >
                      <i class="fas fa-caret-down fa-3x"></i>
                    </a>
                    <form id="down-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote"  style="display: none" method="POST">
                        @csrf
                        <input type="hidden" value="-1" name="vote">
                    </form>
                    <a title="Click to mark as favorite question (or undo)" 
                      class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}"
                      onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();"
                      >
                      <i class="fas fa-star fa-1x"></i>
                      <span class="favorites-count">{{ $question->favorites_count }}</span>
                    </a>
                    <form id="favorite-question-{{ $question->id }}" action="/questions/{{$question->id}}/favorites"  style="display: none" method="POST">
                        @csrf
                        @if ($question->is_favorited)
                          @method('DELETE')
                        @endif
                    </form>
                  </div>
                  <div class="media-body">
                    {!! $question->body !!}
                    <div class="float-right mt-3">
                      <span class="text-muted">Question {{ $question->created_date }}</span>
                      <div class="media mt-2">
                        <a href="{{ $question->user->url}}" class="pr-2">
                          <img src="{{ $question->user->avatar}}" alt="avatar">
                        </a>
                        <div class="media-body mt-1">
                          <a href="{{ $question->user->url}}">{{ $question->user->name}}</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    @include('answers._index')
    @include('answers._create')
</div>
@endsection
