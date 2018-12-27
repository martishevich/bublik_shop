<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Providers;
use mysql_xdevapi\Session;
use DB;
use App\Newsletter;
use function GuzzleHttp\Promise\all;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        //$request->session()->flush();
        $product = Product::getByIds(
            $request->post('prodid', 0)
        );
        if ($product instanceof Product) {
            $count = $request->session()->get('cart.' . $product->getKey(), 0);
            $request->session()->put(
                'cart.' . $product->getKey(),
                $count + 1
                
            );
            $counter = count($request->session()->get('cart', '0'));
            $request->session()->put('counter', $counter);
        }
       
        $request->session()->save();
        $catTitle = Categories::orderBy('position')
            ->get();
        $product  = DB::table('products')->paginate(12);
        return view('posts.index', ['catTitle' => $catTitle, 'product' => $product]);
    }
    public function SendNewsletter(){
        $email = $_POST['email'];
        Newsletter::AddEmail($email);
        Mail::send('mail', function ($message) {
            $message->to('loliabombita@mail.ru', 'To web dev blog')->subject('Test mail');
            $message->from('loliabombita@mail.ru', 'Web deb blog');
        });
        if (count(Mail::failures()) > 0) {
            return view('posts.i');
        } else {
            return view('posts.infomes')->with('name', $validatedata['name']);
        }
        return redirect('show');
    }
}