<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body

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
		);
		echo 'var db = ' . Zend_Json::encode($json) . ';';
	}
	
	public function partialsAction()
	{
		
	}

}
