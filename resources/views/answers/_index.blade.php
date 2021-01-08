<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $question->answers_count . ' ' . str_plural('Answer', $question->answers_count) }}</h2>
                </div>
                <hr>
                @include('layouts._message')
                @foreach ($question->answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful" 
                                class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"
                                >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{$answer->id}}/vote"  style="display: none" method="POST">
                                @csrf
                                <input type="hidden" value="1" name="vote">
                            </form>
                            <span class="votes-count">
                            {{ $answer->votes_count }}
                            </span>
                            <a title="This answer is not userful" 
                                class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"
                                >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{$answer->id}}/vote"  style="display: none" method="POST">
                                @csrf
                                <input type="hidden" value="-1" name="vote">
                            </form>
                            @can('accept', $answer)
                                <a title="Mark this answer as best answer" 
                                class="{{ $answer->status}} mt-2"
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id}}').submit();"
                                >
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id)}}" method="POST" style="display: none">
                                    @csrf
                                </form>
                            @else
                                @if ($answer->is_best)
                                    <a title="Accept this answer as best answer" 
                                    class="{{ $answer->status}} mt-2"
                                    >
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body !!}
                            <div class="row">
                                <div class="col-4 mt-3">
                                    @can('update-answer', $answer)
                                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                            class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can('delete-answer', $answer)
                                        <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure')">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4 mt-3">
                                    <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" alt="avatar">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
