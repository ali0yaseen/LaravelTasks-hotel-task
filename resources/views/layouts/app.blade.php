<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title','Hotels')</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
body{font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial}
.container{max-width:1100px;margin:0 auto;padding:1rem}
.card{border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;background:#fff}
.grid{display:grid;gap:1rem}.grid-3{grid-template-columns:repeat(auto-fill,minmax(280px,1fr))}
.btn{display:inline-block;padding:.6rem .9rem;border-radius:10px;border:1px solid #111;text-decoration:none}
.btn-primary{background:#111;color:#fff}.input{width:100%;padding:.55rem .7rem;border-radius:10px;border:1px solid #d1d5db}
.label{font-size:.9rem;color:#374151}
</style></head><body>
<div class="container">
<header style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
<a href="{{ route('hotels.index') }}" style="text-decoration:none;color:#111;font-weight:700;font-size:1.2rem;">HotelFinder</a>
</header>@yield('content')</div></body></html>
