<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = $merchant_key;

// Merchant Salt as provided by Payu
$SALT = $salt;

// End point - change to https://secure.payu.in for LIVE mode
//"https://test.payu.in";
$PAYU_BASE_URL = $url;

$action = '';
$posted = array();

if(!empty($dta)) {
    //print_r($_POST);
  foreach($dta as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}

//echo "Yo Boy Hash: ".$posted['hash']; die();
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
//echo "<pre>  ".sizeof($posted).$posted['key']."</br>"; print_r($posted); die();
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
  echo "<pre>Error"; print_r($posted); die();
    $formError = 1;
  } else {
   
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>


<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function(){
//$('#payuForm').submit();

});
</script>
<?php echo "Please wait while redirecting...";?>
<html>
  <head>
  
  </head>
  <body>
   
   
    <form action="<?php echo $action; ?>" method="post" id="payuForm" name="payuForm">
	
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          
          <td><input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" /></td>
          <td><input type="hidden" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
        </tr>
        <tr>
          
          <td><input type="hidden" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
          
          <td><input type="hidden" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
        </tr>
        <tr>
          <td colspan="3">
		  <input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?>" /></td>
        </tr>
        <tr>
          <td colspan="3"><input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td colspan="3"><input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
          
            <td colspan="4"><input id="submitform" style="display:block;" type="submit" value="Submit" /></td>
          
        </tr>
      </table>
    </form>
  </body>
</html>