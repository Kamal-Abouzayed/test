<?php

namespace App\Http\Controllers\Users\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('userAuth:web');
    }

    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return \view('main.welcome', \compact('categories', 'products'));
    }

    public function showCategory($id)
    {
        $category = Category::find($id);

        $product = DB::table('products')->where('category_id' , $category->id)->get();

        // \dd($category,$product);

        return \view('main.show', \compact('category', 'product'));
    }

    public function cart()
    {
        if (session()->has('cart')) {
            $cart = new Cart(\session()->get('cart'));
        } else {
            $cart = null;
        }

        return view('main.cart', \compact('cart'));
    }

    public function addToCart(Product $product)
    {
        if (session()->has('cart')) {
            $cart = new Cart(\session()->get('cart'));
        } else {
            $cart = new Cart();
        }

        $cart->add($product);
        // \dd($cart);
        \session()->put('cart', $cart);
        return \redirect()->route('home')->with('success' , 'Product Added To Cart');
    }

    public function updateCart(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id, $request->qty);
        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Product updated');
    }

    public function deleteCart(Product $product)
    {
        $cart = new Cart(\session()->get('cart'));
        $cart->remove($product->id);

        if ($cart->totalQty <= 0 ) {
            \session()->forget('cart');
        } else {
            \session()->put('cart', $cart);
        }

        return \redirect()->route('cart')->with('success' , 'Product Removed From Cart');
    }

    public function payment(Request $request)
    {
        $cart = new Cart(\session()->get('cart'));
        $price = $cart->totalPrice;
        $qty = $cart->totalQty;
        $TranAmount = $price * $qty;
        $TranportalId="";
        $ReqTranportalId="id=".$TranportalId;
        $TranportalPassword="";
        $ReqTranportalPassword="password=".$TranportalPassword;
        $ReqAmount="amt=".$TranAmount;
        $TranTrackid=mt_rand();
        $ReqTrackId="trackid=".$TranTrackid;
        $ReqCurrency="currencycode=414";
        $ReqLangid="langid=USA";
        $ReqAction="action=1";
        $ResponseUrl="https://www.yourwebsite.com/PHP/GetHandlerResponse.php";
        $ReqResponseUrl="responseURL=".$ResponseUrl;
        $ErrorUrl="https://www.yourwebsite.com/PHP/result2.php";
        $ReqErrorUrl="errorURL=".$ErrorUrl;

        $ReqUdf1="udf1=test1";
        $ReqUdf2="udf2=test2";
        $ReqUdf3="udf3=test3";
        $ReqUdf4="udf4=test4";
        $ReqUdf5="udf5=test5";

        $param=$ReqTranportalId."&".$ReqTranportalPassword."&".$ReqAction."&".$ReqLangid."&".$ReqCurrency."&".$ReqAmount."&".$ReqResponseUrl."&".$ReqErrorUrl."&".$ReqTrackId."&".$ReqUdf1."&".$ReqUdf2."&".$ReqUdf3."&".$ReqUdf4."&".$ReqUdf5;


        //AES Encryption Method Starts
        function encryptAES($str,$key) {
            $str = pkcs5_pad($str);
            $encrypted = Crypt::encrypt($str,$key);
            $encrypted = base64_decode($encrypted);
            $encrypted=unpack('C*', ($encrypted));
            $encrypted=byteArray2Hex($encrypted);
            $encrypted = urlencode($encrypted);
            return $encrypted;
            }

            function pkcs5_pad ($text) {
            $blocksize = 16;
            $pad = $blocksize - (strlen($text) % $blocksize);
            return $text . str_repeat(chr($pad), $pad);
                }
            function byteArray2Hex($byteArray) {
            $chars = array_map("chr", $byteArray);
            $bin = join($chars);
            return bin2hex($bin);
            }
            //AES Encryption Method Ends


        $termResourceKey="";
        $param=encryptAES($param,$termResourceKey)."&tranportalId=".$TranportalId."&responseURL=".$ResponseUrl."&errorURL=".$ErrorUrl;

        header("Location: https://kpaytest.com.kw/kpg/PaymentHTTP.htm?param=paymentInit"."&trandata=".$param);
        exit();




        if(isset($_REQUEST['ErrorText']) || isset($_REQUEST['Error']))
        {
        $ResErrorText= $_REQUEST['ErrorText']; 	  	//Error Text/message
        $ResErrorNo = $_REQUEST['Error'];           //Error Number
        $ResTranData = null;
        } else {
        $ResErrorText= null;
        $ResErrorNo = null;
        $ResTranData= $_REQUEST['trandata'];
        }
        $ResPaymentId = $_REQUEST['paymentid'];		//Payment Id
        $ResTrackID = $_REQUEST['trackid'];       	//Merchant Track ID
        $ResResult =  $_REQUEST['result'];          //Transaction Result
        $ResPosdate = $_REQUEST['postdate'];        //Postdate
        $ResTranId = $_REQUEST['tranid'];           //Transaction ID
        $ResAuth = $_REQUEST['auth'];               //Auth Code
        $ResRef = $_REQUEST['ref'];                 //Reference Number also called Seq Number
        $ResAmount = $_REQUEST['amt'];              //Transaction Amount
        $Resudf1 = $_REQUEST['udf1'];               //UDF1
        $Resudf2 = $_REQUEST['udf2'];               //UDF2
        $Resudf3 = $_REQUEST['udf3'];               //UDF3
        $Resudf4 = $_REQUEST['udf4'];               //UDF4
        $Resudf5 = $_REQUEST['udf5'];               //UDF5

        /* Below Terminal resource Key is used to decrypt the response sent from Payment Gateway.
        Terminal Resource Key is generated while creating terminal and this the Key that is used for decrypting
        the response from PG. Please contact PGSupport@knet.com.kw to extract this key. */
        $termResourceKey="";

        /* Merchant (ME) checks, if error is NOT present,then go for decryption using required parameters */
        /* NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE */
        if($ResErrorText==null && $ResErrorNo==null && $ResTranData !=null)
        {

        //Decryption logice starts
        $decrytedData=decrypt($ResTranData,$termResourceKey);

        /* IMPORTANT NOTE - MERCHANT SHOULD UPDATE TRANACTION PAYMENT STATUS IN HIS DATABASE AT THIS POINT
        AND THEN REDIRECT CUSTOMER TO THE RESULT PAGE. */
        header("Location: https://www.yourwebsite.com/PHP/result.php?".$decrytedData);
        exit();
        }
        else{
        header("Location: https://www.yourwesbite.com/PHP/result.php?Error=".$ResErrorNo."&ErrorText=".$ResErrorText."&trackid=".$ResTrackID."&amt=".$ResAmount."&paymentid=".$ResPaymentId."&tranid=".$ResTranId."&result=".$ResResult);
        exit();
        }

        //Decryption Method for AES Algorithm Starts

        function decrypt($code,$key) {
        $code =  hex2ByteArray(trim($code));
        $code=byteArray2String($code);
        $iv = $key;
        $code = base64_encode($code);
        $decrypted = openssl_decrypt($code, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        return pkcs5_unpad($decrypted);
        }

        function hex2ByteArray($hexString) {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
        }


        function byteArray2String($byteArray) {
        $chars = array_map("chr", $byteArray);
        return join($chars);
        }

        /* function pkcs5_unpad($text) {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) {
        return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
        return false;
        }
        return substr($text, 0, -1 * $pad);
        } */

    }

    public function paymentError()
    {

        return \view('main.payment-error');
    }

    public function payStatus(Request $request)
    {
        //####### Configurations ######
        $apiKey = 'Tfwjij9tbcHVD95LUQfsOtbfcEEkw1hkDGvUbWPs9CscSxZOttanv3olA6U6f84tBCXX93GpEqkaP_wfxEyNawiqZRb3Bmflyt5Iq5wUoMfWgyHwrAe1jcpvJP6xRq3FOeH5y9yXuiDaAILALa0hrgJH5Jom4wukj6msz20F96Dg7qBFoxO6tB62SRCnvBHe3R-cKTlyLxFBd23iU9czobEAnbgNXRy0PmqWNohXWaqjtLZKiYY-Z2ncleraDSG5uHJsC5hJBmeIoVaV4fh5Ks5zVEnumLmUKKQQt8EssDxXOPk4r3r1x8Q7tvpswBaDyvafevRSltSCa9w7eg6zxBcb8sAGWgfH4PDvw7gfusqowCRnjf7OD45iOegk2iYSrSeDGDZMpgtIAzYVpQDXb_xTmg95eTKOrfS9Ovk69O7YU-wuH4cfdbuDPTQEIxlariyyq_T8caf1Qpd_XKuOaasKTcAPEVUPiAzMtkrts1QnIdTy1DYZqJpRKJ8xtAr5GG60IwQh2U_-u7EryEGYxU_CUkZkmTauw2WhZka4M0TiB3abGUJGnhDDOZQW2p0cltVROqZmUz5qGG_LVGleHU3-DgA46TtK8lph_F9PdKre5xqXe6c5IYVTk4e7yXd6irMNx4D4g1LxuD8HL4sYQkegF2xHbbN8sFy4VSLErkb9770-0af9LT29kzkva5fERMV90w';
        $apiURL = 'https://apitest.myfatoorah.com';

        //####### Prepare Data ######
        $url    = "$apiURL/v2/getPaymentStatus";
        $invoiceId = $request->invoiceId;
        $data   = array(
            'KeyType' => 'invoiceId',
            'Key'     => "$invoiceId" //the callback paymentID
        );
        $fields = json_encode($data);

        //####### Call API ######
        $curl = curl_init($url);

        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $fields,
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $res = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = \json_decode($res, true);
            \dd($result);
            return $result['Data'];
           /*  $payment = DB::table('payments')->where('invoiceId', $invoiceId)->get()->first();

            $order = new Order;
            $order->payment_id = $payment->id;
            $order->quantity = $result['Data']['quantity'];
            $order->price = $result['Data']['InvoiceValue'];
            $order->save();
            \dd($order); */

        }
    }

}
