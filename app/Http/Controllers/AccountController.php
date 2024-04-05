<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Income;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        return view('accounts.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatoe = Validator::make($request->all(), [
            'acc_name' => 'required',
            'amount' => 'required|numeric',
        ]);
        if ($validatoe->fails()) {
            return redirect('/accounts/create')->withErrors($validatoe->errors())->withInput();
        }
        $request['user_id'] = Auth::id();
        Account::create($request->all());
        return redirect('/accounts')->withSuccess('Account created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $account = Account::find($id);
        $incomes = Income::where('account_id', $account->id)->get();
        return view('accounts.show', ['account' => $account, 'incomes' => $incomes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', ['account' => $account]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $validator = Validator::make($request->all(), [
            'acc_name' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails() || $account->user_id != Auth::id()) {
            return redirect()->back()->withErrors('$validator->errors()')->withInput();
        }

        $account->acc_name = $request->acc_name;
        $account->amount = $request->amount;
        $account->updated_at = now();
        $account->save();

        return redirect('/accounts')->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        if ($account->user_id != Auth::id()) {
            return redirect()->back()->withErrors('You are not allowed to delete this account');
        }
        $account->delete();
        return redirect('/accounts')->with('success', 'Account deleted successfully');
    }
}
