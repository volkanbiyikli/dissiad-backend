<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                [
                    'url' => 'https://www.websitesiadi.com',
                    'title' => 'Web Sitesi Adı',
                    'status' => '1',
                    'description' => 'Web Sitesi Açıklaması...',
                    'address' => 'İletişim Bilgileri...',
                    'telephone' => '+90 312 123 45 67',
                    'fax' => '+90 312 123 45 67',
                    'email' => 'email@email.com',
                    'map' => 'Harita Kodu...',
                    'analytics' => null,
                    'noindex' => '0',
                    'seo_description' => 'Seo Web Sitesi Açıklaması...',
                    'twitter' => '@twitterkullaniciadi',
                    'facebook' => 'https://www.facebook.com/sayfaadi/',
                ]
            ]
        );
    }
}
