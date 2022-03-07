<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\ITE_2_V_WEB_G;
use App\ite_2_name4;
use App\GROUP3;
use DB;
use Validator;
use Redirect;
use Crypt;
use App;
use Mail;
use App\Reg;
use App\firebase_users;

use App\USER_CODES;
use App\Model\ForgetPassword;
use URL;

class GeneralController extends Controller
{
	//@param Request $request
	//@return Illuminate\Http\json_decode('JsonResponse');
  

  


    public function ReadJsonApi()
    {           

        // Start Define DataProviderX and DataProviderY

        $DataProviderX = fopen('../efreshly/pic/DataProviderX.json' , "r") or die ('File doesnt exist!!');
        $XfileSize = filesize('../efreshly/pic/DataProviderX.json');
        $ProviderXfileContent = fread($DataProviderX, $XfileSize);
        $XfileClose = fclose($DataProviderX);
        $ProviderXfileContent = json_decode($ProviderXfileContent,true);

        $DataProviderY = fopen('../efreshly/pic/DataProviderY.json' , "r") or die ('File doesnt exist!!');
        $YfileSize = filesize('../efreshly/pic/DataProviderY.json');
        $ProviderYfileContent = fread($DataProviderY, $YfileSize);
        $YfileClose = fclose($DataProviderY);
        $ProviderYfileContent = json_decode($ProviderYfileContent,true);
        $fileContent = (array('ProviderXfileContent' => $ProviderXfileContent,'ProviderYfileContent' => $ProviderYfileContent));
        // End Define DataProviderX and DataProviderY

        // Start Provider Name Filter
        $provider_name = '';
        if(@$_GET['provider']){

            $provider_name = $_GET['provider'];
            if ($provider_name == 'DataProviderX') {

            $myFile = fopen('../efreshly/pic/DataProviderX.json' , "r") or die ('File doesnt exist!!');
            $fileSize = filesize('../efreshly/pic/DataProviderX.json');
            $fileContent = fread($myFile, $fileSize);
            $fileClose = fclose($myFile);
            $fileContent = json_decode(@$fileContent,true);
            
            

            }elseif ($provider_name == 'DataProviderY') {

                $myFile = fopen('../efreshly/pic/DataProviderY.json' , "r") or die ('File doesnt exist!!');
                $fileSize = filesize('../efreshly/pic/DataProviderY.json');
                $fileContent = fread($myFile, $fileSize);
                $fileClose = fclose($myFile);
                $fileContent = json_decode(@$fileContent,true);

            }
        }

        if(empty($_GET['statusCode']) && empty($_GET['currency']) && empty($_GET['balanceMin']) && empty($_GET['balanceMax']) ) {
            return $fileContent; 
        }

        // End Provider Name Filter

        $filter_array = array();

        // Start Status Code Filter
        
        $statusCode = '';
        if(@$_GET['statusCode']){
            $statusCode = $_GET['statusCode'];
            if($statusCode =='authorised'){
                
                foreach($fileContent as $objfileContent){
                    if($objfileContent['statusCode']==1){
                        $filter_array[]= $objfileContent;
                    }
                }
            }

            if($statusCode =='decline'){
                
                foreach($fileContent as $objfileContent){
                    if($objfileContent['statusCode']==2){
                        $filter_array[]= $objfileContent;
                    }
                }
            }

            if($statusCode =='refunded'){
                
                foreach($fileContent as $objfileContent){
                    if($objfileContent['statusCode']==3){
                        $filter_array[]= $objfileContent;
                    }
                }
            }
            
        }

        // End Status Code Filter

        // Start Currency Filter

        $currency = '';
        if(@$_GET['currency']){
            $currency = $_GET['currency'];
                foreach($fileContent as $objfileContent){
                    if($objfileContent['currency'] == $currency){
                        $filter_array[] = $objfileContent;

                    }
                }
        }
            
        // End Currency Filter

        // Start balanceMin & balanceMax Filter



        if (@$_GET['balanceMin'] && @$_GET['balanceMax']) {
            foreach($fileContent as $objfileContent){
                if(@$objfileContent['balance'] >= @$_GET['balanceMin'] && @$objfileContent['balance'] <= @$_GET['balanceMax']){
                        $filter_array[] = $objfileContent;
                }
            }
        }

        elseif (@$_GET['balanceMin']) {
            foreach($fileContent as $objfileContent){
                if(@$objfileContent['balance'] >= @$_GET['balanceMin']){
                    $filter_array[] = $objfileContent;
                }
            }
        }

        elseif (@$_GET['balanceMax']) {
            foreach($fileContent as $objfileContent){
                if(@$objfileContent['balance'] <= @$_GET['balanceMax']){
                    $filter_array[] = $objfileContent;
                }
            }
        }

            // End balanceMin & balanceMax Filter
 
            return $filter_array;

    }

    

   


    

     



  
  }