// a form webpage where the administrator can create a new recipe and save it in the database
// the form contains fields for the title, content, ingredients, and price of the recipe
@extends('layouts/main')

@section('title', 'Admin Create Recette')

@section('content')
    <div class="container">
        <h1>Create Recipe</h1>
        <form action="{{ route('recipes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients</label>
                <textarea name="ingredients" id="ingredients" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

