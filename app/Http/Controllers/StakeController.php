<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stake;
use Auth;

class StakeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.00000001',
        ]);

        $stake = new Stake();
        $stake->userId = Auth::id();
        $stake->amount = $request->amount;
        $stake->type = 'BTC';
        $stake->save();

        return redirect()->route('dashboard')->with('success', 'Stake created successfully!');
    }

    public function storeSol(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.00000001',
        ]);

        $stake = new Stake();
        $stake->userId = Auth::id();
        $stake->amount = $request->amount;
        $stake->type = 'SOL';
        $stake->save();

        return redirect()->route('soldashboard')->with('success', 'Stake created successfully!');
    }
}
