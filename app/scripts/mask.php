<?php
	//Not being used currently. Testing
	class Mask{
			const Salt = "Atlanta";
			public static function encode($data){
				$salted = $data.Salt;
				
			}
			public static function decode(){
			}
	}