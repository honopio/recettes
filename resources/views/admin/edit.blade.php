{{-- a form webpage where the administrator can edit a recipe and save the modifications in the database --}}
@extends('layouts/main')

@section('title', 'modification de recette')

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

</style>

    <div class="container">
        <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Modifier la Recette</h1>

        <form method="POST" action="/admin/recettes/{{ $recipe->id }}">
            @csrf
            @method('PUT')

            <div class="form-group
            ">
                <label for="title" class="subtitle has-text-grey">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $recipe->title }}" required>
            </div>
            <br>

            <div class="form-group">
                <label for="content" class="subtitle has-text-grey">content</label>
                <textarea name="content" id="content" class="form-control message-textarea " required rows="5">{{ $recipe->content }}</textarea>
            </div>
            <br>

            <div class="form-group">
                <label for="ingredients" class="subtitle has-text-grey">Ingrédients</label>
                <textarea name="ingredients" id="ingredients" class="form-control message-textarea" required rows="5">{{ $recipe->ingredients }}</textarea>
            </div>
            <br>

            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Prix</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $recipe->price }}" required>
            </div>
            <br>
        </form>
    </div>
@endsection
