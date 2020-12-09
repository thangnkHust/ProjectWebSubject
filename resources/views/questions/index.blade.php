@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                  @foreach ($questions as $q)
                    <div class="media">
                      <div class="d-flex flex-column counters">
                        <div class="vote">
                          <strong>{{ $q->votes}}</strong> {{  str_plural('vote', $q->votes) }}
                        </div>
                        <div class="status {{ $q->status }}">
                          <strong>{{ $q->answers }}</strong> {{  str_plural('answer', $q->answers) }}
                        </div>
                        <div class="view">
                          {{ $q->views . " " . str_plural('view', $q->views) }}
                        </div>
                      </div>
                      <div class="media-body">
                        <h3 class="mt-0"><a href="{{$q->url}}">{{ $q->title}}</a></h3>
                        <p class="lead">
                          Asked by <a href="{{$q->user->url}}">{{ $q->user->name }}</a>
                          <small class="text-muted">{{ $q->created_date }}</small>
                        </p>
                        {{ str_limit($q->body, 250)}}
                      </div>
                    </div>
                    <hr>
                  @endforeach
                  <div class="text-center"> 
                    {{ $questions->links()}}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
