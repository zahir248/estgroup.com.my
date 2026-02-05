<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::create([
            'image' => 'Asset-9@4x.png',
            'name' => 'Mohd Akif Shamsudin',
            'title' => 'Managing Director',
            'bio' => "Mohd Akif Shamsudin a self-made entrepreneur with vast years of experience in the field of architecture and business leadership with deep knowledge of project development, construction, property development planning and renewable energy.\n\nA visionary leadership with technical background in business analytics and an Initiator and problem-solver using creativity, resourcefulness, and assets to break down and overcome organizational obstacles.\n\nA result driven, self-motivated and resourceful managing director with a proven ability to develop and strengthen management teams in order to maximize company profitability and efficiency.\n\nExperienced leading and growing all sectors of a business to make it a dynamic and progressive organization. Possessing excellent communication skills and able to establish sustainable and profitable relationships with customers, suppliers and stakeholders internationally.",
            'sort_order' => 0,
        ]);
    }
}
