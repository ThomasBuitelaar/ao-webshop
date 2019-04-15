<?php
use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNames = [
            'Electronics',
            'Foods',
            'Services',
            'Art',
            'Trash',
            'Living Matter',
            'Clothes',
            'Fun',
            'Stuff',
            'Weapons',
        ];
        foreach ($categoryNames as $categoryName) {
            $category = new Category;
            $category->category_name = $categoryName;
            $category->save();
        }
    }
}