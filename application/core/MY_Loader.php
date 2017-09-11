<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Loader extends CI_Loader {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	/**
	 * List of paths to load service from
	 *
	 * @var array
	 * @access protected
	 */
	protected $_ci_service_paths		= array(APPPATH);
	
	/**
	 * List of loaded services
	 *
	 * @var array
	 * @access protected
	 */
	protected $_ci_services			= array();
	
	function __construct()
    {
        parent::__construct();
    }
	
	public function service($service, $name = '', $db_conn = FALSE)
	{
		if (empty($service))
		{
			return $this;
		}
		elseif (is_array($service))
		{
			foreach ($service as $key => $value)
			{
				is_int($key) ? $this->service($value, '', $db_conn) : $this->service($key, $value, $db_conn);
			}

			return $this;
		}

		$path = '';

		// Is The service in a sub-folder? If so, parse out the filename and path.
		if (($last_slash = strrpos($service, '/')) !== FALSE)
		{
			// The path is in front of the last slash
			$path = substr($service, 0, ++$last_slash);

			// And The service name behind it
			$service = substr($service, $last_slash);
		}

		if (empty($name))
		{
			$name = $service;
		}

		if (in_array($name, $this->_ci_services, TRUE))
		{
			return $this;
		}

		$CI =& get_instance();
		if (isset($CI->$name))
		{
			show_error('The service name you are loading is the name of a resource that is already being used: '.$name);
		}

		if ($db_conn !== FALSE && ! class_exists('CI_DB', FALSE))
		{
			if ($db_conn === TRUE)
			{
				$db_conn = '';
			}

			$this->database($db_conn, FALSE, TRUE);
		}

		if ( ! class_exists('CI_Service', FALSE))
		{
			load_class('Service', 'core');
		}

		$service = ucfirst(strtolower($service));

		foreach ($this->_ci_service_paths as $mod_path)
		{
			if ( ! file_exists($mod_path.'services/'.$path.$service.'.php'))
			{
				continue;
			}

			require_once($mod_path.'services/'.$path.$service.'.php');

			$this->_ci_services[] = $name;
			$CI->$name = new $service();
			return $this;
		}

		// couldn't find The service
		show_error('Unable to locate The service you have specified: '.$service);
	}
    
}
