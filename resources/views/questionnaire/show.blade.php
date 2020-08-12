@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $questionnaire->title }}</div>

                <div class="card-body">
                    <a class="btn btn-dark" href="/questionnaires/{{ $questionnaire->id }}/questions/create">Add new question</a>
                    <!--str string that help us do slug-->
                    <a class="btn btn-dark" href="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}">Take Survey</a>
                </div>
            </div>

            <br>

            @foreach($questionnaire->questions as $question)
                <div class="card">
                    <div class="card-header">{{ $question->question }}</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($question->answers as $answer)
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>{{ $answer->answer }}</div>
                                    @if($question->responses->count())
                                        <div>{{ (int) ($answer->responses->count() * 100 / $question->responses->count()) }} %</div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-footer">
                        <form method="post" action="/questionnaires/{{ $questionnaire->id }}/questions/{{ $question->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Delete Question</button>
                        </form>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
