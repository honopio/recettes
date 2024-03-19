@extends('layouts/main')

@section('title', 'Recette')

@section('content')

{{-- probablement pas de titre a afficher ?--}}
<h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold"></h1>
<br>

    <div class="columns is-multiline">
        {{-- classe is-offset-1 pour ajouter une margin a gauche, donc centrer le texte.
            classe is-10 : la div prend 10 colonnes de large sur 12--}}
        <div class="column is-offset-1 is-10">
            <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>
            {{-- href to the recipe url. link made grey instead of blue --}}
            <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
            </a>
            {{-- cherche dans la table user la colonne name.
                possible pcq on a defini la relation entre recipe et user dans les modeles --}}
            <p class="subtitle has-text-grey"><em>{{ $recipe->user->name }}</em></p>
            <p class="subtitle has-text-grey">{{ $recipe->content }}</p>
        </div>
    </div>

@endsection
