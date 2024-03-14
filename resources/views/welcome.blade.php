@extends('layouts/main')
@section('content')
    <h1>Home content</h1>

          {{-- <div class="columns is-multiline">
            <div class="column is-4 mb-5">
              <span><small class="has-text-grey-dark">10 jun 2021 19:40</small></span>
              <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Lorem ipsum dolor sit</h2>
              <p class="subtitle has-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
              <a href="#">Read More</a>
            </div>
            <div class="column is-4 mb-5">
              <span><small class="has-text-grey-dark">10 jun 2021 19:40</small></span>
              <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Lorem ipsum dolor sit</h2>
              <p class="subtitle has-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
              <a href="#">Read More</a>
            </div>
            <div class="column is-4 mb-5">
              <span><small class="has-text-grey-dark">10 jun 2021 19:40</small></span>
              <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold">Lorem ipsum dolor sit</h2>
              <p class="subtitle has-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
              <a href="#">Read More</a>
            </div>
          </div> --}}

          @if ( $recipes->isEmpty() )
              <p>No recipes found</p>

          @else

          @endif

          <ul>
            @foreach ( $recipes as $recipe )
             <li>{{ $recipe->title }}</li>
            @endforeach
          </ul>

@endsection
