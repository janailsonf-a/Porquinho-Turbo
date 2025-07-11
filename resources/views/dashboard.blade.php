<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Você está logado!") }}
                </div>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Receitas</h4>
                        <p class="mt-1 text-3xl font-semibold text-green-500">
                            R$ {{ number_format($totalRevenue, 2, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total de Despesas</h4>
                        <p class="mt-1 text-3xl font-semibold text-red-500">
                            R$ {{ number_format($totalExpenses, 2, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Saldo Atual</h4>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">
                            R$ {{ number_format($balance, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Suas Transações</h3>
                <a href="{{ route('transactions.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700">
                    + Nova Transação
                </a>
            </div>
            <div class="mt-4 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Título</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoria</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Valor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $transaction->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $transaction->category->name ?? 'N/A' }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $transaction->type === 'revenue' ? 'text-green-500' : 'text-red-500' }}">
                                {{ $transaction->type === 'revenue' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $transaction->date->format('d/m/Y') }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Tem a certeza que quer apagar esta transação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Apagar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">
                                Nenhuma transação encontrada.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
