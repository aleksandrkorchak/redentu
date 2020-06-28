<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class FileController extends Controller
{

    public function index(){
        return view('home');
    }

    public function store(Request $request){
        $path = $request->file('file')->getRealPath();

        $fastExcel = (new FastExcel)->withoutHeaders();
        $rows = $fastExcel->import($path);
        $rows->shift(); //Delete headers

        $categories = $rows->pluck(2)->unique()->values()->map(function ($item) {
            return ['name' => $item];
        })->toArray();
//        $result = array_fill_keys(['name'], $categories);

        echo '<pre>';
        print_r($categories);
        echo '</pre>';

        Category::insert($categories);

//        $products = $rows->map(function ($product) {
//            if (count($product) > 10){
//                if ($product[10] == ''){
//                    array_pop($product);
//                } else {
//                    array_shift($product);
////                    dd($product);
//                }
//            }
//
//            $product[8] = mb_strtolower($product[8], 'UTF-8') == 'нет' ? 0 : $product[8];
//            $product[9] = mb_strtolower($product[9], 'UTF-8') == 'есть в наличие';
//
//            return $product;
//        });
//
//        echo '<pre>';
//        print_r($products);
//        echo '</pre>';


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
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}
