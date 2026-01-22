<?php

namespace App\Enum;

enum Section: string
{
    case account_profile = 'account_profile';
    case reward_point = 'reward_point';
    case post_content = 'post_content';
    case referral_work = 'referral_work';
}
