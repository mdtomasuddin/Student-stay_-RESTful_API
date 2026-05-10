<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\University;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //universities data
        $uni1 = University::create([
            'name'       => 'University of ABerdeen',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni2 = University::create([
            'name'       => 'University of Nottingham',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni3 = University::create([
            'name'       => 'University of Nottingham',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni4 = University::create([
            'name'       => 'University of Nottingham',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        $uni5 = University::create([
            'name'       => 'University of Nottingham',
            'distance'   => '1.4',
            'walk_time'  => '28',
            'cycle_time' => '7',
            'drive_time' => '6',
        ]);

        //property data
        $data = [
            [
                'user_id'         => 3,
                'title'           => 'Classic Plus Ensuite, Nottingham',
                'category_id'     => 3,
                'location'        => 'Nottingham',
                'city_id'         => 1,
                'full_address'    => "Curzon Street, St Ann's Well Road, Rainbow Quarter, Hockley, St Ann's, Nottingham, East Midlands, England, NG3 1DJ, United Kingdom",
                'price'           => 129.00,
                'duration_period' => 'per week',
                'available_from'  => '2026-08-31',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => "Exclusive AchGoldEstates Student Benefits 🎁\r\nOnly when booking through AchGoldEstates, you unlock access to the AGE Membership range of exclusive student perks, including:\r\n• Cashback offers\r\n• Free takeaways\r\n• Exclusive student discounts\r\n• Complimentary nightclub/event tickets\r\n• Student giveaways & rewards\r\n• …and much more\r\nIncluded through AchGoldEstates:\r\nYou’ll also gain access to our Nottingham Student Safety & Awareness Updates 📰 helping students stay informed about important local updates, safer areas and city information throughout the academic year.\r\nThese benefits are exclusively available through AchGoldEstates referrals.\r\n\r\nCurzon House Classic Plus Ensuite – Student Accommodation in Nottingham 2026/2027\r\nBills included! 💧🌐 Classic Plus Ensuite rooms at Curzon House on Curzon Street start from just £129 Per Week, offering affordable city-centre student living in one of Nottingham’s most connected locations. Perfect for students wanting private space, strong social atmosphere and excellent access to universities, nightlife and transport links.\r\nLocated close to Nottingham’s city centre hotspots, Curzon House is a strong choice for students wanting balance between independence, affordability and convenience throughout the 2026/2027 academic year 🏙️✨\r\n\r\nInside Your Classic Plus Ensuite 🏠\r\nEach Classic Plus Ensuite room is approximately 17m² and includes:\r\n• Private ensuite bathroom 🚿\r\n• Comfortable ¾ bed with under-bed storage 🛏️\r\n• Spacious wardrobe & storage\r\n• Study desk & chair 📚\r\n• High-speed Wi-Fi 🌐\r\nYou’ll also share a fully equipped kitchen and communal living area with 4–6 flatmates — ideal for students wanting a sociable atmosphere whilst still having their own private retreat 🛋️🍽️\r\n\r\nPremium Student Facilities 🌟\r\nCurzon House includes a wide range of student-focused amenities designed around modern university life:\r\n• Cinema lounge 🎬\r\n• Quiet study spaces 📚\r\n• Communal lounge & social areas 🛋️\r\n• Laundry facilities 🧺\r\n• Coffee station ☕\r\n• Vending machines\r\n• Secure bike storage 🚲\r\n• Courtyard outdoor space 🌿\r\n• Pool table & darts board 🎱\r\n• On-site concierge & maintenance team ✅\r\n• On-site security & 24-hour CCTV 🔒\r\n• Fully refurbished communal areas for the 2026/2027 academic year ✨\r\nAll utility bills are included within your rent:\r\n• Water\r\n• Electricity\r\n• Heating\r\n• High-speed Wi-Fi\r\nNo hidden costs. No unexpected bills. Simple student budgeting ✅\r\n\r\nRoom Types & Prices 💷\r\n• Classic Ensuite — From £125 PW\r\n• Classic Plus Ensuite — From £129 PW\r\n• Premium Ensuite — From £135 PW\r\n• 3 Bed Ensuite — From £139 PW\r\n\r\nTenancy Lengths 2026/2027\r\n44 Weeks\r\n12/09/2026 – 17/07/2027\r\nFrom £135 Per Week\r\n(£99 Deposit)\r\n51 Weeks\r\n12/09/2026 – 04/09/2027\r\nFrom £129 Per Week\r\n(£99 Deposit)\r\n\r\nPayment Information\r\nRent payment options are subject to the latest tenancy regulations and provider requirements for the 2026/2027 academic year.\r\nPlease have a guarantor ready during the booking process.\r\n\r\nPrime Nottingham Location 📍\r\nCurzon House\r\nSituated close to Nottingham city centre, Curzon House places students within easy reach of universities, shopping, cafés, nightlife and public transport.\r\n\r\nWalking & Travel Times 🚶🚌\r\nNottingham Trent University\r\nApproximately a 13-minute walk from the accommodation, making Curzon House ideal for NTU students wanting affordable city-centre living close to campus.\r\nNottingham College & Nottingham Business School\r\nApproximately 15 minutes via bike or public transport.\r\nUniversity of Nottingham\r\nUnder 30 minutes via public transport.\r\n\r\nTransport Links 🚋🚌\r\n• Nottingham city-centre bus stops are only minutes away, offering direct routes across Nottingham and to major university campuses.\r\n• Excellent local cycle routes with secure on-site bike storage.\r\n• Nottingham railway station provides quick regional travel to Derby, Leicester, Sheffield and London.\r\n\r\nNearby Amenities ☕🛒\r\nCurzon House places students close to many of Nottingham’s most popular student areas and amenities, including:\r\n• Victoria Centre shopping mall 🛍️\r\n• Cinema & food court 🎬\r\n• Tesco Express & supermarkets\r\n• Independent cafés & coffee shops ☕\r\n• Restaurants, bars & nightlife 🍴\r\n• Hockley & Lace Market social areas\r\n• Nottingham Castle\r\n• The Arboretum for walks, outdoor study breaks and green space 🌳\r\nCurzon House is ideal for students wanting affordable ensuite living, strong social atmosphere, modern communal spaces and convenient access to everything Nottingham has to offer during the 2026/2027 academic year.",
                'amenities'       => [6, 8, 9, 12, 14, 15],
                'bill_included'   => [16, 17, 20],
                'lat'             => 52.9572358,
                'lng'             => -1.1424234,
                'is_feature'      => true,
                'is_available'    => true,
                'status'          => 'approved',
                'images'          => [
                    "https://images.unsplash.com/photo-1613553507747-5f8d62ad5904?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://plus.unsplash.com/premium_photo-1733306523667-80d5e5668631?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://plus.unsplash.com/premium_photo-1748075588586-525c48d6dd03?q=80&w=1113&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://plus.unsplash.com/premium_photo-1748075588586-525c48d6dd03?q=80&w=1113&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni1->id, $uni2->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Ensuite, Broadgate, Nottingham',
                'category_id'     => 3,
                'location'        => 'Beeston, Nottingham, Uk',
                'city_id'         => 5,
                'full_address'    => 'NG9 2HF, Beeston, Broxtowe, Nottinghamshire, East Midlands, England, United Kingdom',
                'price'           => 175.00,
                'duration_period' => 'per week',
                'available_from'  => '2026-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => "Broadgate House Ensuite Rooms – Luxury Student Accommodation in Nottingham 2026/2027\r\n\r\nBills included! 💧🌐 Modern Ensuite rooms at Broadgate House in Beeston offer comfortable all-inclusive student living just minutes from the University of Nottingham University Park Campus. Perfect for students wanting a balance between peaceful student living and fast access to Nottingham city centre.\r\n\r\nEach modern cluster ensuite room includes your own private bedroom and ensuite bathroom, alongside shared social kitchen and lounge spaces with fellow flatmates 🛏️🚿. Rooms are approximately 14m² and come fully equipped with:\r\n• Comfortable ¾ double bed\r\n• Study desk & chair\r\n• Ample wardrobe & storage space\r\n• Under-bed storage\r\n• High-speed Wi-Fi\r\n• Smart TV\r\n• Multiple plug & USB charging points\r\n\r\nThe shared kitchen-lounge areas are designed for both socialising and student convenience, featuring:\r\n• Induction hob\r\n• Built-in oven\r\n• Microwave\r\n• Large fridge-freezer\r\n• Dining area\r\n• Comfortable sofa seating\r\n• 42” Smart TV 🍽️🛋️📺\r\n\r\nAll utility bills are included within your rent:\r\n• Water\r\n• Electricity\r\n• Heating\r\n• High-speed internet\r\n\r\nNo hidden costs. Simple student budgeting ✅\r\n\r\nBroadgate House also offers a range of premium on-site facilities designed around modern student lifestyles:\r\n• Free on-site gym 🏋️‍♂️\r\n• Games room 🎮\r\n• Study spaces 📚\r\n• Landscaped courtyard 🌳\r\n• Laundry facilities 👕\r\n• Secure bike storage 🚲\r\n• Parcel collection service 📦\r\n• 24/7 CCTV & secure fob access 🔒\r\n• On-site maintenance support 🛠️\r\n\r\nIdeal for students looking for a sociable environment whilst still enjoying privacy, comfort and strong transport links into Nottingham.\r\n\r\nTenancy Lengths 2026/2027\r\n\r\n48 Weeks\r\n05/09/2026 – 06/08/2027\r\n£175 Per Week (£8,400 Total)\r\n(£350 Reservation Fee)\r\n\r\n50 Weeks\r\n05/09/2026 – 20/08/2027\r\n£175 Per Week (£8,750 Total)\r\n(£350 Reservation Fee)\r\n\r\n51 Weeks\r\n05/09/2026 – 27/08/2027\r\n£175 Per Week (£8,925 Total)\r\n(£350 Reservation Fee)\r\n\r\nExclusive AchGoldEstates Student Benefits 🎁\r\n\r\nOnly when booking through AchGoldEstates, you unlock access to the AGE Membership range of exclusive student perks, including:\r\n• Cashback offers\r\n• Free takeaways\r\n• Exclusive student discounts\r\n• Complimentary nightclub/event tickets\r\n• Giveaways & student rewards\r\n• …and much more\r\n\r\nYou’ll also gain access to our Nottingham Student Safety & Crime Update Newsletter 📰 helping students stay informed about local incidents, safer areas and important city updates throughout the academic year.\r\n\r\nThese benefits are exclusively available through AchGoldEstates referrals.\r\n\r\nPayment Information\r\n\r\nRent payment options are subject to the latest tenancy regulations and provider requirements for the 2026/2027 academic year.\r\n\r\nPlease have a guarantor ready during the booking process.\r\n\r\nPrime Nottingham Location 📍\r\n\r\nBroadgate House\r\n\r\nLocated in the heart of Beeston, Broadgate House gives students direct access to cafés, supermarkets, transport links and one of Nottingham’s most popular student areas.\r\n\r\nWalking Distances 🚶\r\nUniversity of Nottingham – University Park Campus\r\n\r\nApproximately a 5–8 minute walk through campus pathways.\r\n\r\nNottingham Trent University – City Campus\r\n\r\nRoughly 25 minutes via tram or bus connection.\r\n\r\nTransport Links 🚋🚌\r\n\r\n• Bus Stop 36 sits directly outside the accommodation for quick student travel.\r\n• Beeston tram stop & bus interchange are approximately a 2-minute walk away with regular tram and bus services into Nottingham city centre.\r\n• Beeston railway station is around an 8-minute walk away for regional rail travel across the East Midlands.\r\n\r\nNearby Amenities ☕🛒\r\n\r\nBroadgate House places you within walking distance of Beeston’s vibrant student-friendly high street, including:\r\n• Cafés & coffee shops\r\n• Restaurants & takeaways\r\n• Local pubs & social spots\r\n• Sainsbury’s Local\r\n• Co-op\r\n• Budgens\r\n• Gym facilities\r\n• Beeston Library\r\n• Attenborough Nature Reserve nearby for walks, relaxation and outdoor study breaks 🌿\r\n\r\nWith strong transport links, a major university nearby and a lively student atmosphere, Broadgate House offers an ideal mix of convenience, community and comfortable student living for 2026/2027.",
                'amenities'       => [6, 7, 8, 9, 10, 12, 13, 14, 15],
                'bill_included'   => [16, 17, 18, 20],
                'lat'             => 52.9302275,
                'lng'             => -1.2088818,
                'is_feature'      => true,
                'is_available'    => true,
                'status'          => 'approved',
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://plus.unsplash.com/premium_photo-1676968002767-1f6a09891350?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni3->id, $uni4->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Ensuite, Stanley, Nottingham',
                'category_id'     => 3,
                'location'        => 'City Centre, Nottingham, UK',
                'city_id'         => 4,
                'full_address'    => 'Stanley House, Talbot Street, Nottingham NG1 5GL',
                'price'           => 175.00,
                'duration_period' => 'per week',
                'available_from'  => '2026-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => "Stanley House Ensuite Rooms – Luxury Student Accommodation in Nottingham 2026/2027\r\n\r\nBills included! 💧🌐 Modern Ensuite rooms at Stanley House on Talbot Street start from just £175 Per Week, placing you directly opposite Nottingham Trent University’s City Campus — genuinely around a 10-second walk across the road. For NTU students wanting maximum convenience, it’s difficult to get much closer.\r\n\r\nEach private ensuite room is designed for comfortable student living, featuring a cosy bed, dedicated study desk and chair, wardrobe, shelving, ultra-fast Wi-Fi and multiple charging/USB points 🛏️🚿📚. You get your own personal space whilst still enjoying the social atmosphere of shared student living.\r\n\r\nBeyond your room, Stanley House offers stylish communal kitchens and lounges complete with comfortable seating, dining areas and large TVs — ideal for relaxing after lectures, flat dinners, movie nights or revision sessions with friends 🍽️🛋️🎬. Kitchens include:\r\n• 4-ring induction hob\r\n• Built-in oven\r\n• Microwave\r\n• Large fridge-freezer\r\n• Modern storage space\r\n\r\nYour rent includes all utility bills:\r\n• Water\r\n• Electricity\r\n• Heating\r\n• High-speed Wi-Fi\r\n\r\nNo surprise costs. Simple student budgeting ✅\r\n\r\nStanley House also includes premium student amenities designed around modern student lifestyles:\r\n• On-site gym 🏋️‍♂️\r\n• Cinema room 🎬\r\n• Study suites 📚\r\n• Social lounge 🛋️\r\n• Laundry facilities 👕\r\n• Secure storage areas 📦\r\n• Landscaped courtyard 🌳\r\n• 24/7 CCTV & secure fob entry 🔒\r\n\r\nPerfect for students wanting comfort, security, social atmosphere and a prime city-centre location right beside campus.\r\n\r\nTenancy Lengths 2026/2027\r\n\r\n48 Weeks\r\n05/09/2026 – 06/08/2027\r\n£175 Per Week (£8,400 Total)\r\n(£250 Reservation Fee)\r\n\r\n50 Weeks\r\n05/09/2026 – 20/08/2027\r\n£175 Per Week (£8,750 Total)\r\n(£250 Reservation Fee)\r\n\r\n51 Weeks\r\n05/09/2026 – 27/08/2027\r\n£175 Per Week (£8,925 Total)\r\n(£250 Reservation Fee)\r\n\r\nExclusive AchGoldEstates Student Benefits 🎁\r\n\r\nOnly when booking through AchGoldEstates, you unlock access to the AGE Membership range of exclusive student perks, including:\r\n• Cashback offers\r\n• Free takeaways\r\n• Exclusive student discounts\r\n• Complimentary nightclub/event tickets\r\n• Giveaways & student rewards\r\n• …and much more\r\n\r\nYou’ll also gain access to our Nottingham Student Safety & Crime Update Newsletter 📰 helping students stay informed about local incidents, safer areas and important city updates throughout the academic year.\r\n\r\nThese benefits are exclusively available through AchGoldEstates referrals.\r\n\r\nPayment Information\r\n\r\nRent payment options are subject to the latest tenancy regulations and provider requirements for the 2026/2027 academic year.\r\n\r\nPlease have a guarantor ready during the booking process.\r\n\r\nPrime Nottingham Location 📍\r\n\r\nStanley House\r\n\r\nLocated directly beside Nottingham Trent University’s City Campus, Stanley House places you in the centre of Nottingham student life.\r\n\r\nWalking Distances 🚶\r\nNottingham Trent University – City Campus\r\n\r\nLiterally across the road — around a 10-second walk to campus buildings, libraries and lecture halls.\r\n\r\nUniversity of Nottingham – University Park Campus\r\n\r\nApproximately 15–20 minutes via tram or frequent Orange Line bus services.\r\n\r\nTransport Links 🚋\r\n\r\n• NET Tram stop “Nottingham Trent University” sits directly outside Stanley House, connecting you across Nottingham quickly.\r\n• Multiple bus routes operate from Talbot Street daily.\r\n• Nottingham railway station is roughly a 10-minute walk away for national rail travel.\r\n\r\nNearby Amenities 🛒☕\r\n\r\nEverything students typically need sits within walking distance:\r\n• Tesco Express\r\n• Sainsbury’s Local\r\n• Student cafés & coffee shops\r\n• Restaurants & takeaways\r\n• Victoria Centre shopping mall\r\n• Gyms & fitness facilities\r\n• Cinema & entertainment venues\r\n• The Arboretum green space nearby for walks, study breaks and summer relaxation 🌳",
                'amenities'       => [6, 7, 8, 10, 12, 14, 15],
                'bill_included'   => [16, 17, 20],
                'lat'             => null,
                'lng'             => null,
                'is_feature'      => true,
                'is_available'    => true,
                'status'          => 'approved',
                'images'          => [
                    "https://plus.unsplash.com/premium_photo-1742418222453-6940c5a033b7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDR8fHxlbnwwfHx8fHw%3D",
                    "https://plus.unsplash.com/premium_photo-1742418222453-6940c5a033b7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDR8fHxlbnwwfHx8fHw%3D",
                    "https://media.istockphoto.com/id/481338066/photo/picturesque-houses-on-the-canal-in-meerkerk-netherlands.webp?a=1&b=1&s=612x612&w=0&k=20&c=b2eCBcKnLoZAi1POnp_q92mUX5H_0mcqgl4tX5XiAxg=",
                ],
                'universities'    => [$uni1->id, $uni5->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'True Ensuite/Apartment, Nottingham',
                'category_id'     => 3,
                'location'        => 'City Centre, Nottingham, UK',
                'city_id'         => 4,
                'full_address'    => '2 Cowan St, Nottingham NG1 1BQ',
                'price'           => 188.00,
                'duration_period' => 'per week',
                'available_from'  => '2026-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => "🎓 Exclusive to AchGoldEstates Referrals\r\n\r\nBook through AchGoldEstates and unlock AGE (AchGoldEstates Membership) — available to referred students only.\r\n\r\nEnjoy members-only benefits, including:\r\n\r\nFree takeaways\r\nFree nightclub tickets\r\nCashback rewards\r\nNottingham student safety & crime newsletter\r\nPartner discounts & surprise drops\r\n\r\nNot available when booking direct.\r\n\r\n📅 Tenancy start date: 4th September 2026\r\n\r\n🏡 Shared Apartments at true Student Nottingham\r\n\r\nLooking for the perfect balance between privacy and student social life?\r\n\r\nThe shared apartments at True Student Nottingham are designed for students who want the best of both worlds — your own private en-suite space, alongside a vibrant shared living experience.\r\n\r\nChoose between apartments shared with 4 or 5 flatmates, complete with a modern communal kitchen, dining area, and lounge space designed for everyday student living.\r\n\r\nPerfect for making friends, creating memories, and experiencing university life properly from day one.\r\n\r\n🛏️ Your Private En-Suite Room (Freedom)\r\n\r\nEven in shared living, your personal space matters.\r\n\r\nEach en-suite bedroom includes:\r\n\r\nPrivate en-suite bathroom\r\nDouble bed with premium true mattress\r\nDedicated study desk, chair & storage\r\nWardrobe, drawers & under-bed storage\r\nBedside shelving & charging facilities\r\nFull-length mirror\r\nSmart TV\r\nModern finishes throughout\r\n\r\nWith rooms starting from 16sqm, you’ll have the comfort and privacy you need to study, relax, and recharge.\r\n\r\n🍽️ Shared Living Spaces (Belonging)\r\n\r\nYour apartment also includes a fully fitted shared:\r\n\r\nKitchen\r\nDining area\r\nLounge space\r\n\r\nDesigned to create a genuine student community atmosphere, these apartments are ideal for students who enjoy:\r\n\r\nMeeting new people\r\nSocial evenings with flatmates\r\nShared cooking & movie nights\r\nA more connected university experience\r\n🌐 What’s Included\r\nAll-inclusive bills\r\nUltra-fast WiFi & wired internet\r\nFree unlimited printing\r\nPremium contents insurance\r\n24/7 concierge support\r\nSecure key fob access & CCTV\r\nParcel collection service\r\nMental health & wellbeing support\r\nGym, games den & study rooms access\r\n📍 Perfect Nottingham Location\r\n\r\nLocated close to both:\r\n\r\nNottingham Trent University\r\nUniversity of Nottingham\r\n\r\nTrue Student Nottingham places you near the heart of the city’s:\r\n\r\nStudent nightlife\r\nShopping destinations\r\nCafés & restaurants\r\nTransport links & campuses\r\n\r\nEverything you need is within easy reach.\r\n\r\n🎓 Why Students Book Through AchGoldEstates\r\n\r\nMost students simply scroll and book.\r\n\r\nWe help students choose properly.\r\n\r\nThrough AchGoldEstates, your accommodation guidance is backed by insights from 5,500+ in-person student interviews across Nottingham, helping students find accommodation that matches what they actually value:\r\n\r\nFreedom. Belonging. Safety.",
                'amenities'       => [6, 7, 8, 9, 11, 12, 13, 14, 15],
                'bill_included'   => [16, 17, 20],
                'lat'             => null,
                'lng'             => null,
                'is_feature'      => true,
                'is_available'    => true,
                'status'          => 'approved',
                'images'          => [
                    "https://plus.unsplash.com/premium_photo-1733266909979-04673d537bef?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDV8fHxlbnwwfHx8fHw%3D",
                    "https://images.unsplash.com/photo-1770892345762-22a2c4ff0e1e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDl8fHxlbnwwfHx8fHw%3D",
                    "https://images.unsplash.com/photo-1636309783411-b3613713ec9b?q=80&w=1167&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                ],
                'universities'    => [$uni2->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'True Studio, Nottingham',
                'category_id'     => 1,
                'location'        => 'City Centre, Nottingham, UK',
                'city_id'         => 4,
                'full_address'    => '2 Cowan St, Nottingham NG1 1BQ',
                'price'           => 211.00,
                'duration_period' => 'per week',
                'available_from'  => '2026-09-01',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => "🎓 Exclusive to AchGoldEstates Referrals\r\n\r\nBook through AchGoldEstates and unlock AGE (AchGoldEstates Membership) — available to referred students only.\r\n\r\nEnjoy members-only benefits, including:\r\n\r\nFree takeaways\r\nFree nightclub tickets\r\nCashback rewards\r\nNottingham student safety & crime newsletter\r\nPartner discounts & surprise drops\r\n\r\nNot available when booking direct.\r\n\r\ntrue Student Nottingham Accommodation\r\n\r\nLooking for more than just a room?\r\n\r\nTrue Student Nottingham offers a fully designed student lifestyle — built for comfort, connection, and convenience from day one.\r\n\r\nLocated just a 15-minute walk to Nottingham Trent University and a 20-minute bus ride to the University of Nottingham, you’re perfectly positioned for both academic life and the city experience.\r\n\r\n🛏️ Your Space (Freedom)\r\n\r\nChoose from stylish private studios or shared apartments, designed for independence without compromise.\r\n\r\nEach studio includes:\r\n\r\nDouble bed with premium mattress\r\nPrivate en-suite bathroom\r\nFully fitted kitchenette (oven, 2-ring hob, fridge freezer, sink)\r\nSmart TV & high-speed connectivity\r\nDedicated study desk, chair & storage\r\nWardrobe, drawers & under-bed storage\r\nFull-length mirror & modern finishes\r\n🌐 Connectivity & Essentials\r\nAll-inclusive bills (no hidden costs)\r\nUltra-fast WiFi (up to 250Mbps) + wired internet (up to 1Gbps)\r\nFree unlimited printing\r\nPremium contents insurance included\r\nFree dual occupancy (studios)\r\n🏡 Social Spaces (Belonging)\r\n\r\nThis is where True Student stands out.\r\n\r\nPrivate dining kitchen\r\nLarge communal festival zone\r\nChill & social lounges\r\nGames den\r\nStudy rooms\r\nFully equipped gym\r\nExtensive outdoor courtyard\r\n\r\nYou’re not just living here — you’re part of a student community designed to connect.\r\n\r\n🔒 Safety & Support (Safety)\r\n24/7 concierge & on-site team\r\nCCTV & secure key fob access\r\nSecure 24/7 parcel collection\r\nMental health & wellbeing support\r\nOn-site laundry facilities\r\nOptional on-site parking\r\n📍 Location & Lifestyle\r\n\r\nBased in Nottingham city centre, you’re minutes from:\r\n\r\nShopping destinations\r\nCafés & restaurants\r\nStudent nightlife\r\nCultural hotspots\r\n\r\nEverything you need — right on your doorstep.\r\n\r\n💡 Why Book Through AchGoldEstates?\r\n\r\nMost students just scroll and book.\r\n\r\nWe help you choose properly.\r\n\r\nThrough AchGoldEstates, you get:\r\n\r\nAccess to exclusive AGE membership perks\r\nGuidance backed by 5,500+ in-person student interviews\r\nA platform built around what students actually care about:\r\nFreedom. Belonging. Safety.",
                'amenities'       => [6, 7, 8, 9, 11, 12, 13, 14, 15],
                'bill_included'   => [16, 17, 20],
                'lat'             => null,
                'lng'             => null,
                'is_feature'      => true,
                'is_available'    => true,
                'status'          => 'approved',
                'images'          => [
                    "https://images.unsplash.com/photo-1613553507747-5f8d62ad5904?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cHJvcGVydGllc3xlbnwwfHwwfHx8MA%3D%3D",
                    "https://media.istockphoto.com/id/1162515759/photo/exterior-home-with-swimming-pool-in-the-house.webp?a=1&b=1&s=612x612&w=0&k=20&c=HzUuUOKB7IP88RC0eH9R3OXYcPuM16RVKICMU-s5ibE=",
                    "https://images.unsplash.com/photo-1613553507747-5f8d62ad5904?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cHJvcGVydGllc3xlbnwwfHwwfHx8MA%3D%3D",
                ],
                'universities'    => [$uni1->id, $uni4->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Quas qui libero volu g',
                'category_id'     => 2,
                'location'        => 'Lenton, Nottingham',
                'city_id'         => 1,
                'full_address'    => 'Mohakhali, Bir Uttam A. K. Khandakar Road, Gulshan 1, Mohakhali, Dhaka, Dhaka Metropolitan, Dhaka District, Dhaka Division, 1213, Bangladesh',
                'price'           => 387.00,
                'duration_period' => 'per week',
                'available_from'  => '2026-05-31',
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'description'     => 'Eveniet error dolor',
                'amenities'       => [7, 14],
                'bill_included'   => [19],
                'lat'             => 23.7799057,
                'lng'             => 90.4083155,
                'is_feature'      => true,
                'is_available'    => true,
                'status'          => 'approved',
                'images'          => [
                    "https://images.unsplash.com/photo-1564078516393-cf04bd966897?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://plus.unsplash.com/premium_photo-1675745329659-29044cb6adbb?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDh8fHxlbnwwfHx8fHw%3D",
                    "https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDN8fHxlbnwwfHx8fHw%3D",
                ],
                'universities'    => [$uni3->id],
            ],
            [
                'user_id'         => 3,
                'title'           => 'Fugit nihil est par',
                'category_id'     => 1,
                'location'        => 'Quia dicta officiis',
                'city_id'         => 6,
                'full_address'    => 'Cupidatat velit fac',
                'price'           => 164.00,
                'duration_period' => 'per month',
                'available_from'  => '2026-05-31',
                'bedrooms'        => 3,
                'bathrooms'       => 6,
                'description'     => 'mbmbnmmnbmnb',
                'amenities'       => [9, 6, 14, 11, 10],
                'bill_included'   => [21, 18],
                'lat'             => null,
                'lng'             => null,
                'is_feature'      => true,
                'is_available'    => true,
                'status'          => 'approved',
                'images'          => [
                    "https://plus.unsplash.com/premium_photo-1675745329659-29044cb6adbb?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDEyfHx8ZW58MHx8fHx8",
                    "https://media.istockphoto.com/id/2193462442/photo/vintage-tropical-villa-with-palm-trees-stone-steps-lush-garden-white-clouds-sunny-sky-empty.webp?a=1&b=1&s=612x612&w=0&k=20&c=CEbHmTIQdYFZB5kljixpSchAumZre4-Z0-Q_3NkZ3QI=",
                    "https://media.istockphoto.com/id/2193462442/photo/vintage-tropical-villa-with-palm-trees-stone-steps-lush-garden-white-clouds-sunny-sky-empty.webp?a=1&b=1&s=612x612&w=0&k=20&c=CEbHmTIQdYFZB5kljixpSchAumZre4-Z0-Q_3NkZ3QI=",
                ],
                'universities'    => [$uni5->id],
            ],
        ];

        // loop through the data and create properties
        foreach ($data as $item) {
            $universityIds = $item['universities'] ?? [];
            unset($item['universities']);

            $property = Property::create($item);
            if (! empty($universityIds)) {
                $property->universities()->attach($universityIds);
            }
        }
    }
}
