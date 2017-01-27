<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hash=NULL;

        if(Auth::check())
            $hash = Auth::user()->hash;

        return view('welcome',compact('hash'));
    }

    public function generate($hash)
    {
        if(User::where('hash',$hash)->count())
        {
            $len = rand(5,7);
            $str = str_random($len);
            $img = Image::canvas(70, 30, '#A9A9A9');
            for($i=1;$i<6;$i++)
            {
                $y1=rand(1, 30);
                $y2=rand(1,30);
                $x1=rand(1,60);
                $x2=rand(1,60);
                $img->line($x1, $y1, $x2, $y2);
            }
            $img->blur(1);
            $img->text($str,10,20,function($font){
                $face = rand(1,5);
                $font->file($face);
                $font->size(48);
                $font->angle(20);
            });
            $img->pixelate(1);
            header('Content-Type: image/png');
            return $img->response('png');

            $data = array(
                    "status"=>"Success",
                    "image"=>NULL,
                    "code"=>NULL
                );
            json_encode($data);
        }
        else
        {
            $data = array(
                    "status"=>"Hash Mismatch",
                    "image"=>NULL,
                    "code"=>NULL
                );
            json_encode($data);
        }

        return $data;
    }
}
