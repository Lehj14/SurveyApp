@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new question') }}</div>

                <div class="card-body">
                   <form action="/questionnaires/{{ $questionnaire->id }}/questions" method="post">

                       <div class="form-group">
                           <label for="title">Question:</label>
                           <input name="question[question]" type="text" value="{{ old('question.question') }}" class="form-control" id="question" aria-describedby="questionHelp" placeholder="Enter Question">
                           <small id="questionHelp" class="form-text text-muted">Ask simple questions.</small>
                           <p class="text-danger">@error('question.question') {{ $message }} @enderror </p>
                       </div>
                       <div class="form-group">
                           <fieldset>
                               <legend>Choices</legend>
                               <small id="choicesHelp" class="form-text text-muted">Give choices</small>

                               <div>
                                   <div class="form-group">
                                       <label for="answer1">Choice 1:</label>
                                       <input name="answers[][answer]"  value="{{ old('answers.0.answer') }}" type="text" class="form-control" id="answer1" aria-describedby="choicesHelp" placeholder="Enter Choice 1">
                                       <p class="text-danger">@error('answers.0.answer') {{ $message }} @enderror </p>
                                   </div>
                               </div>

                               <div>
                                   <div class="form-group">
                                       <label for="answer2">Choice 2:</label>
                                       <input name="answers[][answer]" value="{{ old('answers.1.answer') }}" type="text" class="form-control" id="answer2" aria-describedby="choicesHelp" placeholder="Enter Choice 2">
                                       <p class="text-danger">@error('answers.1.answer') {{ $message }} @enderror </p>
                                   </div>
                               </div>

                               <div>
                                   <div class="form-group">
                                       <label for="answer3">Choice 3:</label>
                                       <input name="answers[][answer]" value="{{ old('answers.2.answer') }}" type="text" class="form-control" id="answer3" aria-describedby="choicesHelp" placeholder="Enter Choice 3">
                                       <p class="text-danger">@error('answers.2.answer') {{ $message }} @enderror </p>
                                   </div>
                               </div>

                               <div>
                                   <div class="form-group">
                                       <label for="answer4">Choice 3:</label>
                                       <input name="answers[][answer]" value="{{ old('answers.3.answer') }}" type="text" class="form-control" id="answer4" aria-describedby="choicesHelp" placeholder="Enter Choice 4">
                                       <p class="text-danger">@error('answers.3.answer') {{ $message }} @enderror </p>
                                   </div>
                               </div>
                           </fieldset>
                       </div>
                       <button type="submit" class="btn btn-primary">Add question</button>
                       @csrf
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
