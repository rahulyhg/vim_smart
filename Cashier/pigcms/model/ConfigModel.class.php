<?php bpBase::loadSysClass('model', '', 0);class ConfigModel extends model {
	public function __construct() 
	{$this->table_name = 'config';parent::__construct();
	}
	public function getlist()
	{
		return '123';
	}
	}
	?>