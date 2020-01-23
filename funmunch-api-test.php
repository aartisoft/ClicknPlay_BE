<?php 
			echo $cb				= substr(md5(uniqid('', 1)), 0, 8);
			$accessTokenApi	= 'http://play.funmunch.mobi/md5.php?uu_id='.$cb;
			$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $accessTokenApi);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
            $result = curl_exec($ch) ;
            curl_close($ch);
			$rozerRes	= json_decode($result,true);

			echo '<pre>';print_r($rozerRes);

			$callBackEncoded	= urlencode('http://funmunch.mobi');
			echo $url		= 'http://menadcb.etracker.cc/MENADCB/DCBPaymentService/InitiateRequest?AccessToken='.$rozerRes['token'].'&Language=1&CountryId=21&ServiceName=FunMunch&Price=5.00&SubscriptionCycle=2&RefId='.$cb.'&CallBackUrl='.$callBackEncoded.'&FreeTrial=False';
			die;

			//header('Location: '.$url);
			//exit;
			//echo $url;die;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
            $result = curl_exec($ch) ;
            curl_close($ch);
            echo '<pre>';print_r($result);die;
			//exit;


?>