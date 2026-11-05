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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();

            // Home Banner Section

            $table->string('heading')->nullable();
            $table->text('sub_heading')->nullable();
            $table->string('play_link')->nullable();
            $table->string('app_link')->nullable();
            $table->string('banner_video_path')->nullable();
            $table->string('banner_video_name')->nullable();
            $table->string('you_tube_link')->nullable();

            // Banner Cards Section

            $table->string('card_heading_1')->nullable();
            $table->string('card_heading_2')->nullable();
            $table->string('card_heading_3')->nullable();
            $table->longText('card_description_1')->nullable();
            $table->longText('card_description_2')->nullable();
            $table->longText('card_description_3')->nullable();
    
            $table->string('card_icon_1_path')->nullable();
            $table->string('card_icon_1_name')->nullable();
            $table->string('card_icon_2_path')->nullable();
            $table->string('card_icon_2_name')->nullable();
            $table->string('card_icon_3_path')->nullable();
            $table->string('card_icon_3_name')->nullable();

            $table->string('card_image_1_path')->nullable();
            $table->string('card_image_1_name')->nullable();
            $table->string('card_image_2_path')->nullable();
            $table->string('card_image_2_name')->nullable();
            $table->string('card_image_3_path')->nullable();
            $table->string('card_image_3_name')->nullable();
     
           // About Us Section

           $table->string('about_heading')->nullable();
           $table->longText('about_description')->nullable();
           $table->string('about_video_path')->nullable();
           $table->string('about_video_name')->nullable();
           $table->string('about_image_path')->nullable();
           $table->string('about_image_name')->nullable();

           // Lessons Section

           $table->string('lessons_heading')->nullable();
           $table->longText('lessons_sub_heading')->nullable();

           // Founders Message Section
           
           $table->string('founders_heading')->nullable();
           $table->longText('founders_description')->nullable();
           $table->string('founders_image_path')->nullable();
           $table->string('founders_image_name')->nullable();

           // Podcasts Section

           $table->string('podcasts_heading')->nullable();
           $table->longText('podcasts_sub_heading')->nullable();

           // Jainism Additional Educational Resources Section

           $table->string('jain_edu_heading')->nullable();
           
             // Jainism Research and Academic Resources Section

            $table->string('jain_acd_heading')->nullable();

            // Testimonials Section

            $table->string('testimonials_heading')->nullable();

            // Blogs Section

            $table->string('blog_heading')->nullable();
            $table->longText('blog_sub_heading')->nullable();

            // Gallery Section

            $table->string('gallery_heading')->nullable();
         
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
        Schema::dropIfExists('homes');
    }
};
