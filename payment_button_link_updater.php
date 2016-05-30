<?php

/*
Author: Ashwini Chaudhary
Purpose: If you want to use Instamojo's remote checkout button on your website and you are
generating the URL on your own as well then this script will help you use that
URL with the remote checkout button so that we can pre-fill the form with data
obtained from URL.

*/

function Instamojo_remote_checkout_button_updater($new_payment_link, $payment_button_html){
    $doc = new DOMDocument();
    $doc->loadHTML($payment_button_html);
    $nodes = $doc->getElementsByTagName('a');
    foreach($nodes as $node){
        $payment_link = $node->getAttribute('href');
        break;
    }
    
    $node->setAttribute('href', $new_payment_link);
    $html = $doc->saveHTML();
    $output = Array(); 
    preg_match("/<html><body>(.*?)<\/body><\/html>/", $html, $output);
    return html_entity_decode($output[1]);
	
}

//Example input:

$button_html = '<a href="https://www.instamojo.com/ashwch/test-magento/" rel="im-checkout" data-behavior="remote" data-style="light" data-text="Checkout with Instamojo" data-token="3bcde71b220ccc7bc44dba0881894f47"></a><script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>';
$new_payment_link = 'https://www.instamojo.com/ashwch/test-magento/?embed=form&data_name=John+Doe&data_amount=10&data_Field_81088=1000-12&data_sign=8cabdae869097a53de194b45e1b6d1d673ff8134&data_email=test%40mailinator.com&data_phone=9999999990&data_readonly=data_name&data_readonly=data_amount&data_readonly=data_email&data_readonly=data_phone&data_readonly=data_Field_81088';
$new_button_html = Instamojo_remote_checkout_button_updater($new_payment_link, $button_html);

/*
echo $new_button_html;
<a href="https://www.instamojo.com/ashwch/test-magento/?embed=form&data_name=John+Doe&data_amount=10&data_Field_81088=1000-12&data_sign=8cabdae869097a53de194b45e1b6d1d673ff8134&data_email=test%40mailinator.com&data_phone=9999999990&data_readonly=data_name&data_readonly=data_amount&data_readonly=data_email&data_readonly=data_phone&data_readonly=data_Field_81088" rel="im-checkout" data-behavior="remote" data-style="light" data-text="Checkout with Instamojo" data-token="3bcde71b220ccc7bc44dba0881894f46"></a><script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>
*/


?>
