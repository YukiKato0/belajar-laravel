<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $settings = [
        //general
        [
          'key' => 'site_name',
          'value' => 'PPKD Sticker',
          'label' => 'Nama Lembaga / Website',
          'group' => 'general',
          'type' => 'text',
        ],
        [
          'key' => 'site_logo',
          'value' => null,
          'label' => 'Logo Lembaga / Website',
          'group' => 'general',
          'type' => 'image',
        ]
      ];

      foreach ($settings as $setting) {
        Setting::updateOrCreate(['key' => $setting['key']], $setting);
      };
    }
}
