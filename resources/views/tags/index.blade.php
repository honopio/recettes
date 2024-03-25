@extends('layouts/main')

@section('content')

    <h1 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Liste des tags</h1>
    <p class="has-text-grey-dark is-size-5">Cliquez sur un tag pour voir les recettes!</p>
    <br><br>

    @if ($tags->isEmpty())
        <p>Pas de tags</p>
    @else
        <div class="columns is-multiline">

            <div>
                <ul class="has-text-grey-dark">
                    @foreach ($tags as $tag)
                    <li>
                        <a href="{{ url('tags/' . $tag->name) }}" class="has-text-grey-dark">
                            <h4 class="is-size-5 has-text-weight-bold">{{ $tag->name }}</h4>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    @endif
@endsection
