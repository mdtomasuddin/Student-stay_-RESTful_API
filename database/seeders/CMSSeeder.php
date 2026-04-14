<?php
namespace Database\Seeders;

use App\Models\CMS;
use Illuminate\Database\Seeder;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'page'            => 'lettingAgentPage',
                'section'         => 'whoWeAre',
                'title'           => 'Who We Are',
                'sub_title'       => null,
                'description'     => 'AlenaGold Estates is the UK\'s leading student accommodation platform, connecting students with quality purpose-built student accommodation (PBSA) and houses in multiple occupancy (HMO) across the country.',
                'sub_description' => null,
                'image'           => null,
                'sub_image'       => null,
                'button'          => null,
                'sub_button'      => null,
                'tag'             => null,
                'cards'           => [
                    [
                        'icon'        => 'ri-user-heart-line',
                        'image'       => "https://images.unsplash.com/photo-1545693315-85b6be26a3d6?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                        'title'       => 'Student-Focused',
                        'description' => 'We understand student needs and match them with the perfect accommodation solution.',
                    ],
                    [
                        'icon'        => 'ri-line-chart-line',
                        'image'       => "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                        'title'       => 'Proven Track Record',
                        'description' => 'Over 10,000 successful student placements with our partner properties.',
                    ],
                    [
                        'icon'        => 'ri-shield-check-line',
                        'image'       => "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                        'title'       => 'Trusted Platform',
                        'description' => 'Verified properties and transparent processes ensure quality for students and partners.',
                    ],
                ],
                'status'          => 'active',
            ],
            [
                'page'            => 'lettingAgentPage',
                'section'         => 'generateDemand',
                'title'           => 'How We Generate Student Demand',
                'sub_title'       => null,
                'description'     => 'Our multi-channel approach ensures your properties reach the right students at the right time.',
                'sub_description' => null,
                'image'           => null,
                'sub_image'       => null,
                'button'          => null,
                'sub_button'      => null,
                'tag'             => null,
                'cards'           => [
                    [
                        'title'       => 'University Partnerships',
                        'description' => 'Direct relationships with top UK universities and student unions.',
                    ],
                    [
                        'title'       => 'Digital Marketing',
                        'description' => 'Targeted campaigns on social media, Google, and student platforms.',
                    ],
                    [
                        'title'       => 'Student Events',
                        'description' => 'Presence at freshers fairs, open days, and accommodation talks.',
                    ],
                    [
                        'title'       => 'Referral Network',
                        'description' => 'Student ambassadors and word-of-mouth recommendations drive organic growth.',
                    ],
                ],
                'status'          => 'active',
            ],
            [
                'page'            => 'lettingAgentPage',
                'section'         => 'whyProvidersChooseUs',
                'title'           => 'Why PBSA/HMO Providers Choose Us',
                'sub_title'       => null,
                'description'     => null,
                'sub_description' => null,
                'image'           => null,
                'sub_image'       => null,
                'button'          => null,
                'sub_button'      => null,
                'tag'             => null,
                'cards'           => [
                    [
                        'title'       => 'Maximize Occupancy',
                        'description' => 'Fill rooms faster with a qualified student pipeline and reduced vacancy periods.',
                    ],
                    [
                        'title'       => 'Reduce Marketing Costs',
                        'description' => 'Lower cost-per-booking through our optimized, performance-driven campaigns.',
                    ],
                    [
                        'title'       => 'Quality Tenants',
                        'description' => 'Verified student inquiries and guided matching for more reliable lets.',
                    ],
                    [
                        'title'       => 'Dedicated Support',
                        'description' => 'A responsive account team to support listings, leads, and conversions.',
                    ],
                    [
                        'title'       => 'Flexible Partnerships',
                        'description' => 'Custom collaboration models for independent landlords and large operators.',
                    ],
                    [
                        'title'       => 'Real-Time Analytics',
                        'description' => 'Actionable insights on demand, lead quality, and conversion performance.',
                    ],
                ],
                'status'          => 'active',
            ],
        ];

        foreach ($sections as $section) {
            CMS::updateOrCreate(
                [
                    'page'    => $section['page'],
                    'section' => $section['section'],
                ],
                [
                    'title'           => $section['title'],
                    'sub_title'       => $section['sub_title'],
                    'description'     => $section['description'],
                    'sub_description' => $section['sub_description'],
                    'image'           => $section['image'],
                    'sub_image'       => $section['sub_image'],
                    'button'          => $section['button'],
                    'sub_button'      => $section['sub_button'],
                    'tag'             => $section['tag'],
                    'cards'           => $section['cards'],
                    'status'          => $section['status'],
                ]
            );
        }
    }
}
