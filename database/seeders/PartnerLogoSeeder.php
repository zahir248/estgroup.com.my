<?php

namespace Database\Seeders;

use App\Models\PartnerLogo;
use Illuminate\Database\Seeder;

class PartnerLogoSeeder extends Seeder
{
    public function run(): void
    {
        $accreditation = [
            ['image' => 'mpia.png', 'alt' => 'MPIA - Malaysian Photovoltaic Industry Association'],
            ['image' => 'tnb.png', 'alt' => 'Tenaga Nasional - Better. Brighter.'],
            ['image' => 'mida.png', 'alt' => 'MIDA - Investment for Transformation'],
            ['image' => 'cidb.png', 'alt' => 'CIDB Malaysia'],
            ['image' => 'suruhanjaya.png', 'alt' => 'Suruhanjaya Tenaga - Energy Commission'],
            ['image' => 'seda.png', 'alt' => 'SEDA Malaysia - Sustainable Energy Development Authority'],
        ];
        foreach ($accreditation as $i => $row) {
            PartnerLogo::create([
                'section' => PartnerLogo::SECTION_ACCREDITATION,
                'image' => $row['image'],
                'alt' => $row['alt'],
                'sort_order' => $i,
            ]);
        }

        $strategic = [
            ['image' => 'huawei.jpg', 'alt' => 'Huawei'],
            ['image' => 'Panasonic_logo_Blue.svg_.png', 'alt' => 'Panasonic'],
            ['image' => '2560px-Sanyo_logo.svg_-2048x696.png', 'alt' => 'SANYO'],
            ['image' => 'jinko-solar-logo-e1586330300806.png', 'alt' => 'Jinko Solar'],
            ['image' => 'QCELLS-e1586330264283.png', 'alt' => 'Q CELLS'],
            ['image' => 'schneider-electric-vector-logo-1-e1586330605158.png', 'alt' => 'Schneider Electric'],
            ['image' => 'solis-logo-v2.png', 'alt' => 'solis'],
            ['image' => '1200px-Logo_SMA-1-e1586330559734.png', 'alt' => 'SMA'],
            ['image' => 'trina-logo-solarclarity-color.png', 'alt' => 'Trina Solar'],
            ['image' => 'canadian-solar-logo.png', 'alt' => 'Canadian Solar'],
            ['image' => 'https://estgroup.com.my/wp-content/uploads/2023/06/sunpower-1-2048x432.jpg', 'alt' => 'SUNPOWER'],
            ['image' => 'seraphim-logo.png', 'alt' => 'SERAPHIM'],
            ['image' => 'delta_logo_009bdd.png', 'alt' => 'AFITA'],
            ['image' => 'ip-muda.jpg', 'alt' => 'IPMUDA BERHAD'],
            ['image' => 'hanwha1.jpg', 'alt' => 'Hanwha Q CELLS'],
            ['image' => 'yingli-logo-1.jpg', 'alt' => 'YINGLI SOLAR'],
            ['image' => 'Logo-Kaco-new-energy-3D_cmykv2.png', 'alt' => 'KACO'],
            ['image' => 'kaneka-logo-2048x2048.png', 'alt' => 'Kaneka'],
            ['image' => 'senergy-logo.jpg', 'alt' => 'S-Energy'],
            ['image' => 'ja-solar-logo.png', 'alt' => 'JA SOLAR'],
            ['image' => 'zeversolar_logo.jpg', 'alt' => 'zeversolar'],
            ['image' => 'sungrow-logo.png', 'alt' => 'SUNGROW'],
            ['image' => 'Power_China.svg_.png', 'alt' => 'Power China'],
        ];
        foreach ($strategic as $i => $row) {
            PartnerLogo::create([
                'section' => PartnerLogo::SECTION_STRATEGIC,
                'image' => $row['image'],
                'alt' => $row['alt'],
                'sort_order' => $i,
            ]);
        }

        $financial = [
            ['image' => 'midf.png', 'alt' => 'MIDF'],
            ['image' => 'muamalat_logo.original.png', 'alt' => 'Bank Muamalat'],
        ];
        foreach ($financial as $i => $row) {
            PartnerLogo::create([
                'section' => PartnerLogo::SECTION_FINANCIAL,
                'image' => $row['image'],
                'alt' => $row['alt'],
                'sort_order' => $i,
            ]);
        }
    }
}
