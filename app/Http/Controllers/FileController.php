<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class FileController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $start = microtime(true);

        $path = $request->file('file')->getRealPath();

        $fastExcel = (new FastExcel)->withoutHeaders();
        $products = $fastExcel->import($path);

        //Delete headers
        $products->shift();
        //Fix products collection
        $products->transform(function ($product) {
            if (count($product) > 10){
                if ($product[10] == ''){
                    array_pop($product);
                } else {
                    array_shift($product);
                }
            }



            return $product;
        });
        //Remove duplicates by code field
        $products = $products->unique(5)->values();


        //Add readable keys for all fields of product
//        $products->transform(function ($product) {
//            $keys = [
//                'rubric1',
//                'rubric2',
//                'category',
//                'manufacturer',
//                'name',
//                'code',
//                'description',
//                'price',
//                'guarantee',
//                'availability'
//            ];
//
//            return array_combine($keys, $product);
//        });

//        echo '<pre>';
//        print_r($products->all());
//        echo '</pre>';
//
//        dd($this->convert(memory_get_usage(true)));

//        echo '<pre>';
//        print_r($rows->all());
//        echo '</pre>';


        //Fill category table
//        if (Category::doesntExist()) {
//            $categories = $products->pluck('category')->unique()->values()->map(function ($item) {
//                return ['name' => $item];
//            })->toArray();
//
//            Category::insert($categories);
//            $categories = Category::all();
//        } else {
//            $categories = null;
//        }
//
//        //
//        $products = $products->transform(function ($product) use ($categories) {
//            //Set category id
//            if($categories){
//                $category = $categories->firstWhere('name', $product['category']);
//                $product['category'] = $category->id;
//            } else {
//                $product['category'] = Category::insertGetId(['name' => $product['category']]);
//            }
//
//            //Set guarantee
//            $product['guarantee'] = mb_strtolower($product['guarantee'], 'UTF-8') == 'нет' ? 0 : $product['guarantee'];
//
//            //Set availability
//            $product['availability'] = mb_strtolower($product['availability'], 'UTF-8') == 'есть в наличие';
//
//            return $product;
//        });


        //Fill category table
        if (Category::doesntExist()) {
            $categories = $products->pluck(2)->unique()->values()->map(function ($item) {
                return ['name' => $item];
            })->toArray();

            Category::insert($categories);
            $categories = Category::all();
        } else {
            $categories = null;
        }

        //
        $products = $products->transform(function ($product) use ($categories) {
            //Set category id
            if($categories){
                $category = $categories->firstWhere('name', $product[2]);
                $product[2] = $category->id;
            } else {
                $product[2] = Category::insertGetId(['name' => $product[2]]);
            }

            //Set guarantee
            $product[8] = mb_strtolower($product[8], 'UTF-8') == 'нет' ? 0 : $product[8];

            //Set availability
            $product[9] = mb_strtolower($product[9], 'UTF-8') == 'есть в наличие';

            return $product;
        });





//        echo '<pre>';
//        print_r($products->all());
//        echo '</pre>';

        dump($time = microtime(true) - $start);
        dump($products->count());
        dd($this->convert(memory_get_usage(true)));




        Product::insert($products->all());

//        Product::create([
//            'rubric1' => $product[0],
//            'rubric2' => $product[1],
//            'category' => Category::firstOrCreate(['name' => $product[2]])->id,
//            'manufacturer' => $product[3],
//            'name' => $product[4],
//            'code' => $product[5],
//            'description' => $product[6],
//            'price' => $product[7],
//            'guarantee' => (mb_strtolower($product[8], 'UTF-8') == 'нет') ? 0 : $product[8],
//            'availability' => (mb_strtolower($product[9], 'UTF-8') == 'есть в наличие')
//        ]);


//        dd($this->convert(memory_get_usage(true)));


        return view('home');
    }


    private function convert($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
}
