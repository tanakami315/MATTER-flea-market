<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $param = [
    [
        'category_id' => 1,
        'name' => '腕時計',
        'condition' => 1,
        'brand' => 'Rolax',
        'description' => 'スタイリッシュなデザインのメンズ腕時計',
        'price' => 15000,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 2,
        'name' => 'HDD',
        'condition' => 2,
        'brand' => '西芝',
        'description' => '高速で信頼性の高いハードディスク',
        'price' => 5000,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 10,
        'name' => '玉ねぎ3束',
        'condition' => 3,
        'brand' => 'なし',
        'description' => '新鮮な玉ねぎ3束のセット',
        'price' => 300,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 1,
        'name' => '革靴',
        'condition' => 4,
        'brand' => '',
        'description' => 'クラシックなデザインの革靴',
        'price' => 4000,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 2,
        'name' => 'ノートPC',
        'condition' => 1,
        'brand' => '',
        'description' => '高性能なノートパソコン',
        'price' => 45000,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 2,
        'name' => 'マイク',
        'condition' => 2,
        'brand' => 'なし',
        'description' => '高音質のレコーディング用マイク',
        'price' => 8000,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 5,
        'name' => 'ショルダーバッグ',
        'condition' => 3,
        'brand' => '',
        'description' => 'おしゃれなショルダーバッグ',
        'price' => 3500,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 10,
        'name' => 'タンブラー',
        'condition' => 4,
        'brand' => 'なし',
        'description' => '使いやすいタンブラー',
        'price' => 500,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 10,
        'name' => 'コーヒーミル',
        'condition' => 1,
        'brand' => 'Starbacks',
        'description' => '手動のコーヒーミル',
        'price' => 4000,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
        'sold' => 0,
    ],
    [
        'category_id' => 4,
        'name' => 'メイクセット',
        'condition' => 2,
        'brand' => '',
        'description' => '便利なメイクアップセット',
        'price' => 2500,
        'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
        'sold' => 0,
    ],
    ];
    DB::table('items')->insert($param);
    }

}
