@extends('layouts/main')
@section('content')

    <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Les 3 dernières recettes : </h1>
    <br>

    @if ( $recipes->isEmpty() )
        <p>No recipes found</p>

    @else
        <div class="columns is-multiline">

            {{-- for the first 3 recipes : --}}
            @foreach ( $recipes->take(3) as $recipe )

                <div class="column is-4 mb-5">
                <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>
                {{-- href to the recipe url. link made grey instead of blue --}}
                <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                    <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
                </a>
                {{-- cherche dans la table user la colonne name.
                possible pcq on a defini la relation entre recipe et user dans les modeles --}}
                <p class="subtitle has-text-grey"><em>par {{ $recipe->user->name }}</em></p>
                {{-- display "ingredients : " et la liste des ingredients --}}
                <p class="subtitle has-text-grey"><strong>Ingredients : {{ $recipe->ingredients }}</strong></p>
                <p class="subtitle has-text-grey">{{ $recipe->content }}</p>
                <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">Read More</a>
                </div>

            @endforeach

        </div>

    @endif

@endsection
