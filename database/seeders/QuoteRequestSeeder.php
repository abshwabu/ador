<?php

namespace Database\Seeders;

use App\Models\QuoteRequest;
use Illuminate\Database\Seeder;

class QuoteRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = [
            [
                'full_name' => 'Dr. Michael Tadesse',
                'company' => 'Blue Nile Medical Center',
                'phone' => '+251 91 123 4567',
                'email' => 'dr.michael@bluenile.com',
                'project_type' => 'Commercial Office',
                'message' => 'We are outfitting a new 4-story medical center in Bole. Looking for turnkey supply of interior partitions, acoustic ceilings, high-durability floor tiles, and custom executive consultation desks.',
                'status' => QuoteRequest::STATUS_NEW,
                'admin_notes' => null,
                'created_at' => now()->subHours(3),
            ],
            [
                'full_name' => 'Sara Alemayehu',
                'company' => 'Private Residence',
                'phone' => '+251 92 234 5678',
                'email' => 'sara.alem@gmail.com',
                'project_type' => 'Private Villa',
                'message' => 'Building a luxury G+2 villa in CMC. Need complete imported kitchen cabinetry with island quartz countertops, master walk-in wardrobe casework, and modern sanitary ware packages.',
                'status' => QuoteRequest::STATUS_CONTACTED,
                'admin_notes' => 'Called client on phone. Requested architectural floor plan and elevation drawings for kitchen layout.',
                'created_at' => now()->subDay(),
            ],
            [
                'full_name' => 'Yonas Kebede',
                'company' => 'Apex Real Estate Developments',
                'phone' => '+251 93 345 6789',
                'email' => 'yonas@apexrealestate.et',
                'project_type' => 'Apartment / Real Estate',
                'message' => 'Developing 48 apartment units near Kazanchis. Requesting wholesale container pricing and BOQ estimate for standardized modular kitchen cabinets, porcelain tiles, and aluminium door systems.',
                'status' => QuoteRequest::STATUS_IN_PROGRESS,
                'admin_notes' => 'Sent preliminary material sample catalog and container pricing schedule. Follow-up meeting scheduled for Tuesday.',
                'created_at' => now()->subDays(2),
            ],
        ];

        foreach ($quotes as $quote) {
            QuoteRequest::firstOrCreate(
                ['phone' => $quote['phone']],
                $quote
            );
        }
    }
}
