<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function index() {
    $title = 'Manajemen Pengaturan - PRD Sticker';
    $setting = Setting::all()->keyBy('key');
    return view('admin.setting.index', compact('title', 'setting'));
  }

  public function update(Request $request) {
    $validated = $request->validate([
      'site_name' => 'nullable|string|max:255',
      'site_tagline' => 'nullable|string|max:255',
      'site_description' => 'nullable|string|max:255',
      'site_logo' => 'nullable|image|mines:png,jpg,jpeg,webp|max:2048',
      
      'phone' => 'nullable|string|max:100',
      'email_upload' => 'nullable|email|max:255',
      'email_order' => 'nullable|email|max:255',
      'address' => 'nullable|string|max:1000',

      'url_shopee' => 'nullable|url|max:255',
      'url_facebook' => 'nullable|url|max:255',
      'url_instagram' => 'nullable|url|max:255',
      'url_youtube' => 'nullable|url|max:255',
      'url_tiktok' => 'nullable|url|max:255',
      ]);

    $ignoreKeys = ['site_logo'];
    return $validated;
    foreach ($validated as $key => $value) {
      if (in_array($key, $ignoreKeys)) {
        continue;
      }
      
      Setting::updateOrCreate([
        ['key' => $key],
        [
          'value' => $value,
          'label' => ucwords(str_replace('_',' ',$key)),
          'group' => 'general',
          'type' => 'text',
        ],
      ]);
    }
  }
}
