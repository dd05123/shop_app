<?php

namespace App\Http\Controllers;
use App\Jobs\Getproduct;
use App\Models\shopify_app;
use App\Models\shopifyproducts;
use Illuminate\Http\Request;
use Unirest\Request as Unirest;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{ 
    public $shop;

    // public function __construct(Request $request) {
    //     //dd($request->all());
    //     $this->shop = $request['shop'];
    // }
    public function index(Request $request)
    {
        $store=$request['shop'];
       $data=compact('store');
       return view('tab')->with($data);
    }
    // public function index(Request $request)
    // {
        
    
    //    return view('/index');
    // }

    public function indexes(Request $request,$store)
    {

       $store;
       $data=compact('store');
       return view('tab')->with($data);
        //return view('tab');
    }
    public function product_search(Request $request,$store)
    {
        $store;
        $query = $request->input('search');
        // echo $store;
        // die;
     //   $product_id=shopifyproducts::where('storename',$store)->value('product_id');
       // $blog_id=shopifyproducts::where('storename',$store)->value('blog_id');
     //   echo $product_id ,$blog_id;die;
        $products=shopifyproducts::where('title','LIKE','%'. $query."%")->get();
        $data=compact('store','products');
        return view('product_search')->with($data);
    }
    

    public function instructions($store)
    {
        $store;
        $data=compact('store');
        return view('instructions')->with($data);
    }
    public function showdata()
    {
        $id=$_POST['id'];
        $productdata=shopifyproducts::find($id);
        return $productdata;
        // $data=compact('productdata');
        // return view('tab')->with($data);
       // echo $id;
    }
    // public function instructions()
    // {
       
    //     return view('instructions');
    // }
    
    public function data_storage(Request $request )
    {
        // $form=new shopify_app;
         $form=$request['shop'];
        // $form->save();
         session(['shop' => $form]);
         return redirect('/redirect');
    }
    public function redirect(Request $request)
    {
       
         $this->shop=session('shop'); 
        // echo $this->shop;
        // die;
        
        $nonce = base64_decode(rand(1, 100000));
        $clientid=config('app.SHOPIFY_CLIENT_ID');
        $shopifyscope=config('app.SHOPIFY_SCOPE');
        $redirecturi=config('app.REDIRECT_URI');
        return redirect('https://'.$this->shop.'/admin/oauth/authorize?client_id='.$clientid.'&scope='.$shopifyscope.'&redirect_uri='.$redirecturi.'&state='.$nonce.'
        ');
    }
    public function gettoken(Request $request)
    {
        
        $clientid = config('app.SHOPIFY_CLIENT_ID');
        $client_secret = config('app.Client_secret');
        $code = $request->input('code');
        $this->shop=$request['shop'];
        
        $response = Http::post('https://'.$this->shop.'/admin/oauth/access_token', [
            'client_id' => $clientid,
            'client_secret' => $client_secret,
            'code' => $code,
        ]);
        
        
        if ($response->successful()) {
            $data = $response->json();
            $access_token = $data['access_token'];
            $form=new shopify_app;
            $form->storename=$this->shop;
            $form->access_token=$access_token;
            $form->save();
           
        }
         $this->appuninstall();
         $this->product_create();
         $this->product_delete();
         $this->product_update();
       // echo "webhook created";
    }
        public function get_product(Request $request,$store)
        {
           
          // $this->shop="appinfo.myshopify.com";
        
             $this->shop=$store;
            $access_token=shopify_app::where('storename',$this->shop)->value('access_token');
            $headers = array('Accept' => 'application/json', 'X-Shopify-Access-Token' => $access_token);
           $response= Http::withHeaders($headers)->get('https://'.$this->shop.'/admin/api/2023-07/products.json?limit=250');
          //  $response=Unirest::get('https://'.$this->shop.'/admin/api/2023-07/products.json?limit=250',$headers);
            // echo"<pre>";
            // print_r($response);
            // die;
            $data=$response->json();
            //  echo"<pre>";
            // print_r($data);
            // die;
            // $request->validate([
            //    "product_id"=>'unique:tbl_product,product_id'
            // ]);
            foreach($data['products'] as $productdata)
            {
            //      echo"<pre>";
            // print_r($productdata);
            // die;
                
            //              echo"<pre>";
            // print_r($data_exist);
            // die;

                   if(shopifyproducts::where('product_id',$productdata['id'])->exists())
                   {
                    echo"hello";
                   }
                   else
                   {
                    $products=new shopifyproducts();
                    $products->product_id=$productdata['id'];
                    $products->body_html=$productdata['body_html'];
                    $products->title=$productdata['title'];
                    $products->vendor=$productdata['vendor'];
                    $products->product_type=$productdata['product_type'];
                    $products->published_at=$productdata['published_at'];
                    $products->tags=$productdata['tags'];
                    $products->admin_graphql_api_id=$productdata['admin_graphql_api_id'];
                    $variantsarray=[];
                    foreach($productdata['variants'] as $variants )
                    {
                        $variantsarray[]=$variants;
                    
                    } 
                    $products->variants=json_encode($variantsarray) ;
                    $option=$productdata['options'];
                    $products->options=json_encode($option);
                    //    $image=$productdata;
                    //    echo "<pre>";
                    //    print_r( $image);die;
                    $imagearray=[];
                    foreach($productdata['images'] as $image)
                    {
                        $imagearray[]=$image;
                        if(array_key_exists(0,$imagearray))
                        {
                        $url=$productdata['images'][0]['src'];
                        $products->image=$url;
                        }
                        else
                        {
                            continue;
                        }

                    }
                
                //    echo "<pre>";
                //    print_r($products->image);
                //    die;
                
                $products->product_dump=json_encode($productdata);
                $products->storename=$this->shop;
                $products->type="Products";
                //    echo"<pre>";
                //    print_r($products->variants);
                //    die;
                    $products->save();
                    
                }
                
            }
        return redirect(route('index',['shop'=>$this->shop]));
           

        }
          
          
           public function get_blogs(Request $request,$store)
           {
              
             // $this->shop="appinfo.myshopify.com";
           
                $this->shop=$store;
               $access_token=shopify_app::where('storename',$this->shop)->value('access_token');
              $headers = array('Accept' => 'application/json', 'X-Shopify-Access-Token' => $access_token);
              $response= Http::withHeaders($headers)->get('https://'.$this->shop.'/admin/api/2023-07/blogs.json');
              // $response= Http::withHeaders($headers)->get('https://'.$this->shop.'/admin/oauth/access_scopes.json');
             //  $response=Unirest::get('https://'.$this->shop.'/admin/api/2023-07/blogs.json',$headers);
            //    echo"<pre>";
            //    print_r($response);
            //    die;
               $data=$response->json();
            //     echo"<pre>";
            //    print_r($data);
            //    die;
               
               foreach($data['blogs'] as $blogdata)
               {
               //      echo"<pre>";
               // print_r($productdata);
               // die;
                   
               //              echo"<pre>";
               // print_r($data_exist);
               // die;
            
               if(shopifyproducts::where('blog_id',$blogdata['id'])->exists())
               {
                    echo"hello";
               }
               else
               {
                       $blogs=new shopifyproducts();
                       $blogs->blog_id=$blogdata['id'];
                     //  $products->body_html=$productdata->body_html;
                       $blogs->title=$blogdata['title'];
                     //  $products->vendor=$productdata->vendor;
                    //   $products->product_type=$productdata->product_type;
                    //   $products->published_at=$productdata->published_at;
                       $blogs->tags=$blogdata['tags'];
                       $blogs->admin_graphql_api_id=$blogdata['admin_graphql_api_id'];
                    //    $variantsarray=[];
                    //    foreach($productdata->variants as $variants )
                    //    {
                    //        $variantsarray[]=$variants;
                       
                    //    } 
                    //    $products->variants=json_encode($variantsarray) ;
                    //    $option=$productdata->options;
                    //    $products->options=json_encode($option);
                       //    $image=$productdata;
                       //    echo "<pre>";
                       //    print_r( $image);die;
                    //    $imagearray=[];
                    //    foreach($productdata->images as $image)
                    //    {
                    //        $imagearray[]=$image;
                    //        if(array_key_exists(0,$imagearray))
                    //        {
                    //        $url=$productdata->images[0]->src;
                    //        $products->image=$url;
                    //        }
                    //        else
                    //        {
                    //            continue;
                    //        }
   
                    //    }
                   
                   //    echo "<pre>";
                   //    print_r($products->image);
                   //    die;
                   
                   $blogs->product_dump=json_encode($blogdata);
                   $blogs->storename=$this->shop;
                   $blogs->type='Blogs';
                   //    echo"<pre>";
                   //    print_r($products->variants);
                   //    die;
                       $blogs->save();
                    }
              }
              return redirect(route('index',['shop'=>$this->shop]));
           }
           public function get_pages(Request $request,$store)
           {
              
             // $this->shop="appinfo.myshopify.com";
           
                $this->shop=$store;
               $access_token=shopify_app::where('storename',$this->shop)->value('access_token');
              $headers = array('Accept' => 'application/json', 'X-Shopify-Access-Token' => $access_token);
              $response= Http::withHeaders($headers)->get('https://'.$this->shop.'/admin/api/2023-04/pages.json');
              // $response= Http::withHeaders($headers)->get('https://'.$this->shop.'/admin/oauth/access_scopes.json');
             //  $response=Unirest::get('https://'.$this->shop.'/admin/api/2023-07/blogs.json',$headers);
            //    echo"<pre>";
            //    print_r($response);
            //    die;
               $data=$response->json();
            //     echo"<pre>";
            //    print_r($data);
            //    die;
               
               foreach($data['pages'] as $pagedata)
               {
               //      echo"<pre>";
               // print_r($productdata);
               // die;
                   
               //              echo"<pre>";
               // print_r($data_exist);
               // die;
            
               if(shopifyproducts::where('page_id',$pagedata['id'])->exists())
               {
                    echo"hello";
               }
               else
               {
                       $pages=new shopifyproducts();
                       $pages->page_id=$pagedata['id'];
                     //  $products->body_html=$productdata->body_html;
                        $pages->body_html=$pagedata['body_html'];
                        $pages->title=$pagedata['title'];
                     //  $products->vendor=$productdata->vendor;
                    //   $products->product_type=$productdata->product_type;
                    //   $products->published_at=$productdata->published_at;
                   // $pages->tags=$pagedata['tags'];
                  //  $pages->admin_graphql_api_id=$pagedata['admin_graphql_api_id'];
                    //    $variantsarray=[];
                    //    foreach($productdata->variants as $variants )
                    //    {
                    //        $variantsarray[]=$variants;
                       
                    //    } 
                    //    $products->variants=json_encode($variantsarray) ;
                    //    $option=$productdata->options;
                    //    $products->options=json_encode($option);
                       //    $image=$productdata;
                       //    echo "<pre>";
                       //    print_r( $image);die;
                    //    $imagearray=[];
                    //    foreach($productdata->images as $image)
                    //    {
                    //        $imagearray[]=$image;
                    //        if(array_key_exists(0,$imagearray))
                    //        {
                    //        $url=$productdata->images[0]->src;
                    //        $products->image=$url;
                    //        }
                    //        else
                    //        {
                    //            continue;
                    //        }
   
                    //    }
                   
                   //    echo "<pre>";
                   //    print_r($products->image);
                   //    die;
                   
                   $pages->product_dump=json_encode($pagedata);
                   $pages->storename=$this->shop;
                   $pages->type='Pages';
                   //    echo"<pre>";
                   //    print_r($products->variants);
                   //    die;
                   $pages->save();
                    }
              }
              return redirect(route('index',['shop'=>$this->shop]));
           }
        public function appuninstall()
        {
            // echo 'hello';
           // dd($request->all());die;
            $access_token=shopify_app::where('storename',$this->shop)->value('access_token');
            $clientid=config('app.SHOPIFY_CLIENT_ID');
          //  $headers = array('Accept' => 'application/json', 'X-Shopify-Access-Token' => $access_token,'X-Shopify-API-Key' => $clientid);
          $webhookData = [
            'webhook' => [
                'topic' => 'app/uninstalled', // The webhook topic/event
               // 'address' => 'https://f04a-38-137-29-180.ngrok-free.app/shopify_project/{{route("web",["shop"=>'.$this->shop.'])}} ', // Your webhook endpoint URL
               'address' => 'https://8bc9-38-137-29-180.ngrok-free.app/shop_app/webhook?shop='.$this->shop.'',
                'format' => 'json',
            ],
        ];
                
                $webhookResponse = Http::withHeaders([
                    'X-Shopify-Access-Token' => $access_token,
                    'X-Shopify-API-Key' => $clientid,
                        ])->post("https://$this->shop/admin/api/2023-10/webhooks.json", $webhookData);

                 
        }
        public function product_create()
        {
            // echo 'hello';
           // dd($request->all());die;
            $access_token=shopify_app::where('storename',$this->shop)->value('access_token');
            $clientid=config('app.SHOPIFY_CLIENT_ID');
          //  $headers = array('Accept' => 'application/json', 'X-Shopify-Access-Token' => $access_token,'X-Shopify-API-Key' => $clientid);
          $webhookData = [
            'webhook' => [
                'topic' => 'products/create', // The webhook topic/event
               // 'address' => 'https://f04a-38-137-29-180.ngrok-free.app/shopify_project/{{route("web",["shop"=>'.$this->shop.'])}} ', // Your webhook endpoint URL
               'address' => 'https://8bc9-38-137-29-180.ngrok-free.app/shop_app/webhookproduct?shop='.$this->shop.'',
                'format' => 'json',
            ],
        ];
                
                $webhookResponse = Http::withHeaders([
                    'X-Shopify-Access-Token' => $access_token,
                    'X-Shopify-API-Key' => $clientid,
                        ])->post("https://$this->shop/admin/api/2023-10/webhooks.json", $webhookData);

                // echo "webhook created";
        }
        public function product_delete()
        {
            // echo 'hello';
           // dd($request->all());die;
            $access_token=shopify_app::where('storename',$this->shop)->value('access_token');
            $clientid=config('app.SHOPIFY_CLIENT_ID');
          //  $headers = array('Accept' => 'application/json', 'X-Shopify-Access-Token' => $access_token,'X-Shopify-API-Key' => $clientid);
          $webhookData = [
            'webhook' => [
                'topic' => 'products/delete', // The webhook topic/event
               // 'address' => 'https://f04a-38-137-29-180.ngrok-free.app/shopify_project/{{route("web",["shop"=>'.$this->shop.'])}} ', // Your webhook endpoint URL
               'address' => 'https://8bc9-38-137-29-180.ngrok-free.app/shop_app/webhookprod-del?shop='.$this->shop.'',
                'format' => 'json',
            ],
        ];
                
                $webhookResponse = Http::withHeaders([
                    'X-Shopify-Access-Token' => $access_token,
                    'X-Shopify-API-Key' => $clientid,
                        ])->post("https://$this->shop/admin/api/2023-10/webhooks.json", $webhookData);

                // echo "webhook created";
        }
        public function product_update()
        {
           
            $access_token=shopify_app::where('storename',$this->shop)->value('access_token');
            $clientid=config('app.SHOPIFY_CLIENT_ID');
          //  $headers = array('Accept' => 'application/json', 'X-Shopify-Access-Token' => $access_token,'X-Shopify-API-Key' => $clientid);
          $webhookData = [
            'webhook' => [
                'topic' => 'products/update', // The webhook topic/event
               // 'address' => 'https://f04a-38-137-29-180.ngrok-free.app/shopify_project/{{route("web",["shop"=>'.$this->shop.'])}} ', // Your webhook endpoint URL
               'address' => 'https://8bc9-38-137-29-180.ngrok-free.app/shop_app/webhookprod-upd?shop='.$this->shop.'',
                'format' => 'json',
            ],
        ];
                
                $webhookResponse = Http::withHeaders([
                    'X-Shopify-Access-Token' => $access_token,
                    'X-Shopify-API-Key' => $clientid,
                        ])->post("https://$this->shop/admin/api/2023-10/webhooks.json", $webhookData);

                // echo "webhook created";
        }
        public function webhook()
        {
           
           $shop = $_REQUEST['shop'];
           $data = file_get_contents("php://input");
           //$data = "just doing testing part";
           error_log($data ."---".$shop, 3, 'testing.log');
          //error_log($data, 3, 'testing.log');
          //echo 'done';
          shopify_app::where('storename',$shop)->delete();
          shopifyproducts::where('storename',$shop)->delete();
        }
        public function webhook_product_create()
        {
           
           $shop = $_REQUEST['shop'];
           $data = file_get_contents("php://input");
           //$data = "just doing testing part";
           error_log($data ."---".$shop, 3, 'product.log');
          
        
        }
        public function webhook_product_del(Request $request)
        {
           
           $shop = $_REQUEST['shop'];
           $prod_id=$request['id'];
           $data = file_get_contents("php://input");
           //$data = "just doing testing part";
           error_log($data ."---".$shop, 3, 'prod-del.log');
           shopifyproducts::where('product_id',$prod_id)->delete();
          
        }
        public function webhook_product_upd(Request $request)
        {
           
           $shop = $_REQUEST['shop'];
           $prod_id=$request['id'];
           $data = file_get_contents("php://input");
           //$data = "just doing testing part";
           error_log($data ."---".$shop, 3, 'prod-upd.log');
           $id=shopifyproducts::where('product_id',$prod_id)->value('id');
          if(shopifyproducts::where('product_id',$prod_id)->exists())
          {
            $product=shopifyproducts::find($id);
            $product->title=$request['title'];
            $product->body_html=$request['body_html'];
           // $product->title=$request['title'];
            $product->vendor=$request['vendor'];
            $product->product_type=$request['product_type'];
            $product->published_at=$request['published_at'];
            $product->tags=$request['tags'];
            $product->admin_graphql_api_id=$request['admin_graphql_api_id'];
            $product->variants=json_encode($request['variants']);
            // $product->save();
            // die;
            $product->options=json_encode($request['options']);
            if(!empty($request['images']))
            {     
               $url=$request['images'][0]['src'];
               $product->image=$url;
           }   
           else
           {
              $product->image=null;
           }
            //$product->image=$request['images'][0]['src'];
            $product->product_dump=json_encode($product);
            $product->type="Products";
            $product->save();
        }
           else
           {
            $product= new shopifyproducts;
            $product->product_id=$prod_id;
            $product->storename=$shop;
            $product->title=$request['title'];
            $product->body_html=$request['body_html'];
           // $product->title=$request['title'];
            $product->vendor=$request['vendor'];
            $product->product_type=$request['product_type'];
            $product->published_at=$request['published_at'];
            $product->tags=$request['tags'];
            $product->admin_graphql_api_id=$request['admin_graphql_api_id'];
            $product->variants=json_encode($request['variants']);
            // $product->save();
            // die;
            $product->options=json_encode($request['options']);
            if(!empty($request['images']))
            {     
               $url=$request['images'][0]['src'];
               $product->image=$url;
           }   
           else
           {
              $product->image=null;
           }
            $product->product_dump=json_encode($product);
            $product->type="Products";
            $product->save();
           }
       }
    

}

