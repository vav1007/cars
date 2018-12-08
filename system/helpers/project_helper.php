<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*Function For Checking  the value is integer or not*/
if ( ! function_exists('num_check'))
{
	function num_check($input){
		
		return $output=(is_numeric($input) && ($input > 0)) ? 1:0;
	}
}
/*Function For Checking  the value is integer or not end*/
/*Function For Checking  valid mobile number or not*/
if ( ! function_exists('mobile_check'))
{
	function mobile_check($input){

		return $output=(is_numeric($input) && (strlen($input) ==10) && (preg_match('/^[7-9]{1}[0-9]{9}$/', $input)) ) ? 1:0;
	}
}
/*Function For Checking  valid mobile number or not end*/
/*Function For Checking  pincode*/
if ( ! function_exists('pincode_check'))
{
	function pincode_check($input){

		return $output=(is_numeric($input) && (strlen($input) == 6) && (preg_match('/^[0-9]{6}$/', $input))) ? 1:0;
	}
}
/*Function For Checking  pincode*/
/*Function For Checking  the Email Code Start*/
if ( ! function_exists('email_check'))
{
	function email_check($input){

		return $output=(filter_var($input, FILTER_VALIDATE_EMAIL)) ? 1:0;
	}
}
/*Function For Checking  the Email Code End*/

/**Validate Input String**/
if( ! function_exists('input_data'))
{
	function input_data($input)
	{
		$output=addslashes(trim($input));
		return $output;
	}
}
/**Validate Input String end**/
/**Validate Input String with lower**/
if( ! function_exists('input_data_lower'))
{
	function input_data_lower($input)
	{
		$output=addslashes(trim(strtolower($input)));
		return $output;
	}
}
/**Validate Input String with lower end**/
/**Fetch data with uc first Code Start*/
if(! function_exists('fetch_ucfirst')){
	
	function fetch_ucfirst($input){
		$output=stripslashes(ucfirst(str_replace('%20',' ',$input)));
		return  $output;
	}
}
/**Fetch data with first Code End*/
/**Fetch data with UCwords Code Start*/
if(! function_exists('fetch_ucwords')){

	function fetch_ucwords($input){
		$output=stripslashes(ucwords(str_replace('%20',' ',$input)));
		return  $output;
	}
}
/**Fetch data with UCwords Code End*/
/*Currency Converter*/
if(!function_exists('currency_convert'))
{
    function currency_convert($price)
    {
        $currency='';
        switch ($currency)
        {
            
        }
        
    }
}
//currency
if(!function_exists('currency'))
{
    function currency($currency_to,$price)
    {
        ini_set('max_execution_time', 0); 
        $currency='';
        $currency_form='INR';
        $currency_to=  strtoupper($currency_to);
        if($currency_to!='INR')
        {
            $url  = "https://www.google.com/finance/converter?a=$price&from=$currency_form&to=$currency_to";
            $data = file_get_contents($url);
            preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
            $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
            $currency=round($converted, 3);
        }
        else
        {
            $currency=$price;
        }
        return $currency;
    }
}
/*Currency Converter end*/
/*File Extension Code*/
if(!function_exists('fileExtension'))
{
    function fileExtension($filename)
    {
         $position= strrpos($filename, ".");
        if (!$position) { return ""; }
        $ext= strlen($filename)-$position;
        $extension = substr($filename,$position + 1, $ext);
        return strtolower($extension);
        
    }
}
/**Calculating difference of two dates start**/
if(! function_exists('get_datedifference')){

    function get_datedifference($todate,$fromdate,$gettype=NULL){
                        $datediff=$todate-$fromdate;
                        $res_dates=floor($datediff/(60*60*24))+1;
                       return  $res_dates;
    }
}
/**Calculating difference of two dates end**/
/**getting days,weeks and months from given days start**/
if(! function_exists('get_days_weeks_months')){

  function get_days_weeks_months($days)
    {
         if(num_check($days))
        {
            $response=array();
            $r_days=$r_weeks=$r_months=0;
            if($days < 7)
            {
                $r_days=$days;
            }
            else if($days == 7)
            {
                $r_weeks=1;
            }
            else if($days >7 && $days < 30)
            {
                $r_weeks=floor($days/7);
                $r_days=$days%7;
            }
            else if($days==30 || $days==31)
            {
                $r_months=1;
            }
            else if($days > 31)
            {
                $r_months=floor($days/30);
                $diff=$days%30;
                $r_weeks=floor($diff/7);
                $wdiff=$diff%7;
                $r_days=$wdiff;
            }
            $response=array(
                'code'=>200,
                'days'=>$r_days,
                'weeks'=>$r_weeks,
                'months'=>$r_months,
            ); 
        }
        else {
               $response=array(
                'code'=>204,
                'message'=>'Fail',
                'description'=>'Choosen dates are not correct',
            );        
        }
        return json_encode($response);
    }
}
/**getting days,weeks and months from given days end**/
//Fancy url
if(!function_exists('url_friendly'))
{
    function url_friendly($string)
    {
                   $string=  urlencode($string);
                    $replace = array( 
                                                '%20' => '+',  '%21' => '+ ', '%22' => ' ','%23' => ' ',  '%24' => ' ', '%25' => ' ',
                                                '%26' => '&',  '%27' => ' ', '%28' => ' ','%29' => ' ',  '%2A' => ' ','%2B' => ' ',
                                                '%2C' => ' ','%2D' => ' ','%2E' => ' ','%2F' => ' ','+'=>'-',
                                           ); 
                    $return_str=str_replace(array_keys($replace), array_values($replace), $string);
                    return $return_str;
                    
    }
}
if(!function_exists('url_de_friendly'))
{
    function url_de_friendly($string)
    {
        $replace = array(   '+'=>' ','-'=>' ',); 
        $return_str=str_replace(array_keys($replace), array_values($replace), $string);
        return $return_str;
    }
}
//Secure Inut
if( ! function_exists('secure_input_data'))
{
	function secure_input_data($input)
	{
		$output=addslashes(trim(strip_tags($input)));
		return $output;
	}
}

function imgconvert($img_src)
{
	$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
	return $img_str = base64_encode($imgbinary);
}

if (!function_exists('number_check')) {

    function number_check($input) {

        return $output = (is_numeric($input) && ($input >= 1)) ? 1 : 0;
    }

}

//Check input is JSON or Not
if (!function_exists('isJson')) {

    function isJson($data) {
        return is_string($data) && is_array(json_decode($data, true)) && (json_last_error() == JSON_ERROR_NONE) ? 1 : 0;
    }

}