<?php

use Illuminate\Database\Seeder;

class SocialMediasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_medias')->insert(

            [
                [
                    'name' => 'Facebook',
                    'icon' => 'fab fa-facebook-f',
                    'color' => '#3b5999',
                    'url' => 'https://www.facebook.com',
                    'order' => 1,
                    'status' => '0',
                    'admin' => '1'
                ],
                [
                    'name' => 'Instagram',
                    'icon' => 'fab fa-instagram',
                    'color' => '#e4405f',
                    'url' => 'https://www.instagram.com',
                    'order' => 2,
                    'status' => '0',
                    'admin' => '1'
                ],
                [
                    'name' => 'Twitter',
                    'icon' => 'fab fa-twitter',
                    'color' => '#55acee',
                    'url' => 'https://www.twitter.com',
                    'order' => 3,
                    'status' => '0',
                    'admin' => '1'
                ],
                [
                    'name' => 'YouTube',
                    'icon' => 'fab fa-youtube',
                    'color' => '#cd201f',
                    'url' => 'https://www.youtube.com',
                    'order' => 4,
                    'status' => '0',
                    'admin' => '1'
                ],
                [
                    'name' => 'WhatsApp',
                    'icon' => 'fab fa-whatsapp',
                    'color' => '#25D366',
                    'url' => 'https://www.whatsapp.com',
                    'order' => 5,
                    'status' => '0',
                    'admin' => '1'
                ],
                [
                    'name' => 'Skype',
                    'icon' => 'fab fa-skype',
                    'color' => '#00AFF0',
                    'url' => 'https://www.skype.com',
                    'order' => 6,
                    'status' => '0',
                    'admin' => '1'
                ],
                [
                    'name' => 'Email',
                    'icon' => 'far fa-envelope',
                    'color' => '#34465d',
                    'url' => 'email@email.com',
                    'order' => 7,
                    'status' => '0',
                    'admin' => '1'
                ]
            ]
        );
    }
}
