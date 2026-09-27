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
                'company_name' => 'Adorn Trading PLC',
                'short_name' => 'Adorn',
                'tagline' => 'Design. Source. Deliver.',
                'logo' => 'images/logo.png',
                'secondary_logo' => 'images/secondary-logo.png',
                'favicon' => null,

                // SEO
                'meta_title' => 'Adorn Trading PLC | Design. Source. Deliver.',
                'meta_description' => 'Adorn Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.',

                // Hero
                'hero_kicker' => 'Global Wholesale Furnishing',
                'hero_heading_line1' => 'Design.',
                'hero_heading_line2' => 'Source.',
                'hero_heading_line3' => 'Deliver.',
                'hero_paragraph' => 'Adorn Trading PLC brings premium interior finishing, furnishing and building-material solutions to Ethiopia through local project expertise and trusted global sourcing partnerships.',
                'hero_primary_button_text' => 'Explore Products',
                'hero_primary_button_link' => '#products',
                'hero_secondary_button_text' => 'Request a Quote',
                'hero_secondary_button_link' => '#contact',
                'hero_image' => 'images/hero.jpg',
                'hero_badge_title' => 'ADDIS ABABA · ETHIOPIA',
                'hero_badge_text' => 'Interior finishing • Procurement • Project management',
                'hero_card_1' => 'One-stop interior solutions',
                'hero_card_2' => 'Global sourcing model',
                'hero_card_3' => 'Local installation',
                'hero_card_4' => 'Project-focused support',

                // About
                'about_kicker' => 'About Adorn Trading PLC',
                'about_heading' => 'A local partner with a global supply vision.',
                'about_body' => 'Adorn Trading PLC is positioned as an Ethiopian interior finishing and design firm based in Addis Ababa, serving residential villas, commercial offices and multi-unit apartments.',
                'about_image' => 'images/about.jpg',
                'about_check_1_title' => 'Project Management',
                'about_check_1_text' => 'Client engagement, site measurements, floor plans and coordination.',
                'about_check_2_title' => 'Interior Fitting & Installation',
                'about_check_2_text' => 'Local physical assembly and installation for completed projects.',
                'about_check_3_title' => 'Global Procurement',
                'about_check_3_text' => 'Factory sourcing, container consolidation and international supply coordination.',

                // Solutions Partner Card
                'solutions_partner_title' => 'One coordinated project journey.',
                'solutions_partner_text' => 'We support luxury private villas, real-estate developer mock-up apartments, boutique hotels and commercial offices with dedicated architectural consultation, material selection, and end-to-end execution.',
                'solutions_partner_btn_text' => 'Discuss Your Project →',
                'solutions_partner_btn_link' => '#contact',

                // Global Supply Network
                'network_kicker' => 'Global Supply Network',
                'network_heading' => 'Built around a local-to-global delivery model.',
                'network_intro' => 'Adorn Trading PLC connects Ethiopian builders and developers with direct global manufacturing, securing factory-direct B2B pricing, dedicated account management, material sample kits, and end-to-end supply coordination.',
                'network_card_1_title' => 'Ethiopia',
                'network_card_1_text' => 'Client engagement, site work, customs and installation',
                'network_card_2_title' => 'Global',
                'network_card_2_text' => 'Manufacturing, design support and supply coordination',
                'network_card_3_title' => 'B2B',
                'network_card_3_text' => 'Wholesale sourcing and project-based procurement',
                'network_card_4_title' => 'Turnkey',
                'network_card_4_text' => 'Full-scope delivery from sourcing to installation',

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
                'contact_intro' => 'Send your project type, location, drawings or material requirements. Adorn Trading PLC can coordinate the next step.',
                'contact_company' => 'Adorn Trading PLC',
                'contact_address' => 'Addis Ababa, Ethiopia',
                'contact_phone' => '+251 9… / +251 7…',
                'contact_email' => 'info@adorntrading.com',

                // Footer
                'footer_about' => 'Design. Source. Deliver. Premium interior finishing, procurement and project support for Ethiopia.',
                'footer_copyright' => '© 2026 Adorn Trading PLC. All rights reserved.',
            ]
        );
    }
}
