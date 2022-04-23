<?php

namespace App\Http\Controllers\Api\Zoom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TrialLesson;
use App\Models\Lesson;
use App\Models\LessonPayment;
use Carbon\Carbon;

class ZoomWebhooksController extends Controller
{
   
    /**
     * Handle webhooks
    */
    public function handleWebhooks(Request $request){
        $verification_token = env('ZOOM_WEBHOOKS_VERIFICATION_TOKEN');

        switch ($request->event) {
            case 'meeting.created':
                $this->handleMeetingCreated($request);
                break;
            
            case 'meeting.updated':
                $this->handleMeetingUpdated($request);
                break;

            case 'meeting.deleted':
                $this->handleMeetingDeleted($request);
                break;
            case 'meeting.started':
                $this->handleMeetingStarted($request);
                break;
            case 'meeting.ended':
                $this->handleMeetingEnded($request);
                break;

            case 'meeting.participant_joined':
                $this->handleParticipantJoined($request);
                break;

            case 'meeting.participant_left':
               $this->handleParticipantLeft($request);
                break;
            
            default:
                # code...
                return;
        }
        
    }

    /**
     * Handle meeting created webhook event
     */
    public function handleMeetingCreated($request){
        $trial_lesson = TrialLesson::where('meeting_link', $request)->first();
        if(!empty($trial_lesson)){
            //
        }
        
    }

    /**
     * Handle meeting  updated webhook event
     */
    public function handleMeetingUpdated($request){

        // Log::info($request);
    }
    
    /**
     * Handle meeting  started webhook event
     */
    public function handleMeetingStarted($request){
        $trial_lesson = TrialLesson::where('meeting_id', $request->payload['object']['id'])->first();
        $lesson = Lesson::where('meeting_id', $request->payload['object']['id'])->first();

        if(! empty($trial_lesson)){
            $trial_lesson->update([
                'meeting_started_at' =>  date("Y-m-d H:i:s", ($request->event_ts / 1000) )
            ]);
        }
        if(! empty($lesson)){
            $data = [
                'lesson_id' => $lesson->id,
                'meeting_id' =>$request->payload['object']['id'],
                'meeting_uuid' => $request->payload['object']['uuid'],
                'meeting_started_at' => date("Y-m-d H:i:s", ($request->event_ts / 1000) ),               
                'paid' => false,
            ];
            
            $lesson_payment = LessonPayment::create($data);            
        }        
    }

    /**
     * Handle meeting  ended webhook event
     */
    public function handleMeetingEnded($request){
        $trial_lesson = TrialLesson::where('meeting_id', $request->payload['object']['id'])->first();
        $lesson = Lesson::where('meeting_id', $request->payload['object']['id'])->first();
        if(! empty($trial_lesson)){
            $trial_lesson->update([
                'meeting_ended_at' =>  date("Y-m-d H:i:s", ($request->event_ts / 1000) )
            ]);
        }        
        if(! empty($lesson)){
            $lesson_meeting = LessonPayment::where('meeting_uuid',  $request->payload['object']['uuid'])->first();

            $data =['meeting_ended_at' => date("Y-m-d H:i:s", ($request->event_ts / 1000) ) ];         

            $lesson_meeting->update($data); // update record       
        }        
    }

    /**
     * Handle meeting  participant joined webhook event
     */
    public function handleParticipantJoined($request){
        $trial_lesson = TrialLesson::where('meeting_id', $request->payload['object']['id'])->first();
        $lesson = Lesson::where('meeting_id', $request->payload['object']['id'])->first();
        if(! empty($trial_lesson)){
            $trial_lesson->update([
                'participant_joined_at' =>  date("Y-m-d H:i:s", ($request->event_ts / 1000) )
            ]);
        }        
        if(! empty($lesson)){
            $lesson_meeting = LessonPayment::where('meeting_uuid',  $request->payload['object']['uuid'])->first();
            $data =[ 'participant_joined_at' =>  date("Y-m-d H:i:s", ($request->event_ts / 1000) ) ];
            $lesson_meeting->update($data); // update record
        }        
    }

    /**
    * Handle meeting  participant left webhook event
    */
    public function handleParticipantLeft($request){
        $trial_lesson = TrialLesson::where('meeting_id', $request->payload['object']['id'])->first();
        $lesson = Lesson::where('meeting_id', $request->payload['object']['id'])->first();
        if(! empty($trial_lesson)){
            $trial_lesson->update([
                'participant_left_at' => date("Y-m-d H:i:s", ($request->event_ts / 1000) )  ,
                'participant_left_meeting_reason' =>  $request->payload['object']['participant']['leave_reason']
            ]);
        }
        if(! empty($lesson)){
            $lesson_meeting = LessonPayment::where('meeting_uuid',  $request->payload['object']['uuid'])->first();

            $meeting_start = Carbon::parse( $lesson_meeting->participant_joined_at);
            $meeting_end = Carbon::parse( date("Y-m-d H:i:s", ($request->event_ts / 1000) ));
            $duration = $meeting_end->diffInMinutes($meeting_start) ;
            Log::info( $duration);
            $data =[
                'participant_left_at' => date("Y-m-d H:i:s", ($request->event_ts / 1000) )  ,
                'participant_left_reason' =>  $request->payload['object']['participant']['leave_reason'],
                'meeting_duration' => $duration
                ];
            $lesson_meeting->update($data); // update record
            
        }
    }

}
