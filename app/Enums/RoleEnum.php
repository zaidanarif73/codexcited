<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use Auth;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleEnum extends Enum
{
    const SuperAdmin = "SuperAdmin";
    const Teacher = "Teacher";
    const Student = "Student";

    public static function roles()
    {
        $roles = [
            'SuperAdmin',
            'Teacher',
            'Student',
        ];

        if(Auth::user()->isModerator()){
            unset($roles[0]);
            unset($roles[1]);
        }
        return $roles; 
    }
}
