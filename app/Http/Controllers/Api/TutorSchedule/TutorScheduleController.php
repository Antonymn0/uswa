<?php

namespace App\Http\Controllers\Api\TutorSchedule;
use App\Http\Controllers\Controller;

use App\Models\TutorSchedule;
use App\Models\User;

class TutorScheduleController extends Controller
{
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTutorSheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( $user_id)    {
       
        $tutorSchedule = TutorSchedule::create([ 'user_id' => $user_id ]);

        return $tutorSchedule;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= TutorSchedule::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single user retrieved successfully', 
            'data'=>$user], 200);
    }

    /**
     * update resource in storage.
     *
     * @param  \App\Http\Requests\StoreTutorSheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($request, $user_id)
    {
        $availability = $this->getAvailability($request);
        $data =[
            'user_id' => $user_id,

            "monday" => $availability->monday->is_available,
            "monday_from" => $availability->monday->from,
            "monday_to" => $availability->monday->to,

            "tuesday" => $availability->tuesday->is_available,
            "tuesday_from" => $availability->tuesday->from,
            "tuesday_to" => $availability->tuesday->to,

            "wednesday" => $availability->wednesday->is_available,
            "wednesday_from" => $availability->wednesday->from,
            "wednesday_to" => $availability->wednesday->to,

            "thursday" => $availability->thursday->is_available,
            "thursday_from" => $availability->thursday->from,
            "thursday_to" => $availability->thursday->to,

            "friday" => $availability->friday->is_available,
            "friday_from" => $availability->friday->from,
            "friday_to" => $availability->friday->to,

            "saturday" => $availability->saturday->is_available,
            "saturday_from" => $availability->saturday->from,
            "saturday_to" => $availability->saturday->to,

            "sunday" => $availability->sunday->is_available,
            "sunday_from" => $availability->sunday->from,
            "sunday_to" => $availability->sunday->to,
        ];

        $tutorSchedule = TutorSchedule::where('user_id', $user_id)->first();

        $tutorSchedule ->update($data);

        return $tutorSchedule;
    }



    /**
     * Extract tutor availability
     */
    public function getAvailability($request){        

       return (object) [
            'monday' => json_decode($request->monday),
            'tuesday' => json_decode($request->tuesday),
            'wednesday' => json_decode($request->wednesday),
            'thursday' => json_decode($request->thursday),
            'friday' => json_decode($request->friday),
            'saturday' => json_decode($request->saturday),
            'sunday' => json_decode($request->sunday), 
        ];
        
    }
}
