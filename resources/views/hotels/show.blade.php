@extends('layouts.app')
@section('title',$hotel->name)
@section('content')
<div class="card" style="overflow:hidden;">
  @if($hotel->image)<img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" style="width:100%;height:260px;object-fit:cover;">@endif
  <div style="padding:1rem;">
    <h1>{{ $hotel->name }}</h1>
    <p style="color:#6b7280">{{ $hotel->location }}</p>
    @if($hotel->rating)<p>⭐ {{ number_format($hotel->rating,1) }}</p>@endif
    @if($hotel->description)<p style="line-height:1.5;">{{ $hotel->description }}</p>@endif
    <h2 style="font-size:1.1rem;margin:1rem 0 .6rem;">Rooms</h2>
    @if($hotel->rooms->count())
      <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:.8rem;">
        @foreach($hotel->rooms as $room)
        <a class="btn btn-primary" href="{{ route('bookings.create', $room) }}">احجز الآن</a>
          <div class="card" style="padding:.9rem;">
            <h3>{{ $room->type }}</h3>
            <p>Capacity: {{ $room->capacity }}</p>
            <p style="font-weight:600;">${{ number_format($room->price,2) }} / night</p>
          </div>
        @endforeach
      </div>
    @else
      <p>No rooms listed for this hotel yet.</p>
    @endif
  </div>
</div>
@endsection
