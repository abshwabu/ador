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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Brand
            $table->string('company_name')->default('Adorn Trading PLC');
            $table->string('short_name')->nullable()->default('Adorn');
            $table->string('tagline')->nullable()->default('Design. Source. Deliver.');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Hero
            $table->string('hero_kicker')->nullable();
            $table->string('hero_heading_line1')->nullable();
            $table->string('hero_heading_line2')->nullable();
            $table->string('hero_heading_line3')->nullable();
            $table->text('hero_paragraph')->nullable();
            $table->string('hero_primary_button_text')->nullable();
            $table->string('hero_primary_button_link')->nullable();
            $table->string('hero_secondary_button_text')->nullable();
            $table->string('hero_secondary_button_link')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_badge_title')->nullable();
            $table->string('hero_badge_text')->nullable();

            // About
            $table->string('about_kicker')->nullable();
            $table->string('about_heading')->nullable();
            $table->text('about_body')->nullable();
            $table->string('about_image')->nullable();

            // Process
            $table->string('process_kicker')->nullable();
            $table->string('process_heading')->nullable();
            $table->text('process_intro')->nullable();

            // Team
            $table->string('team_kicker')->nullable();
            $table->string('team_heading')->nullable();
            $table->text('team_intro')->nullable();

            // Quote / CTA
            $table->string('quote_kicker')->nullable();
            $table->string('quote_heading')->nullable();
            $table->text('quote_text')->nullable();
            $table->string('quote_button_text')->nullable();
            $table->string('quote_button_link')->nullable();

            // Contact
            $table->string('contact_kicker')->nullable();
            $table->string('contact_heading')->nullable();
            $table->text('contact_intro')->nullable();
            $table->string('contact_company')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();

            // Footer
            $table->text('footer_about')->nullable();
            $table->string('footer_copyright')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
