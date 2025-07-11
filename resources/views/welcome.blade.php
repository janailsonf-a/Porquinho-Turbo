<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Porquinho Turbo - Seu Gerenciador Financeiro</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
<div class="relative min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full mx-auto p-6 lg:p-8">
        <div class="flex flex-col md:flex-row bg-white dark:bg-gray-800 shadow-2xl rounded-lg overflow-hidden">

            <div class="w-full md:w-1/2 p-8 text-gray-800 dark:text-gray-100">
                <h1 class="text-3xl font-bold mb-4">🐷 Porquinho Turbo</h1>
                <p class="mb-6 text-gray-600 dark:text-gray-400">
                    Assuma o controle total das suas finanças. De forma simples, rápida e inteligente.
                </p>
                <ul class="list-disc list-inside space-y-2">
                    <li>Registe as suas receitas e despesas</li>
                    <li>Visualize o seu fluxo de caixa</li>
                    <li>Tome decisões financeiras mais inteligentes</li>
                </ul>
            </div>

            <div class="w-full md:w-1/2 p-8 bg-gray-50 dark:bg-gray-800/50">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Acessar à sua conta</h2>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Senha</label>
                        <input id="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Lembre-se de mim') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                            Não tem uma conta?
                        </a>

                        <button type="submit" class="ms-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            {{ __('Entrar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
