<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // Adicione este 'use'
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Calcular o total de receitas do utilizador logado
        $totalRevenue = Transaction::where('user_id', $userId)
            ->where('type', 'revenue')
            ->sum('amount');

        // Calcular o total de despesas do utilizador logado
        $totalExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        // Calcular o saldo
        $balance = $totalRevenue - $totalExpenses;

        // Pegar a lista de transações para a tabela (como já fazíamos)
        $transactions = auth()->user()->transactions()->latest()->get();

        // Retorna a view do dashboard, passando todos os novos dados para ela
        return view('dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalExpenses' => $totalExpenses,
            'balance' => $balance,
            'transactions' => $transactions,
        ]);
    }
}
