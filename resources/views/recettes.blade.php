@extends('layouts/main')
{{-- on décide de ne pas display de titre ici, vu qu'il y a deja le titre "Recettes" --}}
@section('title', '')

@section('content')


<h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Toutes les recettes : </h1>
<br>

@if ( $recipes->isEmpty() )
    <p>No recipes found</p>

@else
    <div class="columns is-multiline">

        {{-- for each recipe : --}}
        @foreach ( $recipes as $recipe )
            {{-- classe is-4 pour prendre la largeur de 4 colonnes sur 12, classe mb-5 pour la bottom margin --}}
            <div class="column is-4 mb-5">
            <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>
            {{-- href to the recipe url. link made grey instead of blue --}}
            <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
            </a>
            {{-- cherche dans la table user la colonne name.
                possible pcq on a defini la relation entre recipe et user dans les modeles --}}
                <p class="subtitle has-text-grey"><em>par {{ $recipe->user->name }}</em></p>
            {{-- display les 50 premiers mots de content, puis "...". il faut clicker sur Read more pour voir la suite--}}
            <p class= "subtitle has-text-grey">{{ Str::words($recipe->content, 50, '...') }}</p>

            {{-- href to the recipe url : /recettes/url. link made grey instead of blue --}}

            <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">Read More</a>
            </div>

        @endforeach

    </div>

@endif

@endsection
