<?php

namespace Database\Seeders;

use App\Models\Languages;
use App\Models\Levels;
use App\Models\Students;
use App\Models\Subjects;
use App\Models\TeacherLanguages;
use App\Models\TeacherLevels;
use App\Models\Teachers;
use App\Models\TeacherSubjects;
use Database\Factories\LanguagesFactory;
use Database\Factories\TeachersFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Languages::create([
        //     'language' => 'english'
        // ]);
        // Languages::create([
        //     'language' => 'arablic'
        // ]);
        // Languages::create([
        //     'language' => 'franch'
        // ]);

        // for ($i=0;$i<=12;$i++){
        //     Levels::create([
        //         'level' => $i
        //     ]);
        // }

        // Subjects::truncate();
        // $subjects=['math','sciences','physics','chemistry','english','arabic','social studies','programming'];
        
        // for ($i=0;$i<9;$i++){
        //     Subjects::create([
        //         'name' => $subjects[$i]
        //     ]);
        // }

        // Teachers::factory(10)->create();
        Students::factory(100)->create();
    }
}
