<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Masters\Departments;
use App\Models\Masters\HelpMenu;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "EGP1"],
            ['name' => "EGP4"],
            ['name' => "EGP7"],
            ['name' => "FSML"],
            ['name' => "STML"],
        ]; 
        Departments::insert($data); 

        $data_help = [
            ['title' => "What does LOREM mean?","description"=> "‘Lorem ipsum dolor sit amet, consectetur adipisici elit…’ (complete text) is dummy text that is not meant to mean anything. It is used as a placeholder in magazine layouts, for example, in order to give an impression of the finished document. The text is intentionally unintelligible so that the viewer is not distracted by the content. The language is not real Latin and even the first word ‘Lorem’ does not exist. It is said that the lorem ipsum text has been common among typesetters since the 16th century"],
            ['title' => "Where can I find your disclaimer and data privacy?","description"=>"All data will be treated as strictly confidential and will not be disclosed to third parties. Take a look on our disclaimer and Privacy Policy."],
            ['title' => "Where can in edit my name?","description"=>"If you created a new account after or while ordering you can edit both addresses (for billing and shipping) in your customer account."],
            ['title' => "Why is lorem ipsum use","description"=>"The Lorem Ipsum text is used to fill spaces designated to host texts that have not yet been published. They use programmers, graphic designers, typographers to get a real impression of the digital / advertising / editorial product they are working on."],
            ['title' => "What does LOREM mean?","description"=>"‘Lorem ipsum dolor sit amet, consectetur adipisici elit…’ (complete text) is dummy text that is not meant to mean anything. It is used as a placeholder in magazine layouts, for example, in order to give an impression of the finished document. The text is intentionally unintelligible so that the viewer is not distracted by the content. The language is not real Latin and even the first word ‘Lorem’ does not exist. It is said that the lorem ipsum text has been common among typesetters since the 16th century"],
            ['title' => "Where can I find your disclaimer and data privacy?","description"=>"All data will be treated as strictly confidential and will not be disclosed to third parties. Take a look on our disclaimer and Privacy Policy."],
            ['title' => "Where can in edit my name?","description"=>"If you created a new account after or while ordering you can edit both addresses (for billing and shipping) in your customer account."],
            ['title' => "Why is lorem ipsum use","description"=>"The Lorem Ipsum text is used to fill spaces designated to host texts that have not yet been published. They use programmers, graphic designers, typographers to get a real impression of the digital / advertising / editorial product they are working on."],
        ];
        HelpMenu::insert($data_help);
    }
}