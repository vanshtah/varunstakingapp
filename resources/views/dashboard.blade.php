<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('BTC Staking') }}
            </h2>

            <div class="space-x-4">
                <button id="openModal" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600">
                    Deposit
                </button>

                <button id="openModalStake" class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-600">
                    Stake
                </button>
            </div>
        </div>
    </x-slot>

    <!-- <div class="container mx-auto p-4">
        <button id="openModal" class="fixed right-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600">
            Deposit 
        </button>
    </div> -->

    <div id="modalBackdrop" class="fixed inset-0 bg-gray-800 bg-opacity-15 hidden flex items-center justify-center">
        <!-- Modal container -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-120"> <!-- Increased width to w-120 -->
            <!-- Modal header -->
            <div class="flex justify-between items-center p-4 bg-blue-500 text-white">
                <h2 class="text-lg font-semibold">Bitcoin Address</h2>
                <button id="closeModal" class="text-white hover:text-gray-300">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="p-6">
                <div class="flex flex-col items-center space-y-4">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <img src="https://www.bitcoinqrcodemaker.com/api/?style=bitcoin&amp;address=bc1qmduxlt7v72uhuduyq4dy6q3y4c0r69ykwe4rw0" alt="QR Code" class="w-32 h-32">
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-semibold">bc1qmduxlt7v72uhuduyq4dy6q3y4c0r69ykwe4rw0</p>
                        <button id="copyButton" class="mt-2 bg-green-500 text-white py-1 px-4 rounded-lg shadow-md hover:bg-green-600" data-clipboard-text="1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa">
                            Copy Address
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalBackdropStake" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-1/3">
            <div class="flex justify-between items-center p-4 bg-blue-500 text-white">
                <h2 class="text-lg font-semibold">Create Stake</h2>
                <button id="closeModalStake" class="text-white hover:text-gray-300">&times;</button>
            </div>
            <div class="p-6">
                <form id="stakeForm" method="POST" action="{{ route('stakes.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700">Amount (BTC)</label>
                        <input id="amount" type="number" step="any" max="{{ $availBalance }}" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autofocus>
                        @error('amount')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="available_btc" class="block text-gray-700">Available BTC</label>
                        <input id="available_btc" type="text" class="form-control" name="available_btc" value="{{ $availBalance }}" disabled>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="antialiased font-sans">
                <div class="mx-auto m-8 grid grid-cols-3 gap-4">
                    <div class="pl-1 col-span-1 bg-blue-400 rounded-lg shadow-md">
                        <div class="flex w-full h-20 py-2 px-4 bg-white rounded-lg justify-between">
                            <div class="my-auto">
                                <p class="font-bold">Total BTC</p>
                                <p class="text-lg">{{number_format($totalBalance, 4)}}</p>
                            </div>
                            <div class="my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <!-- Monthly card start -->
                    <div class="pl-1 col-span-1 bg-green-400 rounded-lg shadow-md">
                        <div class="flex w-full h-20 py-2 px-4 bg-white rounded-lg justify-between">
                            <div class="my-auto">
                                <p class="font-bold">Available BTC</p>
                                <p class="text-lg">{{number_format($availBalance, 4)}}</p>
                            </div>
                            <div class="my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <!-- Monthly card end -->

                    <!-- Annual card start -->
                    <div class="pl-1 col-span-1 bg-yellow-500 rounded-lg shadow-md">
                        <div class="flex w-full h-20 py-2 px-4 bg-white rounded-lg justify-between">
                            <div class="my-auto">
                                <p class="font-bold">Staked BTC</p>
                                <p class="text-lg">{{ number_format($stakedata->sum('amount'), 4)}}</p>
                            </div>
                            <div class="my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <!-- Annual card end -->
                </div>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-10">
        <div class="max-w-7xl bg-white shadow-lg rounded-lg mx-auto p-6 mb-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-12 w-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V7h2v2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-xl font-semibold text-gray-900">Active Stakes</div>
                    <div class="text-gray-500">Details of active stakings.</div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">ID</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Amount</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Interest</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Days count</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Created on</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <!-- Test Data Row 1 -->
                    @foreach($stakedata as $stake)
                    <tr>
                        <td class="w-1/6 py-3 px-4 text-left">STK{{ str_pad($stake->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="w-1/6 py-3 px-4 text-left">{{ number_format($stake->amount, 4) }} BTC</td>
                        <td class="w-1/6 py-3 px-4 text-left">{{ number_format(($stake->amount * 0.2 / 365 * $stake->created_at->diffInDays()), 4)}} BTC</td>
                        <td class="w-1/6 py-3 px-4 text-left">{{ number_format($stake->created_at->diffInDays(), 0) }} Days</td>
                        <td class="w-1/6 py-3 px-4 text-left">{{ date_format($stake->created_at, 'Y-m-d')}}</td>
                        <td class="w-1/6 py-3 px-4 text-left"><span class="bg-green-500 text-white rounded-full py-1 px-3 text-xs">Active</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-10">
        <div class="max-w-7xl bg-white shadow-lg rounded-lg mx-auto p-6 mb-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-12 w-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V7h2v2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <div class="text-xl font-semibold text-gray-900">Daily Returns</div>
                    <div class="text-gray-500">Details of daily returns on staking.</div>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">ID</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Stake ID</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Daily Return</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Date</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <!-- Test Data Row 1 -->
                    @foreach($dailyreturns as $dailyreturn)
                    <tr>
                        <td class="w-1/6 py-3 px-4 text-left">DRS{{ str_pad($dailyreturn->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="w-1/6 py-3 px-4 text-left">STK{{ str_pad($dailyreturn->stake_id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="w-1/6 py-3 px-4 text-left">{{ number_format($dailyreturn->daily_return, 2) }} BTC</td>
                        <td class="w-1/6 py-3 px-4 text-left">{{ $dailyreturn->date }}</td>
                        <td class="w-1/6 py-3 px-4 text-left"><span class="bg-green-500 text-white rounded-full py-1 px-3 text-xs">Added</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $dailyreturns->links() }}
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openModalBtn = document.getElementById('openModal');
        const closeModalBtn = document.getElementById('closeModal');
        const modalBackdrop = document.getElementById('modalBackdrop');

        openModalBtn.addEventListener('click', () => {
            console.log('Open modal button clicked');
            modalBackdrop.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            console.log('Close modal button clicked');
            modalBackdrop.classList.add('hidden');
        });
    });

    // Clipboard.js integration
    document.addEventListener('DOMContentLoaded', () => {
        const copyButton = document.getElementById('copyButton');
        copyButton.addEventListener('click', () => {
            const textToCopy = copyButton.getAttribute('data-clipboard-text');
            navigator.clipboard.writeText(textToCopy).then(() => {
                console.log('Copied to clipboard');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        });
    });

    document.getElementById('openModalStake').addEventListener('click', function () {
        document.getElementById('modalBackdropStake').classList.remove('hidden');
        document.getElementById('modalBackdropStake').classList.add('flex');
    });

    document.getElementById('closeModalStake').addEventListener('click', function () {
        document.getElementById('modalBackdropStake').classList.remove('flex');
        document.getElementById('modalBackdropStake').classList.add('hidden');
    });
</script>