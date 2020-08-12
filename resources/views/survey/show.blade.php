@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $questionnaire->title }}</h1>

            <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}" method="post">
                @foreach($questionnaire->questions as $key => $questions)
                    <div class="card">
                        <div class="card-header"><strongg>{{ $key + 1 }}</strongg> {{ $questions->question }}</div>

                        <div class="card-body">
                            @error('responses.' . $key . '.answer_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <ul class="list-group">
                                @foreach($questions->answers as $answer)
                                    <label for="answer{{ $answer->id }}">
                                        <li class="list-group-item">
                                            <input type="hidden" class="mr-2" name="responses[{{ $key }}][question_id]" value="{{ $questions->id }}"/>

                                           <input type="radio" class="mr-2" name="responses[{{ $key }}][answer_id]"
                                                  id="answer{{ $answer->id }}" value="{{ $answer->id }}"
                                               {{ (old('responses.' . $key . '.answer_id') == $answer->id) ? 'checked' : '' }}/>
                                            {{ $answer->answer }}
                                        </li>
                                    </label>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>
                @endforeach
                @csrf

                    <div class="card">
                        <div class="card-header">Your Information</div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Your name:</label>
                                <input name="survey[name]" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                                <small id="nameHelp" class="form-text text-muted">Whats your name</small>
                                <p class="text-danger">@error('name') {{ $message }} @enderror </p>
                            </div>
                            <div class="form-group">
                                <label for="email">Your email</label>
                                <input name="survey[email]" type="text" class="form-control" id="purpose" aria-describedby="emailHelp" placeholder="Enter Email">
                                <small id="emailHelp" class="form-text text-muted">Your email please!.</small>
                                <p class="text-danger">@error('email') {{ $message }} @enderror </p>
                            </div>

                        </div>
                    </div>

                    <br>
                <button type="submit" class="btn btn-primary">Complete Survey</button>
            </form>
        </div>
    </div>
</div>
@endsection
