<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'mhanifazmi',
                'full_name' => 'Muhammad Hanif bin Azmi',
                'url' => 'mhanifazmi',
                'description' => '3 years experience in web development looking for a position to sharpen my technical and soft skills in the hope of becoming the best in Software Engineering field as well as in your company.',
                'image' => '',
                'background' => 'default.png',
                'email' => 'hanifazmi23@gmail.com',
                'password' => bcrypt('12341234'),
                'links' => [
                    [
                        'user_id' => null,
                        'name' => 'mhanifazmi.com',
                        'description' => 'Check out my portfolio and resume!',
                        'icon' => 'icofont icofont-business-man-alt-1',
                        'order' => 1,
                        'url' => 'https://mhanifazmi.com/',
                    ],
                    [
                        'user_id' => null,
                        'name' => 'Whatsapp',
                        'description' => 'Whatsapp me at +60 111-419 9338',
                        'icon' => 'icofont icofont-brand-whatsapp',
                        'order' => 2,
                        'url' => 'https://api.whatsapp.com/send?phone=601114199338&text=Hi%20Hanif',
                    ],
                    [
                        'user_id' => null,
                        'name' => 'Telegram',
                        'description' => 'Telegram me!',
                        'icon' => 'icofont icofont-social-telegram',
                        'order' => 3,
                        'url' => 'https://t.me/mhanifazmi',
                    ],
                ]
            ]
        ];

        foreach ($users as $user) {
            $links = $user['links'];
            unset($user['links']);
            $u = User::create($user);

            foreach ($links as $key => $link) {
                $link['user_id'] = $u->id;
                Link::create($link);
            }
        }
    }
}
