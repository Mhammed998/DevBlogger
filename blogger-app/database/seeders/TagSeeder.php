<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tag_name' => 'Laravel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tag_name' => 'Node JS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tag_name' => 'Python',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tag_name' => 'Java',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tag_name' => 'React',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Tag::insert($data);
    }

}

