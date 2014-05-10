<?php

/**

types: [front dlugi, front krotki, czolo dlugie, czolo krotkie, polka, uchwyt, ]



positions(id, x, y, w, h, type, handles_positions)

textures(id, type, texture, allow_outside_placeholder, allow_on_placeholder, allow_inside_placeholder )


outside_positions - dostepne pozycje frontow dla danej szafy(tablica z id zdefiniowanych pozycji)
on_positions - dostepne pozycje dla klamek i elementow na frontach(tablica z id zdefiniowanych pozycji)
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
	
	const TYPE_NARROW_LONG = 'nl';
	const TYPE_NARROW_MEDIUM = 'nm';
	const TYPE_NARROW_SHORT = 'ns';
	const TYPE_WIDE_SHORT = 'ws';
	
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
		
		$accessories_ffffff = array(
			array(
				'id'	=> 1,
				'name'	=> 'SZUF.50.2S.BL',
				'file'	=> 'SZUF.50.2S.BL.gif',
				'file2'	=> 'SZUF 50 2S.png',
				'color'	=> 'ffffff',
				'drag'	=> true,
				'mountings'	=> array(
					array(
						'x'		=> 2,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 63,
					),
					array(
						'x'		=> 64,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 63,
					),
					array(
						'x'		=> 127,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 63,
					),
					array(
						'x'		=> 190,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 63,
					),
				),
				
			),
			array(
				'id'	=> 2,
				'name'	=> 'SZUF.50.3S.BL',
				'file'	=> 'SZUF.50.3S.BL.gif',
				'file2'	=> 'SZUF 50 3S.png',
				'color'	=> 'ffffff',
				'drag'	=> true,
				'mountings'	=> array(
					array(
						'x'		=> 2,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
					array(
						'x'		=> 64,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
					array(
						'x'		=> 127,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
					array(
						'x'		=> 190,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
				),
				
			),
			array(
				'id'	=> 3,
				'name'	=> 'KSZ.50.3S',
				'file'	=> 'KSZ.50.3S.gif',
				'file2'	=> 'KSZ.50.3S.png',
				'color'	=> 'ffffff',
				'drag'	=> true,
				'mountings'	=> array(
					array(
						'x'		=> 0,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
					array(
						'x'		=> 64,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
					array(
						'x'		=> 127,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
					array(
						'x'		=> 190,
						'y'		=> 155,
						'w'		=> 62,
						'h'		=> 111,
					),
				),
				
			),
			array(
				'id'	=> 4,
				'name'	=> 'POL.5.BL',
				'file'	=> 'POL.5.BL.gif',
				'file2'	=> 'POL 5.png',
				'color'	=> 'ffffff',
				'drag'	=> true,
				'mountings'	=> array(
					array(
						'x'		=> 4,
						'y'		=> 32,
						'w'		=> 58,
						'h'		=> 234,
					),
					array(
						'x'		=> 64,
						'y'		=> 32,
						'w'		=> 58,
						'h'		=> 234,
					),
					array(
						'x'		=> 127,
						'y'		=> 32,
						'w'		=> 58,
						'h'		=> 234,
					),
					array(
						'x'		=> 190,
						'y'		=> 32,
						'w'		=> 58,
						'h'		=> 234,
					),
				),
				
			),
		);
		
		//czarne
		$accessories_000000 = $accessories_ffffff;
		foreach($accessories_000000 as $k => &$v)
		{
			$v['name'] = str_ireplace('.BL', '.CZ', $v['name']);
			$v['file'] = str_ireplace('.BL', '.CZ', $v['file']);
		}
		
		$path = APPLICATION_PATH . '/../public/images/accessories/000000/';
		$arr1 = $this->getFilesInDir($path);
		$path = APPLICATION_PATH . '/../public/images/accessories/ffffff/';
		$arr2 = $this->getFilesInDir($path);
		return array(
			'000000'	=> $accessories_000000,
			'ffffff'	=> $accessories_ffffff,
		);
	}
	
	private function getBodies()
	{
		$A1LN = array(
			'x'	=> 0,
			'y'	=> 0,
			'w'	=> 62,
			'h'	=> 270,
			't'	=> null,
		);
		
		$B1LN = array(
			'x'	=> 64,
			'y'	=> 0,
			'w'	=> 61,
			'h'	=> 270,
			't'	=> null,
		);
		
		$C1LN = array(
			'x'	=> 127,
			'y'	=> 0,
			'w'	=> 61,
			'h'	=> 270,
			't'	=> null,
		);
		
		$D1LN = array(
			'x'	=> 190,
			'y'	=> 0,
			'w'	=> 62,
			'h'	=> 270,
			't'	=> null,
		);
		
		$A1MN = array(
			'x'	=> 0,
			'y'	=> 0,
			'w'	=> 62,
			'h'	=> 153,
			't'	=> null,
		);
		$B1MN = array(
			'x'	=> 64,
			'y'	=> 0,
			'w'	=> 61,
			'h'	=> 153,
			't'	=> null,
		);
		$C1MN = array(
			'x'	=> 127,
			'y'	=> 0,
			'w'	=> 61,
			'h'	=> 153,
			't'	=> null,
		);
		$D1MN = array(
			'x'	=> 190,
			'y'	=> 0,
			'w'	=> 62,
			'h'	=> 153,
			't'	=> null,
		);
				
		$A6SN = array(
			'x'	=> 0,
			'y'	=> 155,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$B6SN = array(
			'x'	=> 64,
			'y'	=> 155,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$C6SN = array(
			'x'	=> 127,
			'y'	=> 155,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$D6SN = array(
			'x'	=> 190,
			'y'	=> 155,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		
		$A7SN = array(
			'x'	=> 0,
			'y'	=> 184,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$B7SN = array(
			'x'	=> 64,
			'y'	=> 184,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$C7SN = array(
			'x'	=> 127,
			'y'	=> 184,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$D7SN = array(
			'x'	=> 190,
			'y'	=> 184,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		
		$A8SN = array(
			'x'	=> 0,
			'y'	=> 213,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$B8SN = array(
			'x'	=> 64,
			'y'	=> 213,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$C8SN = array(
			'x'	=> 127,
			'y'	=> 213,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$D8SN = array(
			'x'	=> 190,
			'y'	=> 213,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		
		$A9SN = array(
			'x'	=> 0,
			'y'	=> 242,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$B9SN = array(
			'x'	=> 64,
			'y'	=> 242,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$C9SN = array(
			'x'	=> 127,
			'y'	=> 242,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		$D9SN = array(
			'x'	=> 190,
			'y'	=> 242,
			'w'	=> 62,
			'h'	=> 27,
			't'	=> null,
		);
		
		
		$B6SW = array(
			'x'	=> 64,
			'y'	=> 155,
			'w'	=> 124,
			'h'	=> 27,
			't'	=> null,
		);
		$B7SW = array(
			'x'	=> 64,
			'y'	=> 184,
			'w'	=> 124,
			'h'	=> 27,
			't'	=> null,
		);
		$B8SW = array(
			'x'	=> 64,
			'y'	=> 213,
			'w'	=> 124,
			'h'	=> 27,
			't'	=> null,
		);
		$B9SW = array(
			'x'	=> 64,
			'y'	=> 242,
			'w'	=> 124,
			'h'	=> 27,
			't'	=> null,
		);
		
		//types: wardrobe, bed, commode
		
		// action body
		$wardrobeParams = array(
			'fronts'	=> array(
				$A1LN, $B1LN, $C1LN, $D1LN,
			),
			'acc'		=> array(
				
			),
		);
		
		$wardrobeParams2 = array(
			'fronts'	=> array(
				$A1MN, $B1MN, $C1MN, $D1MN,
				$A6SN, $D6SN,
				$A7SN, $D7SN,
				$A8SN, $B8SW, $D8SN,
				$A9SN, $B9SW, $D9SN,
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
				$A1MN, $B1MN, $C1MN, $D1MN,
				$A6SN, $B6SW, $D6SN,
				$A7SN, $B7SW, $D7SN,
				$A8SN, $B8SW, $D8SN,
				$A9SN, $B9SW, $D9SN,
			),
			'acc'		=> array(
				
			),
		);
		
		$wardrobeParams4 = array(
			'fronts'	=> array(
				$A1LN, $B1MN, $C1MN, $D1LN,
				$B6SW,
				$B7SW,
				$B8SW,
				$B9SW,
			),
			'acc'		=> array(
				
			),
		);

		$wardrobeParams5 = array(
			'fronts'	=> array(
				$A1LN, $B1MN, $C1MN, $D1LN,
				$B8SW,
				$B9SW,
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
		
		$wardrobeParams6 = array(
			'fronts'	=> array(
				$A1MN, $B1LN, $C1LN, $D1MN,
				$A6SN, $D6SN,
				$A7SN, $D7SN,
				$A8SN, $D8SN,
				$A9SN, $D9SN,
			),
			'acc'		=> array(
				
			),
		);
		
		$wardrobeParams7 = array(
			'fronts'	=> array(
				$A1MN, $B1MN, $C1MN, $D1MN,
				$A6SN, $B6SN, $C6SN, $D6SN, 
				$A7SN, $B7SN, $C7SN, $D7SN, 
				$A8SN, $B8SN, $C8SN, $D8SN, 
				$A9SN, $B9SN, $C9SN, $D9SN, 
			),
			'acc'		=> array(
				
			),
		);
		
		$wardrobeParams8 = array(
			'fronts'	=> array(
				$A1LN, $B1MN, $C1MN, $D1LN,
				$B6SN, $C6SN, 
				$B7SN, $C7SN, 
				$B8SN, $C8SN, 
				$B9SN, $C9SN, 
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
				'id'		=> 6,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F6',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F6_h270.gif',
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams6,
			),
			array(
				'id'		=> 7,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F7',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F7_h270.gif',
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> '000000',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams7,
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
			array(
				'id'		=> 16,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F6',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F6_h270.gif',
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams6,
			),
			array(
				'id'		=> 17,
				'parent'	=> 1,
				'name'		=> 'Szafa 200 F7',
				'file'		=> 'SZF-200.gif',
				'file2'		=> 'F7_h270.gif',
				'interior'	=> 'SZF.200 Kx.jpg',
				'color'		=> 'ffffff',
				'type'		=> self::WARDROBE,
				'params'	=> $wardrobeParams7,
			),
			
//			array(	//SOME OTHER ELEMENT
//				'id'		=> 32,
//				'file'		=> 'SZF konf 2.gif',
//				'file2'		=> 'you1.jpg',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
//			array(
//				'id'		=> 33,
//				'file'		=> 'SZF konf 3.gif',
//				'file2'		=> 'F3.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
//			array(
//				'id'		=> 34,
//				'file'		=> 'SZF konf 4.gif',
//				'file2'		=> 'F4.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
//			array(
//				'id'		=> 35,
//				'file'		=> 'SZF konf 5.gif',
//				'file2'		=> 'F5.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),
//			array(
//				'id'		=> 66,
//				'file'		=> 'SZF konf 6.gif',
//				'file2'		=> 'F6.gif',
//				'color'		=> '000000',
//				'type'		=> self::WARDROBE,
//				'params'	=> $wardrobeParams,
//			),			
		);
		
		foreach($bodies as $k => &$body)
		{
			//adjust handles
			foreach($body['params']['fronts'] as $k2 => &$front)
			{
				$fx = $front['x'];
				$fy = $front['y'];
				$fw = $front['w'];
				$fh = $front['h'];
				
				if($fh > 260 && $fh < 280 && $fw > 50 && $fw < 70)
				{
					$front['type'] = self::TYPE_NARROW_LONG;
					$front['handles'][] = array(
						'x'	=> $fw/2-31/2+$fx,
						'y'	=> $fh/2-10/2+$fy,
						'w'	=> 31,
						'h'	=> 10,
					);
					
					$front['handles'][] = array(
						'x'	=> $fw - 11.54-10/2+$fx,
						'y'	=> $fh/2+$fy,
						'w'	=> 10,
						'h'	=> 98,
					);
				}
				elseif($fh > 150 && $fh < 160 && $fw > 50 && $fw < 70)
				{
					$front['type'] = self::TYPE_NARROW_MEDIUM;
					$front['handles'][] = array(
						'x'	=> $fw/2-31/2+$fx,
						'y'	=> $fh*0.8-10/2+$fy,
						'w'	=> 31,
						'h'	=> 10,
					);
				}
				elseif($fh > 20 && $fh < 30 && $fw > 50 && $fw < 70)
				{
					$front['type'] = self::TYPE_NARROW_SHORT;
					$front['handles'][] = array(
						'x'	=> $fw/2-31/2+$fx,
						'y'	=> $fh/2-10/2+$fy,
						'w'	=> 31,
						'h'	=> 10,
					);
				}
				elseif($fh > 20 && $fh < 30 && $fw > 120 && $fw < 130)	//small wide //124 / 27
				{
					$front['type'] = self::TYPE_WIDE_SHORT;
					$front['handles'][] = array(
						'x'	=> $fw/2-31/2+$fx - 31,
						'y'	=> $fh/2-10/2+$fy,
						'w'	=> 31,
						'h'	=> 10,
					);
					$front['handles'][] = array(
						'x'	=> $fw/2-31/2+$fx + 31,
						'y'	=> $fh/2-10/2+$fy,
						'w'	=> 31,
						'h'	=> 10,
					);
				}
			}
			
			//adjust front types
			foreach($body['params']['fronts'] as $k2 => &$front)
			{
				$fx = $front['x'];
				$fy = $front['y'];
				$fw = $front['w'];
				$fh = $front['h'];
				
				if($fh > 260 && $fh < 280 && $fw > 50 && $fw < 70)
				{
					$front['type'] = self::TYPE_NARROW_LONG;
				}
				elseif($fh > 150 && $fh < 160 && $fw > 50 && $fw < 70)
				{
					$front['type'] = self::TYPE_NARROW_MEDIUM;
				}
				elseif($fh > 20 && $fh < 30 && $fw > 50 && $fw < 70)
				{
					$front['type'] = self::TYPE_NARROW_SHORT;
				}
				elseif($fh > 20 && $fh < 30 && $fw > 120 && $fw < 130)	//small wide //124 / 27
				{
					$front['type'] = self::TYPE_WIDE_SHORT;
				}
			}
		}
		
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

