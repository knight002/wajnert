<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initConfig()
	{
		//$this->_bootstrap('config');
		$config = new Zend_Config($this->getOptions());
		Zend_Registry::set('config', $config);
		return $config;
	}

	protected function _initDatabase()
	{
		$this->bootstrap('db');
		$resource = $this->getPluginResource('db');
		$db = $resource->getDbAdapter();

		$config = new Zend_Config($this->getOptions());
		if($config->system->useprofiler)
		{
			$profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
			$profiler->setEnabled(true);
			$db->setProfiler($profiler);
		}

		Zend_Registry::getInstance()->set('dbAdapter', $db);
		return $resource;
	}

}

