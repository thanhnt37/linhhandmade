<?php namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\UrlGenerator;
use Session;
use Redirect;

use App\Product;
use App\Post;
use App\CategoryProduct;
use DOMDocument;

class BackendController extends Controller {

   public function index(){

   	  return view('backend.index');
   }
   
  public function getCreatesitemap(){
   		  
		  $product = Product::where('status',1)->orderby('created_at','asc')->get();
		 
		  $category = CategoryProduct::orderby('created_at','asc')->get();
		  $post = Post::where('status',1)->orderby('created_at','asc')->get();
		  
		  // dd($post);
		  $doc = new DOMDocument('1.0', 'utf-8');
		  $doc->formatOutput = true;
		  $r = $doc->createElementNS("http://www.sitemaps.org/schemas/sitemap/0.9","urlset");
		 
		  $doc->appendChild( $r );
		  $r->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance' ,'xsi:schemaLocation', "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");		

		 	  $url = $doc->createElement( "url" );

			  $loc = $doc->createElement( "loc" );
			  $loc->appendChild( $doc->createTextNode( url('') ));
			  $url->appendChild( $loc );
			  $priority = $doc->createElement( "priority" );
			  $priority->appendChild($doc->createTextNode(1));
			  $url->appendChild( $priority );
			  $r->appendChild( $url );
		  // dd($category); 
		  foreach( $category as $item )
		  {
		  	  $time = strtotime($item->created_at);
		  	  $newformat = date('Y-m-d',$time);
		  		
			  $url = $doc->createElement( "url" );

			  $loc = $doc->createElement( "loc" );
			  $loc->appendChild($doc->createTextNode( route('frontend.danh-muc.san-pham',['slug'=>$item->prefix])) );
			  $url->appendChild( $loc );
			  
			  $lastmod = $doc->createElement( "lastmod" );
			  $lastmod->appendChild(
			  $doc->createTextNode( $newformat )
			  );
			  $url->appendChild( $lastmod );
			  
			  $changefreq = $doc->createElement( "changefreq" );
			  $changefreq->appendChild(
			  $doc->createTextNode('monthly')
			  );
			  $url->appendChild( $changefreq );

			  $priority = $doc->createElement( "priority" );
			  $priority->appendChild(
			  $doc->createTextNode( 0.8 )
			  );
			  $url->appendChild( $priority );

			  
			  $r->appendChild( $url );
		  }

		  foreach( $product as $item )
		  {
		  	  $time = strtotime($item->created_at);
		  	  $newformat = date('Y-m-d',$time);
		  		
			  $url = $doc->createElement( "url" );

			  $loc = $doc->createElement( "loc" );
			  $loc->appendChild($doc->createTextNode( route('frontend.san-pham.slug',['slug'=>$item->slug,'id'=>$item->id])) );
			  $url->appendChild( $loc );
			  
			  $lastmod = $doc->createElement( "lastmod" );
			  $lastmod->appendChild(
			  $doc->createTextNode( $newformat )
			  );
			  $url->appendChild( $lastmod );
			  
			  $changefreq = $doc->createElement( "changefreq" );
			  $changefreq->appendChild(
			  $doc->createTextNode('daily')
			  );
			  $url->appendChild( $changefreq );

			  $priority = $doc->createElement( "priority" );
			  $priority->appendChild(
			  $doc->createTextNode( 0.6 )
			  );
			  $url->appendChild( $priority );

			  
			  $r->appendChild( $url );
		  }
		  foreach( $post as $item )
		  {
		  	  $time = strtotime($item->created_at);
		  	  $newformat = date('Y-m-d',$time);
		  		
			  $url = $doc->createElement( "url" );

			  $loc = $doc->createElement( "loc" );
			  $loc->appendChild($doc->createTextNode( route('frontend.bai-viet.slug',['slug'=>$item->slug,'id'=>$item->id])) );
			  $url->appendChild( $loc );
			  
			  $lastmod = $doc->createElement( "lastmod" );
			  $lastmod->appendChild(
			  $doc->createTextNode( $newformat )
			  );
			  $url->appendChild( $lastmod );
			  
			  $changefreq = $doc->createElement( "changefreq" );
			  $changefreq->appendChild(
			  $doc->createTextNode('daily')
			  );
			  $url->appendChild( $changefreq );

			  $priority = $doc->createElement( "priority" );
			  $priority->appendChild(
			  $doc->createTextNode( 0.6 )
			  );
			  $url->appendChild( $priority );

			  
			  $r->appendChild( $url );
		  }

		  try {
		  	  $output =  fopen("sitemap.xml",'w');
		  	  fwrite($output, $doc->saveXML());
		  	  fclose($output);
		  } catch (Exception $e) {
		  	
		  }
		  echo "<p>Cập nhập sitemap thành công</p></br>";
		  echo "<a href='".url('sitemap.xml')."'>sitemap.xml</a>";
	}

}