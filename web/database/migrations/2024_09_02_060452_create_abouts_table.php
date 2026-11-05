<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            // About Us Section

            $table->string('about_heading')->nullable();
            $table->longText('about_description')->nullable();
            $table->string('about_img_1_path')->nullable();
            $table->string('about_img_1_name')->nullable();
            $table->string('about_img_2_path')->nullable();
            $table->string('about_img_2_name')->nullable();

            // Vision & Mission Section

            $table->string('vision_heading')->nullable();
            $table->longText('vision_description')->nullable();
            $table->string('vision_icon_path')->nullable();
            $table->string('vision_icon_name')->nullable();


            $table->string('mission_heading')->nullable();
            $table->longText('mission_description')->nullable();
            $table->string('mission_icon_path')->nullable();
            $table->string('mission_icon_name')->nullable();

            // Personal Journey Section

            $table->string('journey_heading')->nullable();
            $table->longText('journey_description')->nullable();
            $table->string('journey_img_path')->nullable();
            $table->string('journey_img_name')->nullable();
            $table->string('linkedin_url')->nullable();

            // Guidance Section

            $table->string('guidance_heading')->nullable();
            $table->longText('guidance_description')->nullable();
            $table->string('guidance_img_path')->nullable();
            $table->string('guidance_img_name')->nullable();

             // Acknowledgment Section

             $table->string('acknow_heading')->nullable();
             $table->longText('acknow_description')->nullable();
             
            //  Strategic Goals Section
            $table->string('strategic_heading')->nullable();
        
            $table->string('created_ip_address')->nullable();
            $table->string('modified_ip_address')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('modified_by')->nullable();
            $table->enum('status', ['active', 'delete', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
