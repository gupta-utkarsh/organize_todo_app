<?php	 	
	namespace View;
	use Twig_Loader_Filesystem;
	use Twig_Environment;
	class Loader{
		public static function make(){
			$twig = new Twig_Environment(new Twig_Loader_Filesystem(dirname(__FILE__).'/templates/'));
			return $twig;
		}
	}