// a form webpage where the administrator can edit a recipe and save the modifications in the database
@extends('layouts/main')

@section('title', 'Admin Edit Recette')

@section('content')
    <div class="container">
        <h1>Modifier la Recette</h1>

        <form method="POST" action="{{ route('update', $recipe->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group
            ">
                <label for="title" class="subtitle has-text-grey">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $recette->title }}" required>
            </div>
            <br>

            <div class="form-group">
                <label for="content" class="subtitle has-text-grey">content</label>
                <textarea name="content" id="content" class="form-control message-textarea" required rows="5">{{ $recette->content }}</textarea>
            </div>
            <br>

            <div class="form-group">
                <label for="ingredients" class="subtitle has-text-grey">Ingrédients</label>
                <textarea name="ingredients" id="ingredients" class="form-control message-textarea" required rows="5">{{ $recette->ingredients }}</textarea>
            </div>
            <br>

            <div class="form-group">
                <label for="price" class="subtitle has-text-grey">Prix</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $recette->price }}" required>
            </div>
            <br>
