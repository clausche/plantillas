<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}
	function callback_to_capAsunto()
	{
		return '<input type="text" name="fieldname" style="text-transform:uppercase;">';
	}


	public function mision_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('mision');
			$crud->columns('localidad', 'mision');
			$crud->display_as('localidad','localidad')
				 ->display_as('mision','Misión');
			$crud->set_subject('Misiones');
			

			$output = $crud->render();

			$this->_example_output($output);
	}
	
	

	public function plantillas_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			//$crud->set_theme('datatables');
			//$crud->set_theme('twitter-bootstrap');
			$crud->set_table('plantillas');
			$crud->set_relation_n_n('remitentes', 'mision_remitente', 'mision', 'planilla_id', 'mision_id', '{localidad} - {mision} - {firma}');
			//$crud->set_relation_n_n('misiones', 'mision_remitente', 'mision', 'planilla_id', 'mision_id', 'mision');
			
			$crud->columns('numero','remitentes','asunto','fecha_documento','anexo','fecha_recibido','relacionado_por');
			
			$crud->display_as('fecha_documento','Fecha del documento')
				 ->display_as('mision','mision')
				 ->display_as('fecha_recibido','Fecha de recibido')
				 ->display_as('relacionado_por','Relacionado por');
			
			
			/*$crud->unset_add_fields('remitente');
			$crud->unset_columns('remitente');	 
			$crud->unset_edit_fields('remitente');	*/ 
			$crud->set_subject('Correo');

			$crud->add_fields('numero','remitentes','asunto','fecha_documento','anexo','fecha_recibido','relacionado_por');
			$crud->edit_fields('numero','remitentes','asunto','fecha_documento','anexo','fecha_recibido','relacionado_por');
			$crud->required_fields('numero');



			$output = $crud->render();

			$this->_example_output($output);
	}




}