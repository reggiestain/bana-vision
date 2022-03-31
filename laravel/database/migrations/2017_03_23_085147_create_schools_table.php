<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('address');
            $table->string('user_name');
            $table->string('user_slug');
            $table->string('web_url');
            $table->string('country');
            $table->string('suburb');
            $table->string('province');
            $table->string('district');
            $table->string('telephone');
            $table->string('about');
            $table->text('history');
            $table->string('principal');
            $table->integer('number_students');
            $table->integer('number_teachers');
            $table->string('k_12');
            $table->string('coeducational');
            $table->boolean('funding');
            $table->boolean('sector');
            $table->string('pass_rate');
            $table->boolean('special_needs');
            $table->string('area_code');
            $table->string('curriculumn_type');
            $table->string('bana_email_address');
            $table->string('bana_email_password');
            $table->string('natEmis');
            $table->string('province_cd');
            $table->string('status');
            $table->string('type_ped');
            $table->string('phase_ped');
            $table->string('specialization');
            $table->string('owner_land');
            $table->string('owner_buildings');
            $table->string('ex_dept');
            $table->string('pay_point_no');
            $table->string('component_no');
            $table->string('exam_no');
            $table->string('exam_centre');
            $table->string('new_lat');
            $table->string('new_long');
            $table->string('gis_source');
            $table->string('district_municipality_name');
            $table->string('local_municipality_name');
            $table->string('ward_id');
            $table->string('sp_code');
            $table->string('sp_name');
            $table->string('ei_district');
            $table->string('ei_circuit');
            $table->string('addressee');
            $table->string('township_village');
            $table->string('town_city');
            $table->string('street_address');
            $table->string('postal_address');
            $table->string('section21');
            $table->string('section21_funct');
            $table->string('quintile');
            $table->string('nas');
            $table->string('nodal_area');
            $table->string('registration_date');
            $table->string('no_fee_school');
            $table->string('allocation');
            $table->string('demarcation_from');
            $table->string('demarcation_to');
            $table->string('old_nat_emis');
            $table->string('new_nat_emis');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schools');
    }
}
