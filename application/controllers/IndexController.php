<?php

/**

types: [front dlugi, front krotki, czolo dlugie, czolo krotkie, polka, uchwyt, ]



positions(id, x, y, w, h, type, handles_positions)

textures(id, type, texture, allow_outside_placeholder, allow_on_placeholder, allow_inside_placeholder )

items(id, outside_positions, on_positions, inside_positions, name, color, [scheme file], [outside file], [inside file])


podzial:
pozycje prontow
pozycje uchwytow
pozycje akcesoriow



4:
a, b, c, d

lista pozycji dla danego typu i przypisanej do danej szafy
lista tekstur danego typu

type - front dlugie
id - id sprecyzowane w szafie
textures(type, id)


 */

class Data{
	public $rawItem = array(
		'id'	=> 1,
		'name'	=> 'szafa 200 F1',
		'color'	=> '000000',
		'file1'	=> 'sheme file 1.gif',
		'file2'	=> 'outside file 1.gif',
		'file3'	=> 'inside file 1.gif',

		//positions:
		'outsides'	=> array(
			1,2,3,4
		),
		'onsides'	=> array(
			5,6,7
		),
		'insides'	=> array(
			8,9
		),
	);
}

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

		$json = $this->prepareData();
		//Zend_Debug::dump($json);die;
		echo 'var db = ' . Zend_Json::encode($json) . ';';
	}
	
	private function prepareData()
	{
//		$config = array(
//			'name'		=> 'bodies',
//			'primary'	=> 'id',
//		);
//		$bodiesTable = new Zend_Db_Table($config);
		
		$json = array(
//			'bodies'	=> $bodiesTable->fetchAll()->toArray(),
			'step2'		=> $this->getBodies(),
			'textures'	=> $this->getTextures(),
			'shelves'	=> $this->getShelves(),
			'handles'	=> $this->getHandles(),
			'accessories'	=> $this->getAccessories(),
		);
		return $json;
	}

	private function getFilesInDir($path)
	{
		$dirContents = scandir($path);
		$arr = array();
		foreach($dirContents as $k => $v)
		{
			if(stripos(" ".$v,'.') != 1)
			{
				if(is_file($path.$v))
				{
					$exp = explode('.', $v);
					$expRev = array_reverse(explode('.', $v));
					$arr[$k]['id'] = $k;
					$arr[$k]['drag'] = true;
					$arr[$k]['file'] = $v;
					$arr[$k]['name'] = $exp[0];
				}
			}
			
		}
		return $arr;
	}
	
	private function getTextures()
	{
		return $this->getFilesInDir(APPLICATION_PATH . '/../public/images/textures/');
	}
	
	private function getShelves()
	{
		$path = APPLICATION_PATH . '/../public/images/shelves/';
		return $this->getFilesInDir($path);
	}
	
	private function getHandles()
	{
		$path = APPLICATION_PATH . '/../public/images/handles/';
		return $this->getFilesInDir($path);
	}
	
	private function getAccessories()
	{
		$path = APPLICATION_PATH . '/../public/images/accessories/000000/';
		$arr1 = $this->getFilesInDir($path);
		$path = APPLICATION_PATH . '/../public/images/accessories/ffffff/';
		$arr2 = $this->getFilesInDir($path);
		return array(
			'000000'	=> $arr1,
			'ffffff'	=> $arr2,
		);
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
					'type'	=> 'VL',
					'handles'	=> array(
						array(
							'x'	=> 62/2-31/2+0,
							'y'	=> 270/2-10/2+0,
							'w'	=> 31,
							'h'	=> 10,
						)
					),
				),
				array(
					'x'	=> 64,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 270,
					't'	=> null,
					'handles'	=> array(
						array(
							'x'	=> 62/2-31/2+64,
							'y'	=> 270/2-10/2+0,
							'w'	=> 31,
							'h'	=> 10,
						)
					),
				),
				array(
					'x'	=> 127,
					'y'	=> 0,
					'w'	=> 61,
					'h'	=> 270,
					't'	=> null,
					'handles'	=> array(
						array(
							'x'	=> 62/2-31/2+127,
							'y'	=> 270/2-10/2+0,
							'w'	=> 31,
							'h'	=> 10,
						)
					),
				),
				array(
					'x'	=> 190,
					'y'	=> 0,
					'w'	=> 62,
					'h'	=> 270,
					't'	=> null,
					'handles'	=> array(
						array(
							'x'	=> 62/2-31/2+190,
							'y'	=> 270/2-10/2+0,
							'w'	=> 31,
							'h'	=> 10,
						)
					),
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
			'shelves'	=> array(
				array(
					'x'	=> 64,
					'y'	=> 155,
					'w'	=> 124,
					'h'	=> 27+27+2,
					't'	=> null,
				),
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

		$wardrobeParams5 = array(
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
			'shelves'	=> array(
				array(
					'x'	=> 64,
					'y'	=> 155,
					'w'	=> 124,
					'h'	=> 27+27+2,
					't'	=> null,
				),
			),
		);
		
		$bodies = array(
			array(
				'id'		=> 1,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F1',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F1_h270.gif',
				'interior'	=> 'SZF.200 K5.jpg',
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
				'interior'	=> 'SZF.200 Kx.jpg',
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
				'interior'	=> 'SZF.200 Kx.jpg',
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
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams4,
			),
			array(
				'id'		=> 5,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F5',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F5_h270.gif',
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams5,
			),
			
			array(
				'id'		=> 11,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F1',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F1_h270.gif',
				'interior'	=> 'SZF.200 K5.jpg',
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
				'interior'	=> 'SZF.200 Kx.jpg',
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
				'interior'	=> 'SZF.200 Kx.jpg',
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
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams4,
			),
			array(
				'id'		=> 15,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F5',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F5_h270.gif',
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams5,
			),
			
//			array(	//SOME OTHER ELEMENT
//				'id'		=> 33,
//				'file'		=> 'SZF konf 2.gif',
//				'file2'		=> 'you1.jpg',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
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
		Zend_Debug::dump($this->prepareData());
	}

}

