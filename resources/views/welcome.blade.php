@extends('layouts/main')
@section('content')

    <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Les 3 dernières recettes : </h1>
    <br>

    @if ( $recipes->isEmpty() )
        <p>No recipe found</p>

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
                {{-- cherche dans la table user la colonne name. possible pcq on a defini la relation entre recipe et user dans les modeles --}}
                <p class="subtitle has-text-grey"><em>par {{ $recipe->user->name }}</em></p>

                {{-- display la liste des ingredients --}}
                <p class="subtitle has-text-grey"><strong><em>Ingredients</em></strong> : {{ $recipe->ingredients }}</p>

                {{-- display le contenu de la recette --}}
                <p class="subtitle has-text-grey">{{ $recipe->content }}</p>

                {{-- display les tags. si pas de tags, affiche "pas de tags" --}}
                <p class="subtitle has-text-grey">
                    <strong><em>Tags</em></strong> :
                    @if ($recipe->tags->isEmpty())
                        <em>pas de tags</em>
                    @else
                        @foreach ($recipe->tags as $tag)
                            <span class="tag">{{ $tag->name }}</span>
                        @endforeach
                    @endif
                </p>

                {{-- href vers l'url de la recette. lien rendu gris au lieu de bleu --}}
                <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">Read More</a>
                </div>

            @endforeach

        </div>

    @endif

@endsection
