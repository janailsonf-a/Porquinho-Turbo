<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ainda não implementamos esta função
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Busca as categorias do utilizador logado para popular o seletor
        $categories = auth()->user()->categories;
        return view('transactions.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'type' => ['required', Rule::in(['revenue', 'expense'])],
            'date' => ['required', 'date'],
            'category_id' => ['nullable', 'exists:categories,id']
        ]);

        $validatedData['user_id'] = auth()->id();

        Transaction::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Transação salva com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        // Ainda não implementamos esta função
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        // Autorização
        if (auth()->user()->id !== $transaction->user_id) {
            abort(403);
        }
        // Busca as categorias para o seletor
        $categories = auth()->user()->categories;
        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        // 1. Autorização
        if (auth()->user()->id !== $transaction->user_id) {
            abort(403);
        }

        // 2. Validação (as mesmas regras da criação)
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'type' => ['required', Rule::in(['revenue', 'expense'])],
            'date' => ['required', 'date'],
            'category_id' => ['nullable', 'exists:categories,id']
        ]);

        // 3. Atualizar a transação no banco de dados
        $transaction->update($validatedData);

        // 4. Redirecionar de volta para o Dashboard
        return redirect()->route('dashboard')->with('success', 'Transação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // 1. Autorização: Verificar se o utilizador logado é o dono da transação
        if (auth()->user()->id !== $transaction->user_id) {
            abort(403); // Se não for, proíbe a ação.
        }

        // 2. Apagar a transação do banco de dados
        $transaction->delete();

        // 3. Redirecionar de volta para o Dashboard com uma mensagem de sucesso
        return redirect()->route('dashboard')->with('success', 'Transação apagada com sucesso!');
    }
}
