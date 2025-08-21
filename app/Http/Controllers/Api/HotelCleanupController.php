<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Hotel;

class HotelCleanupController extends Controller
{
  
    public function __invoke(Request $request)
    {
        $days = (int) $request->integer('days', 30);

        $deleted = DB::transaction(function () use ($days) {
       
            return Hotel::where('updated_at', '<', now()->subDays($days))->delete();
        });

        return response()->json([
            'status'  => 'ok',
            'deleted' => $deleted,
            'rule'    => "updated_at < now()-{$days}d",
        ]);
    }
}
