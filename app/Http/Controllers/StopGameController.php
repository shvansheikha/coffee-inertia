<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class StopGameController extends Controller
{
    public function __invoke(Order $order): RedirectResponse
    {
        $this->authorize('update', $order);

        abort_unless(
            $order->orderable_type == get_class(new Game),
            403,
            "Can't Stop!!!");

        $order->stopped_at = now();
        $from = $order->started_at;
        $to = $order->stopped_at;
        $diff = $to->diffInMinutes($from);
        $order->price = round($diff * $order->amount);
        $order->save();

        return redirect()->route('orders.show', ['basket' => $order->basket_id]);
    }
}
