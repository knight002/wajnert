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
//wal sie na ryj
//nie nawidze cie
	
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
			'bodies'	=> $bodiesTable->fetchAll()->toArray(),
			'step2'		=> $this->getBodies(),
			'textures'	=> $this->getTextures(),
		);
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
	
	private function getBodies()
	{
		//types: wardrobe, bed, commode
		$body = array(
			'id'		=> 1,
			'file'		=> 'SZF 200.gif',
			'color'		=> '000000',
			'params'	=> array(),
			'type'		=> self::WARDROBE,
		);
		
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
		
		$bodies = array(
			array(
				'id'		=> 1,
				'file'		=> 'SZF 200.gif',
				'file2'		=> 'F1_h270.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
			array(
				'id'		=> 2,
				'file'		=> 'SZF konf 2.gif',
				'file2'		=> 'F2.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
			array(
				'id'		=> 3,
				'file'		=> 'SZF konf 3.gif',
				'file2'		=> 'F3.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
			array(
				'id'		=> 4,
				'file'		=> 'SZF konf 4.gif',
				'file2'		=> 'F4.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
			array(
				'id'		=> 5,
				'file'		=> 'SZF konf 5.gif',
				'file2'		=> 'F5.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),
			array(
				'id'		=> 6,
				'file'		=> 'SZF konf 6.gif',
				'file2'		=> 'F6.gif',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams,
			),			
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

