<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StakeController;
use Illuminate\Support\Facades\Route;
use App\Models\Stake;
use App\Models\DailyReturn;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
->name('login');

Route::get('/dashboard', function () {
    $stakedata = Stake::where('type', 'BTC')->get();
    $dailyreturns = DailyReturn::where('type', 'BTC')->orderBy('date', 'desc')->paginate(10);

    $totalBalance = 330;
    
    // Loop through each stake to calculate the total balance
    foreach ($stakedata as $stake) {
        // Calculate the interest for the current stake
        $days = $stake->created_at->diffInDays(now());
        $interest = $stake->amount * 0.2 / 365 * $days;
        
        // Add the stake amount and interest to the total balance
        // $totalBalance -= $stake->amount + $interest;
        $totalBalance += $interest;
    }
    $availBalance = $totalBalance - $stakedata->sum('amount');

    return view('dashboard',  compact('stakedata', 'dailyreturns', 'totalBalance', 'availBalance'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/stakes', [StakeController::class, 'store'])->name('stakes.store');
Route::post('/stakesSol', [StakeController::class, 'storeSol'])->name('stakes.storesol');

Route::get('/soldashboard', function () {
    $stakedata = Stake::where('type', 'SOL')->get();
    $dailyreturns = DailyReturn::where('type', 'SOL')->orderBy('date', 'desc')->paginate(10);

    $totalBalance = 280000;
    
    // Loop through each stake to calculate the total balance
    foreach ($stakedata as $stake) {
        // Calculate the interest for the current stake
        $days = $stake->created_at->diffInDays(now());
        $interest = $stake->amount * 0.2 / 365 * $days;
        
        // Add the stake amount and interest to the total balance
        // $totalBalance -= $stake->amount + $interest;
        $totalBalance += $interest;
    }
    $availBalance = $totalBalance - $stakedata->sum('amount');

    return view('sol',  compact('stakedata', 'dailyreturns', 'totalBalance', 'availBalance'));
})->middleware(['auth', 'verified'])->name('soldashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
