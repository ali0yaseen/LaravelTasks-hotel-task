@extends('layouts.app')

@section('title', 'حجز غرفة')

@section('content')
  <div class="card" style="padding:1rem;">
    <h1 style="margin:0 0 .5rem;">حجز: {{ $room->hotel->name }} — {{ $room->type }}</h1>
    <p style="color:#6b7280;margin:.2rem 0 1rem;">
      الموقع: {{ $room->hotel->location }} • السعة: {{ $room->capacity }} • السعر: ${{ number_format($room->price,2) }}/ليلة
    </p>

    @if ($errors->any())
      <div style="border:1px solid #fecaca;background:#fee2e2;padding:.6rem;border-radius:10px;margin-bottom:.8rem;">
        @foreach ($errors->all() as $e)
          <div>{{ $e }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('bookings.store', $room) }}" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:.8rem;">
      @csrf
      <div>
        <label class="label">تاريخ الوصول</label>
        <input class="input" type="date" name="check_in" value="{{ old('check_in') }}" required>
      </div>
      <div>
        <label class="label">تاريخ المغادرة</label>
        <input class="input" type="date" name="check_out" value="{{ old('check_out') }}" required>
      </div>
      <div style="grid-column:1/-1; margin-top:.6rem;">
        <button class="btn btn-primary" type="submit">تأكيد الحجز</button>
        <a class="btn" href="{{ route('hotels.show', $room->hotel_id) }}">رجوع</a>
      </div>
    </form>
  </div>
@endsection
