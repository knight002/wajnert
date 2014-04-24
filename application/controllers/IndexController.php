<?php

class IndexController extends Zend_Controller_Action
{

	const COMMODE = 1;
	const WARDROBE = 2;
	const BED = 3;
	
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function indexAction()
	{

	}

	public function dataAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout()->disableLayout();
		$this->_response->setHeader('Content-type', "application/javascript");

		$config = array(
			'name'		=> 'bodies',
			'primary'	=> 'id',
		);
		$bodiesTable = new Zend_Db_Table($config);
		
		$json = array(
//			'bodies'	=> $bodiesTable->fetchAll()->toArray(),
			'step2'		=> $this->getBodies(),
			'textures'	=> $this->getTextures(),
			'shelves'	=> $this->getShelves(),
		);
		//Zend_Debug::dump($json);die;
		echo 'var db = ' . Zend_Json::encode($json) . ';';
	}

	public function partialsAction()
	{
		
	}

	private function scan1()
	{
		$dirContents = scandir(APPLICATION_PATH . '/../public/images/step2');
		$arr = array();
		foreach($dirContents as $k => $v)
		{
			if(stripos(" ".$v,'.') != 1)
			{
				$exp = array_reverse(explode('.', $v));
				if($exp[0] == 'gif')
					$arr[$k] = $v;
			}
			
		}
		//Zend_Debug::dump($arr);
		return $arr;
	}
	
	private function getTextures()
	{
		$dirContents = scandir(APPLICATION_PATH . '/../public/images/textures');
		$arr = array();
		foreach($dirContents as $k => $v)
		{
			if(stripos(" ".$v,'.') != 1)
			{
				$exp = array_reverse(explode('.', $v));
				$arr[$k]['id'] = $k;
				$arr[$k]['file'] = $v;
			}
			
		}
		return $arr;
	}
	
	private function getShelves()
	{
		$dirContents = scandir(APPLICATION_PATH . '/../public/images/shelves');
		$arr = array();
		foreach($dirContents as $k => $v)
		{
			if(stripos(" ".$v,'.') != 1)
			{
				$exp = array_reverse(explode('.', $v));
				$arr[$k]['id'] = $k;
				$arr[$k]['file'] = $v;
			}
			
		}
		return $arr;
	}
	
	private function getBodies()
	{
		//types: wardrobe, bed, commode
		
		// action body
		$wardrobeParams = array(
			'fronts'	=> array(
				array(
					'x'	=> 0,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 270,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 270,
					't'	=> null,
				),
				array(
					'x'	=> 127,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 270,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 270,
					't'	=> null,
				),
			),
			'acc'		=> array(
				
			),
		);
		
		$wardrobeParams2 = array(
			'fronts'	=> array(
				array(
					'x'	=> 0,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 127,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 153,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 155,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 155,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 184,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 184,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 213,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 213,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 213,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 242,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 242,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 242,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
			),
			'acc'		=> array(
				
			),
		);
		
		$wardrobeParams3 = array(
			'fronts'	=> array(
				array(
					'x'	=> 0,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 127,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 153,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 155,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 155,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 155,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 184,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 184,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 184,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 213,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 213,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 213,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 0,
					'y'	=> 242,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 242,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 242,
					'w'	=> 62,
					'h'	=> 27,
					't'	=> null,
				),
			),
			'acc'		=> array(
				
			),
		);
		
		$wardrobeParams4 = array(
			'fronts'	=> array(
				array(
					'x'	=> 0,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 270,
					't'	=> null,
				),
				array(
					'x'	=> 64,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 127,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 153,
					't'	=> null,
				),
				array(
					'x'	=> 190,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 270,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 64,
					'y'	=> 155,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 64,
					'y'	=> 184,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 64,
					'y'	=> 213,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
				////////
				array(
					'x'	=> 64,
					'y'	=> 242,
					'w'	=> 124,
					'h'	=> 27,
					't'	=> null,
				),
			),
			'acc'		=> array(
				
			),
		);
		
		$bodies = array(
			array(
				'id'		=> 1,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F1',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F1_h270.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
			array(
				'id'		=> 2,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F2',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F2_h270.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams2,
			),
			array(
				'id'		=> 3,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F3',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F3_h270.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams3,
			),
			array(
				'id'		=> 4,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F4',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F4_h270.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams4,
			),
			
			array(
				'id'		=> 11,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F1',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F1_h270.gif',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
			array(
				'id'		=> 12,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F2',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F2_h270.gif',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams2,
			),
			array(
				'id'		=> 13,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F3',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F3_h270.gif',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams3,
			),
			array(
				'id'		=> 14,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F4',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F4_h270.gif',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams4,
			),
			
			array(	//SOME OTHER ELEMENT
				'id'		=> 33,
				'file'		=> 'SZF konf 2.gif',
				'file2'		=> 'you1.jpg',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
//			array(
//				'id'		=> 3,
//				'file'		=> 'SZF konf 3.gif',
//				'file2'		=> 'F3.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
//			array(
//				'id'		=> 4,
//				'file'		=> 'SZF konf 4.gif',
//				'file2'		=> 'F4.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
//			array(
//				'id'		=> 5,
//				'file'		=> 'SZF konf 5.gif',
//				'file2'		=> 'F5.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
//			array(
//				'id'		=> 6,
//				'file'		=> 'SZF konf 6.gif',
//				'file2'		=> 'F6.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),			
		);
		
		//Zend_Debug::dump($bodies);
		return $bodies;
	}

	public function test1Action()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout()->disableLayout();
	}

}

