<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; 
use Auth;
use View;
use App\Model\PRODUCT_USER_TEMP;
use App\Model\Group1;
use App\Model\Group2;
use App\Group3;
use App\ITE_2_V_WEB_G;
use App\Model\Item;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
           view()->composer('*', function ($view) 
        {

            $arrItem_rooms = GROUP3::with('SubCategories')->orderBy('showroom_sorting')->get();

       $cat = '';

        if(!empty($_GET['cat'])){
         $cat = $_GET['cat'];

        }


        $objuser = session('objUser');
            $objuser = $objuser[0];


        $arrItem3 = ITE_2_V_WEB_G::where('BR',15)->get();

       $arrFurniture = ITE_2_V_WEB_G::where('BR',15)->where('type1','Furniture')->get();
       $arrFabrics = ITE_2_V_WEB_G::where('BR',15)->where('type1','Fabrics')->get();
       $arrAccessories = ITE_2_V_WEB_G::where('BR',15)->where('type1','Accessories')->get();
       $arrArtworks = ITE_2_V_WEB_G::where('BR',15)->where('type1','Artworks')->get();
       $arrLightining = ITE_2_V_WEB_G::where('BR',15)->where('type1','Lightining')->get();
      $view->with('objuser', $objuser );
      $arrItem = array();
       $arrPRODUCT_USER_TEMP = array();
       $arrGroup1 = array();
       $arrGroup2 = array();
       $arrGroup1x = array();
       $arrGroup3 = array();
       $arrGroup4 = array();
       $arrGroup5 = array();
       $arrGroup6 = array();
       $arrGroup7 = array();
       $objGroup1x = array();
       $objGroup3 = array();
       $objGroup4 = array();
       $objGroup5 = array();
       $objGroup6 = array();
       $objGroup7 = array();
       $arrLatestItem = array();
       $count = 0;
        $view->with('cat', $cat );
        $view->with('arrItem_rooms', $arrItem_rooms ); 
        $view->with('arrFurniture', $arrFurniture );
        $view->with('arrFabrics', $arrFabrics );
        $view->with('arrAccessories', $arrAccessories );
        $view->with('arrArtworks', $arrArtworks );
        $view->with('arrLightining', $arrLightining );
        $view->with('arrItem3', $arrItem3 ); 
        $view->with('count', $count );    
        $view->with('arrPRODUCT_USER_TEMP', $arrPRODUCT_USER_TEMP );
        $view->with('arrGroup1', $arrGroup1 );
        $view->with('arrGroup1x', $arrGroup1x );
        $view->with('arrGroup2', $arrGroup2 );
        $view->with('arrGroup3', $arrGroup3 );
        $view->with('arrGroup4', $arrGroup4 );
        $view->with('objGroup5', $objGroup5 );
        $view->with('arrGroup6', $arrGroup6 );
        $view->with('arrGroup7', $arrGroup7 );
        //$view->with('objGroup1', $objGroup1 );
        $view->with('objGroup1x', $objGroup1x );
        $view->with('objGroup3', $objGroup3 );
        $view->with('objGroup4', $objGroup4 );
        $view->with('arrGroup5', $arrGroup5 );
        $view->with('objGroup6', $objGroup6 );
        $view->with('objGroup7', $objGroup7 );
        $view->with('arrItem', $arrItem );
       // $view->with('objItem', $objItem );
         $view->with('arrLatestItem', $arrLatestItem );

        }); 
             Schema::defaultStringLength(191);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
