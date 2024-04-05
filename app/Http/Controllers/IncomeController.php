<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Account;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = Income::where('user_id', Auth::id())->get();
        return view('incomes.index', ['incomes' => $incomes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userAccount = Account::where('user_id',  Auth::id())->get();
        return view('incomes.create', ['userAccount' => $userAccount]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'account_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect('/incomes/create')->withErrors($validator->errors())->withInput();
        }
        $request['user_id'] = Auth::id();
        Income::create($request->all());
        $account = Account::find($request['account_id']);
        $account->amount += $request['amount'];
        $account->save();
        return redirect('/incomes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        return view('incomes.show', ['income' => $income]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        $userAccount = Account::where('user_id', Auth::id())->get();
        return view('incomes.edit', ['income' => $income, 'userAccount' => $userAccount]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'account_id' => 'required|numeric',
        ]);
        if ($validator->fails() || $income->user_id != Auth::id()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $request['user_id'] = Auth::id();
        $income->update($request->all());
        return redirect('/incomes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        if ($income->user_id != Auth::id()) {
            return redirect()->back()->withErrors('You are not allowed to delete this income');
        }
        $income->delete();
        return redirect('/incomes')->with('success', 'income deleted successfully');
    }
}
