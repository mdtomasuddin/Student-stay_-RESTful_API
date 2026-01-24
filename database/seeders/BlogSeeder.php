<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'      => 1,
                'category_id'  => 24,
                'title'        => 'Ultimate Guide to Finding Student Accommodation',
                'slug'         => 'ultimate-guide-to-finding-student-accommodation',
                'content'      => '
<p>Finding the perfect student accommodation can feel overwhelming, but it doesn\'t have to be. Whether you\'re a fresher looking for halls or a returning student hunting for a house share, this guide covers everything you need to know to make the right choice.</p>

<h3>Location, Location, Location</h3>
<p>Before you even start looking at properties, decide on your ideal location. Do you want to be close to campus to roll out of bed for 9 AM lectures? Or would you prefer a cheaper area slightly further out with better nightlife? Consider transport links and the cost of commuting.</p>

<h3>Budgeting Basics</h3>
<ul>
<li>Calculate your budget carefully. Remember that rent isn\'t your only expense. You\'ll need to factor in bills (gas, electricity, water, internet) if they aren\'t included, as well as groceries and socialising money.</li>
<li>Check if bills are included (many PBSA options include all bills)</li>
<li>Factor in the deposit and any agency fees</li>
<li>Consider the length of the contract (44 weeks vs 51 weeks)</li>
</ul>

<h3>Viewing Tips</h3>
<p>Never sign for a property without viewing it first (or at least taking a verified virtual tour). When viewing, look beyond the decor. Check for signs of damp, test the water pressure, and ask the current tenants about their experience.</p>

<h3>Understanding Contracts</h3>
<p>Read your tenancy agreement thoroughly. If there\'s anything you don\'t understand, ask the accommodation team or your university\'s housing advice service. Pay attention to clauses about guests, noise, and deposit returns.</p>
',
                'thumbnail'    => 'https://images.unsplash.com/photo-1768879051946-4984246ed043?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'is_featured'  => 1,
            ],
            [
                'user_id'      => 1,
                'category_id'  => 25,
                'title'        => '10 Tips to Boost Your Productivity While Working from Home',
                'slug'         => '10-tips-to-boost-your-productivity-while-working-from-home',
                'content'      => '
<p>Working from home can be a blessing, but it comes with its own challenges. Here are 10 tips to stay productive and maintain a healthy work-life balance.</p>

<ol>
<li>Set a dedicated workspace</li>
<li>Stick to a schedule</li>
<li>Take regular breaks</li>
<li>Minimize distractions</li>
<li>Use productivity tools</li>
<li>Prioritize tasks</li>
<li>Communicate regularly with your team</li>
<li>Keep meetings concise</li>
<li>Set boundaries with family or roommates</li>
<li>Reflect daily on progress and adjust your workflow accordingly</li>
</ol>
',
                'thumbnail'    => 'https://plus.unsplash.com/premium_photo-1767721104232-357575b597f6?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'is_featured'  => 0,
            ],
            [
                'user_id'      => 1,
                'category_id'  => 24,
                'title'        => 'The Beginner\'s Guide to Investing in Cryptocurrency',
                'slug'         => 'beginners-guide-to-investing-in-cryptocurrency',
                'content'      => '
<p>Cryptocurrency has become one of the most talked-about investment options. For beginners, it can seem complicated, but this guide breaks it down.</p>

<ul>
<li>Understand what cryptocurrency is</li>
<li>Learn about wallets and exchanges</li>
<li>Only invest money you can afford to lose</li>
<li>Diversify your portfolio</li>
<li>Stay updated with market news</li>
<li>Beware of scams and hype</li>
<li>Think long-term, don\'t chase instant profits</li>
<li>Track your performance regularly</li>
</ul>
',
                'thumbnail'    => 'https://images.unsplash.com/photo-1608725098147-c8f4d3581aae?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'is_featured'  => 0,
            ],
        ];


        foreach ($data as $city) {
            Blog::create($city);
        }
    }
}
