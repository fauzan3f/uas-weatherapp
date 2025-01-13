<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment Confirmations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left">User</th>
                                    <th class="px-6 py-3 text-left">Amount</th>
                                    <th class="px-6 py-3 text-left">Method</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                    <th class="px-6 py-3 text-left">Date</th>
                                    <th class="px-6 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr class="border-b">
                                    <td class="px-6 py-4">{{ $payment->user->name }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-6 py-4">{{ $payment->payment_method }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-sm
                                            @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($payment->status === 'confirmed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $payment->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        @if($payment->status === 'pending')
                                        <button onclick="updateStatus('{{ $payment->id }}', 'confirmed')" 
                                            class="bg-green-500 text-white px-3 py-1 rounded mr-2 hover:bg-green-600">
                                            Confirm
                                        </button>
                                        <button onclick="updateStatus('{{ $payment->id }}', 'rejected')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Reject
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateStatus(paymentId, status) {
            fetch(`/admin/payments/${paymentId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }
    </script>
</x-app-layout>
