<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerLogo extends Model
{
    protected $fillable = ['section', 'image', 'alt', 'sort_order'];

    public const SECTION_ACCREDITATION = 'accreditation';
    public const SECTION_STRATEGIC = 'strategic';
    public const SECTION_FINANCIAL = 'financial';

    public static function sections(): array
    {
        return [
            self::SECTION_ACCREDITATION => 'Accreditation Partner',
            self::SECTION_STRATEGIC => 'Strategic & Technology Partners',
            self::SECTION_FINANCIAL => 'Financial Partners',
        ];
    }
}
