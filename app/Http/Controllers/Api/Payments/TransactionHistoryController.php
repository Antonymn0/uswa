<?php

namespace App\Http\Controllers\Api\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionHistory;
use App\Http\Requests\Payments\ValidateTransactionHistoryRequest;
use App\Events\Transaction\TransactionCreated;

class TransactionHistoryController extends Controller
{
    /**
     * |-------------------------------------------------------------------------------
     * | THIS CONTROLLER HANDLES ALL TRANSACTIONS HISTORY
     * | BOTH EXTERNAL AND INTERNAL TRANSACTIONS ARE RECORDED IN TRANSACTIONS HISTORY
     * |-----------------------------------------------------------------------------------
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = TransactionHistory::paginate(env('API_PAGINATION', 20));
        return response()->json([
            'success'=> true,
            'message' => 'A list of transactions history',
            'data'=>$lesson
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request\ValidateTransactionHistoryRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(ValidateTransactionHistoryRequest $request)
    {
        $data = $request->validated(); 
        $user = $request->user();

        $transaction = TransactionHistory::create($data);

        event(new TransactionCreated($transaction, $user));

        return response()->json([
            'success'=> true,
            'message'=> 'Transaction created successfuly',
            'data' => true,
            ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = TransactionHistoy::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single transaction retrieved successfully', 
            'data'=>$transaction], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validated(); 

        $transaction = TransactionHistory::findOrFail($id);
        $transaction -> update($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Transaction updated successfuly',
            'data' => $lesson,
            ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = TransactionHistory::findOrFail($id);

        $transactiop->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction successfully deleted',
            'data' => true
        ], 200);
    }

    /**
     * Get user transaction history
     */
    public function getHistory(Request $request){
        $transaction_history = TransactionHistory::where('user_id', $request->user()->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(env('API_PAGINATION', 20));

        return response()->json([
            'success' => true,
            'message' => "Transaction history fetched",
            'data'=> $transaction_history
        ], 200);
    }
}
