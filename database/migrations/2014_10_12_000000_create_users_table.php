<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
           $table->string('full_name')->required();
           $table->string('first_name')->required();
           $table->string('middle_name')->nullable();
           $table->string('last_name')->required();
           $table->string('username')->nullable()->unique();
           $table->string('email')->required();
           $table->string('role')->required();
           $table->string('password')->required();

           $table->string('phone')->nullable();
           $table->string('address')->nullable();
           $table->text('biography')->nullable();
           $table->string('id_number')->nullable();
           $table->dateTime('date_of_birth')->nullable();
           $table->string('city')->nullable();
           $table->string('country')->nullable();
           $table->string('country_code')->nullable();
           $table->string('nationality')->nullable();
           $table->string('postal_code')->nullable();

           $table->dateTime('phone_verified_at')->nullable();
           $table->dateTime('email_verified_at')->nullable();
           $table->dateTime('id_verified_at')->nullable();
           $table->dateTime('suspended_at')->nullable();
           $table->string('approved')->nullable();
           $table->dateTime('approved_at')->nullable();
           $table->dateTime('deleted_at')->nullable();
           $table->integer('approved_by')->nullable();
           $table->integer('registered_by')->nullable();
           $table->string('registration')->nullable();
           $table->integer('suspended_by')->nullable();
           $table->string('reason_suspended')->nullable();
           $table->string('image')->nullable();

           $table->string('timezone')->nullable();
           $table->string('local_timezone')->nullable();
           $table->string('currency')->nullable();
           $table->string('language')->nullable();
           $table->string('level')->nullable();
           $table->string('second_language')->nullable();
            $table->string('second_language_level')->nullable();
           $table->string('subject')->nullable();
           $table->string('subject_level')->nullable();
           $table->string('over18')->nullable();
           $table->text('description')->nullable();

           $table->string('teaching_certificate')->nullable();           
           $table->string('has_teaching_certificate')->nullable();           
           $table->string('teaching_certificate_upload')->nullable();
           $table->string('teaching_certificate_subject')->nullable();
           $table->string('teaching_certificate_year_of_study_from')->nullable();
           $table->string('teaching_certificate_year_of_study_to')->nullable();
           $table->text('teaching_certificate_description')->nullable();
           $table->string('teaching_certificate_issued_by')->nullable();

           $table->string('higher_education_institution')->nullable();
           $table->string('has_higher_education_certificate')->nullable();
           $table->string('higher_education_level')->nullable();
           $table->string('higher_education_study_from')->nullable();
           $table->string('higher_education_study_to')->nullable();
           $table->string('higher_education_type')->nullable();
           $table->string('higher_education_specialty')->nullable();
           $table->string('higher_education_certificate_upload')->nullable();
         
           $table->string('introduction_video')->nullable();
           $table->string('introduction_video_url')->nullable();

           $table->double('hourly_rate')->nullable();

           $table->string('zoom_linked')->nullable();
           $table->string('zoom_id')->nullable();

           $table->string('availability')->nullable();
           $table->text('revert_reason')->nullable();

           $table->string('stripe_account_id')->nullable()->unique();
           $table->string('stripe_account_type')->nullable();

           $table->string('paypal_merchant_id')->nullable();
           $table->string('paypal_consent_status')->nullable();
           $table->string('paypal_permissions_granted')->nullable();


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
