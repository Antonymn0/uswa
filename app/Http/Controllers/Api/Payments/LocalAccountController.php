<?php

namespace App\Http\Controllers\Api\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LocalAccount;
use App\Models\TrialLesson;
use App\Http\Requests\Payments\ValidateLocalAccountRequest;

class LocalAccountController extends Controller
{
    /**
     * -----------------------------------------------------------------------------------------
    * | THIS CONTROLLER HANDLES ALL ACCOUNT RELATED ACTIONS FOR USERS LOCAL ACCOUNT
    * | THE LOCAL ACCOUNT MENTAINS USER ACCOUNT INFORMATION ON USWA LOCAL ACCOUNT
    * | PAYMENTS MADE BY USER GO INTO USWA STRIP ACCOUNT BUT ARE RECORDED IN LOCAL ACCOUNT 
    * | SO AS TO MANAGE LOCAL PAYMENTS BETWEEN STUDENT AND TUTORS
    * | TRANSACTIONS HISTORY STORE ALL HISTORY TRANSACTION RECORDS
    * |-------------------------------------------------------------------------------------
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = LocalAccount::paginate(env('API_PAGINATION', 20));
        return response()->json([
            'success'=> true,
            'message' => 'A list of accounts',
            'data'=>$lesson
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
                'user_id' => ['required', 'integer'],
                'date_created' => ['required', 'date'],
                'balance_before' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
                'available_balance' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/']
            ]);

        $account= LocalAccount::create($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Local account created successfuly',
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
        $account = LocalAccount::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Áccount retrieved successfully', 
            'data'=>$account], 200);
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

        $account = LocalAccount::findOrFail($id);
        $account -> update($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Account updated successfuly',
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
        $account = LocalAccount::findOrFail($id);
        $account -> delete();

        return response()->json([
            'success'=> true,
            'message'=> 'Account deleted successfuly',
            'data' => $lesson,
            ],  200);
    }

    /**
     * Get user account balance
     */
    public function getAccountBalance(Request $request){

        $account = LocalAccount::where('user_id', $request->user()->id )->first();
        return response()->json([
            'success' => true,
            'message' => 'local Account fetched',
            'data' => $account
        ],200);
    }

    /**
     * transfer funds from student to tutor in local account
    */
    public function transferFundsFromStudentToTutor(Request $request){
        $trial_lesson = json_decode($request->trial_lesson);        
        
        $student_local_account = LocalAccount::where('user_id', $trial_lesson->student_id)->first();
        $tutor_local_account = LocalAccount::where('user_id', $trial_lesson->tutor_id)->first();

        if($student_local_account->available_balance < $trial_lesson->get_tutor->hourly_rate ) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient funds',
                'data' => false
            ],500);
            }
            
        //process payment  transfer in local account
        $student_data = [
            'last_transaction_date' => now(),
            'last_transaction_method' => 'Uswa:local',
            'last_amount_transacted' => $trial_lesson->get_tutor->hourly_rate,
            'balance_before' => $student_local_account->available_balance,
            'available_balance' => $student_local_account->available_balance - $trial_lesson->get_tutor->hourly_rate, //subtract amount
            'balance_after' => $student_local_account->available_balance - $trial_lesson->get_tutor->hourly_rate,
        ];
        $tutor_data = [
            'last_transaction_date' => now(),
            'last_transaction_method' => 'Uswa:local',
            'last_amount_transacted' => $trial_lesson->get_tutor->hourly_rate,
            'balance_before' => $tutor_local_account->available_balance,
            'available_balance' => $tutor_local_account->available_balance + $trial_lesson->get_tutor->hourly_rate, //add amount
            'balance_after' => $tutor_local_account->available_balance + $trial_lesson->get_tutor->hourly_rate,
        ];

        $trial_lesson  = TrialLesson::findOrfail($trial_lesson->id); //fetch fresh record to update
        
        //update accounts
        $trial_lesson->update([ 'is_student_impressed' => true ]);
        $student_local_account->update($student_data);
        $tutor_local_account->update($tutor_data);

        return response()->json([
            'success' => true,
            'message' => 'Success, funds trasfered locally from student to tutor.',
            'data' => true
        ], 200);

    }
}
