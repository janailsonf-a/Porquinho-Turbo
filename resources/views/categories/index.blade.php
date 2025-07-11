<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerir Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Adicionar Nova Categoria</h3>
                    <form method="POST" action="{{ route('categories.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome da Categoria</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600" required>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Suas Categorias</h3>
                <ul class="mt-4 space-y-2">
                    @forelse ($categories as $category)
                        <li class="flex items-center justify-between p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="text-gray-900 dark:text-gray-100">{{ $category->name }}</span>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Apagar esta categoria irá remover a associação de todas as transações ligadas a ela. Tem a certeza?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:text-red-900">Apagar</button>
                            </form>
                        </li>
                    @empty
                        <li class="text-gray-500 dark:text-gray-400">Nenhuma categoria criada ainda.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
