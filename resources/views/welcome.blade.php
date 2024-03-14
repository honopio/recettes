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
                //make this h2 a href pointing to " http://localhost:8000/recettes/une_recette", /une_recette/ being the url of the recipe
                <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
                <p class="subtitle has-text-grey">{{ $recipe->content }}</p>
                <a href="#">Read More</a>
                </div>

            @endforeach

        </div>

    @endif

@endsection
