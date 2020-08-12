@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new questionnaire') }}</div>

                <div class="card-body">
                   <form action="/questionnaires" method="post">

                       <div class="form-group">
                           <label for="title">Title:</label>
                           <input name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter Title">
                           <small id="titleHelp" class="form-text text-muted">Give your questionnaire a title.</small>
                           <p class="text-danger">@error('title') {{ $message }} @enderror </p>
                       </div>
                       <div class="form-group">
                           <label for="purpose">Purpose</label>
                           <input name="purpose" type="text" class="form-control" id="purpose"  aria-describedby="purposeHelp" placeholder="Enter Purpose">
                           <small id="purposeHelp" class="form-text text-muted">Give your questionnaire a purpose.</small>
                           <p class="text-danger">@error('purpose') {{ $message }} @enderror </p>
                       </div>

                       <button type="submit" class="btn btn-primary">Create Questionnaire</button>

                       @csrf
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
