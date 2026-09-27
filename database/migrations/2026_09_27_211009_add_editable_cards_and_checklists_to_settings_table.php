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
        Schema::table('settings', function (Blueprint $table) {
            // Hero Feature Cards
            $table->string('hero_card_1')->nullable()->default('One-stop interior solutions');
            $table->string('hero_card_2')->nullable()->default('Global sourcing model');
            $table->string('hero_card_3')->nullable()->default('Local installation');
            $table->string('hero_card_4')->nullable()->default('Project-focused support');

            // About Section Checklist Items
            $table->string('about_check_1_title')->nullable()->default('Project Management');
            $table->text('about_check_1_text')->nullable();
            $table->string('about_check_2_title')->nullable()->default('Interior Fitting & Installation');
            $table->text('about_check_2_text')->nullable();
            $table->string('about_check_3_title')->nullable()->default('Global Procurement');
            $table->text('about_check_3_text')->nullable();

            // Solutions Partner Card
            $table->string('solutions_partner_title')->nullable()->default('One coordinated project journey.');
            $table->text('solutions_partner_text')->nullable();
            $table->string('solutions_partner_btn_text')->nullable()->default('Discuss Your Project →');
            $table->string('solutions_partner_btn_link')->nullable()->default('#contact');

            // Global Supply Network Cards
            $table->string('network_kicker')->nullable()->default('Global Supply Network');
            $table->string('network_heading')->nullable()->default('Built around a local-to-global delivery model.');
            $table->text('network_intro')->nullable();
            $table->string('network_card_1_title')->nullable()->default('Ethiopia');
            $table->text('network_card_1_text')->nullable();
            $table->string('network_card_2_title')->nullable()->default('Global');
            $table->text('network_card_2_text')->nullable();
            $table->string('network_card_3_title')->nullable()->default('B2B');
            $table->text('network_card_3_text')->nullable();
            $table->string('network_card_4_title')->nullable()->default('Turnkey');
            $table->text('network_card_4_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_card_1', 'hero_card_2', 'hero_card_3', 'hero_card_4',
                'about_check_1_title', 'about_check_1_text',
                'about_check_2_title', 'about_check_2_text',
                'about_check_3_title', 'about_check_3_text',
                'solutions_partner_title', 'solutions_partner_text',
                'solutions_partner_btn_text', 'solutions_partner_btn_link',
                'network_kicker', 'network_heading', 'network_intro',
                'network_card_1_title', 'network_card_1_text',
                'network_card_2_title', 'network_card_2_text',
                'network_card_3_title', 'network_card_3_text',
                'network_card_4_title', 'network_card_4_text',
            ]);
        });
    }
};
