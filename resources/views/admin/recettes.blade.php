@extends('layouts/main')

@section('title', 'Admin Recettes')

@section('content')
    <div class="container">
        <h1>Liste des Recettes</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Numéro utilisateur</th>
                    <th>Edition</th>
                    <th>Suppression</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recipes as $recette)
                    <tr>
                        <td>{{ $recette->title }}</td>
                        <td>{{ $recette->user_id }}</td>
                            <td>
                                <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                                <td>
                                    <a href="{{ route('recettes.destroy', $recette->id) }}" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this recette?')) { document.getElementById('delete-form-{{ $recette->id }}').submit(); }">
                                        Delete
                                    </a>
                                    <form id="delete-form-{{ $recette->id }}" action="{{ route('recettes.destroy', $recette->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                        </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('recettes.create') }}" class="btn btn-success">Add Recette</a>
    </div>
@endsection
