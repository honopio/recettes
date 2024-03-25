@extends('layouts/main')

@section('content')

    <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Recipes with Tag: {{ $tagInfo }}</h1>
    <br>


    @if ($recipes->isEmpty())
        <p>No recipes found with the tag "{{ $tagInfo }}"</p>
    @else
        <div class="columns is-multiline">

            @foreach ($recipes as $recipe)

                <div class="column is-4 mb-5">
                    <span><small class="has-text-grey-dark">{{ $recipe->updated_at }}</small></span>
                    <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">
                        <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
                    </a>
                    <p class="subtitle has-text-grey"><em>par {{ $recipe->user->name }}</em></p>
                    <p class="subtitle has-text-grey"><strong>Ingredients : {{ $recipe->ingredients }}</strong></p>
                    <p class="subtitle has-text-grey">{{ $recipe->content }}</p>
                    <a class="has-text-grey-dark" href="{{ url('recettes/' . $recipe->url) }}">Read More</a>
                </div>

            @endforeach

        </div>

    @endif

@endsection
