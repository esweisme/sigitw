<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;


class toolController extends Controller
{
    public function removeScript()
    {

        // $input = '<script>alert("Harmful Script");</script> <p style="border:1px solid black" class="text-gray-700">Test</p>';
        // $cleaned = Purify::clean($input);


        $posts = DB::table('wp_posts')
        ->where('post_content', 'like', '%<script>%')
        ->get();

        

        foreach ($posts as $post) {

            $cleaned = Purify::clean($post->post_content);
            
            DB::table('wp_posts')
            ->where('ID', $post->ID) 
            ->update(['post_content' => $cleaned]);
            
        }
        

    }
}
