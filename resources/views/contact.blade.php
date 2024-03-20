@extends('layouts/main')

@section('title', 'Contact')

@section('content')

<style>
    .form-group {
        margin-bottom: 20px; /* Add space between each form group */
    }

    .subtitle {
        display: block;
    }

    .message-textarea {
        width: 80%; /* Set the width of the message textarea to 80% */
    }

    /* Optional: Adjust other styling as needed */
</style>
<h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Contact</h1>
<br>
<form method="POST" action="/contact">
    @csrf

    <div class="form-group">
        <label for="name" class="subtitle has-text-grey">Nom</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <br>
    <div class="form-group">
        <label for="email" class="subtitle has-text-grey">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <br>
    <div class="form-group">
        <label for="message" class="subtitle has-text-grey">Comment pouvons-nous vous aider?</label>
        <textarea name="message" id="message" class="form-control message-textarea" required rows="5"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Submit</button>
</form>
@endsection


