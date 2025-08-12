@extends('layouts.app')
@section('title','Browse Hotels')
@section('content')
<h1 style="font-size:1.5rem;font-weight:700;margin:.5rem 0 1rem;">Find your next stay</h1>

<form method="GET" action="{{ route('hotels.index') }}" class="card" style="padding:1rem;margin-bottom:1rem;">
  <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:.8rem;">
    <div><label class="label">Location</label>
      <input class="input" name="location" placeholder="e.g. Valencia" value="{{ old('location',$filters['location'] ?? '') }}">
    </div>
    <div><label class="label">Min Price</label>
      <input class="input" type="number" step="0.01" name="min_price" value="{{ old('min_price',$filters['min_price'] ?? '') }}">
    </div>
    <div><label class="label">Max Price</label>
      <input class="input" type="number" step="0.01" name="max_price" value="{{ old('max_price',$filters['max_price'] ?? '') }}">
    </div>
    <div><label class="label">Min Rating</label>
      <input class="input" type="number" min="0" max="5" step="0.1" name="min_rating" value="{{ old('min_rating',$filters['min_rating'] ?? '') }}">
    </div>
  </div>
  <div style="margin-top:.8rem;">
    <button class="btn btn-primary" type="submit">Search</button>
    <a class="btn" href="{{ route('hotels.index') }}">Reset</a>
  </div>
</form>

@if($hotels->count())
  <div class="grid grid-3">
    @foreach($hotels as $hotel)
    <div class="card">
      @if($hotel->image)<img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" style="width:100%;height:180px;object-fit:cover;">@endif
      <div style="padding:.9rem;">
        <h3 style="margin:0 0 .25rem;">{{ $hotel->name }}</h3>
        <p style="margin:.1rem 0;color:#6b7280;">{{ $hotel->location }}</p>
        @if($hotel->rating)<p>⭐ {{ number_format($hotel->rating,1) }}</p>@endif
        <p style="margin:.4rem 0;color:#374151;">Rooms: {{ $hotel->rooms_count }}</p>
        <a class="btn btn-primary" href="{{ route('hotels.show',$hotel) }}">View details</a>
      </div>
    </div>
    @endforeach
  </div>
  <div style="margin-top:1rem;">{{ $hotels->links() }}</div>
@else
  <p>No hotels found. Try adjusting your filters.</p>
@endif
@endsection
