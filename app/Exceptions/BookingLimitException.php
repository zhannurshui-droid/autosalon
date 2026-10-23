<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingLimitException extends Exception
{
    public function __construct(public int $limit)
    {
        parent::__construct(__('Active bookings limit exceeded (:limit)', ['limit' => $limit]));
    }

    public function report(): void
    {
        Log::channel('bookings')->warning($this->getMessage(), ['user_id' => auth()->id()]);
    }

    public function render(Request $request)
    {
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => $this->getMessage()], 409);
        }

        return back()->withInput()->with('error', $this->getMessage());
    }
}