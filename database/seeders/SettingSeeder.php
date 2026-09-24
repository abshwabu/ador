<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                // Brand
                'company_name' => 'Adron Trading PLC',
                'short_name' => 'Adron',
                'tagline' => 'Design. Source. Deliver.',
                'logo' => 'images/logo.png',
                'favicon' => null,

                // SEO
                'meta_title' => 'Adron Trading PLC | Design. Source. Deliver.',
                'meta_description' => 'Adron Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.',

                // Hero
                'hero_kicker' => 'Global Wholesale Furnishing',
                'hero_heading_line1' => 'Design.',
                'hero_heading_line2' => 'Source.',
                'hero_heading_line3' => 'Deliver.',
                'hero_paragraph' => 'Adron Trading PLC brings premium interior finishing, furnishing and building-material solutions to Ethiopia through local project expertise and trusted global sourcing partnerships.',
                'hero_primary_button_text' => 'Explore Products',
                'hero_primary_button_link' => '#products',
                'hero_secondary_button_text' => 'Request a Quote',
                'hero_secondary_button_link' => '#contact',
                'hero_image' => 'images/hero.jpg',
                'hero_badge_title' => 'ADDIS ABABA · ETHIOPIA',
                'hero_badge_text' => 'Interior finishing • Procurement • Project management',

                // About
                'about_kicker' => 'About Adron Trading PLC',
                'about_heading' => 'A local partner with a global supply vision.',
                'about_body' => 'Adron Trading PLC is positioned as an Ethiopian interior finishing and design firm based in Addis Ababa, serving residential villas, commercial offices and multi-unit apartments.',
                'about_image' => 'images/about.jpg',

                // Process
                'process_kicker' => 'How We Work',
                'process_heading' => 'A clear five-step workflow.',
                'process_intro' => 'From architectural layout review and detailed quotations to factory production QC and on-site installation in Ethiopia.',

                // Team
                'team_kicker' => 'Leadership & Partners',
                'team_heading' => 'Local leadership with global execution.',
                'team_intro' => 'Founded by Abdulhamid Sherefa Negashe and Ayub Nuredin Negashe, combining on-the-ground Ethiopian project execution with direct international manufacturing partnerships.',

                // Quote / CTA
                'quote_kicker' => 'Showroom & Design Hub',
                'quote_heading' => 'Experience the materials before you build.',
                'quote_text' => 'Our Addis Ababa showroom concept is designed to bring kitchens, wardrobes, tiles, sanitary ware, aluminium systems, lighting, furniture and material samples together with consultation and design support.',
                'quote_button_text' => 'Plan a Showroom Visit',
                'quote_button_link' => '#contact',

                // Contact
                'contact_kicker' => 'Start a Project',
                'contact_heading' => 'Tell us what you are building.',
                'contact_intro' => 'Send your project type, location, drawings or material requirements. Adron Trading PLC can coordinate the next step.',
                'contact_company' => 'Adron Trading PLC',
                'contact_address' => 'Addis Ababa, Ethiopia',
                'contact_phone' => '+251 9… / +251 7…',
                'contact_email' => 'info@adrontrading.com',

                // Footer
                'footer_about' => 'Design. Source. Deliver. Premium interior finishing, procurement and project support for Ethiopia.',
                'footer_copyright' => '© 2026 Adron Trading PLC. All rights reserved.',
            ]
        );
    }
}
