<?php


require APPPATH . '/libraries/REST_Controller.php';

/**
* 
*/
class jenis extends REST_CONTROLLER
{
	
	function __construct($config = 'rest')
	{
		parent::__construct($config);
	}


function index_get()
	{
		$jenis_id = $this->get('jenis_id');
		if($jenis_id=='')	
		{
				$jenis_id=$this->db->get('jenis_materi')->result_array();
		}
		else
		{
				$this->db->where('jenis_id', $jenis_id);
				$jenis_id=$this->db->get('jenis_materi')->result_array();
		}
				$this->response($jenis_id,200);
	}

function index_post()
	{


		//$config['upload path']
		$data = array('jenis_id' => $this->post('jenis_id'),
						'nama_jenis' => $this->post('nama_jenis'));
		$insert=$this->db->insert('jenis_id',$data);
		if($insert)
		{
			$this->response($data,200);
		}
		else
		{
			$this->respones(array('status'=>'fail',502));
		}
	}
function index_put()
	{
		$jenis_id = $this->put('jenis_id');
		$data = array('jenis_id' => $this->put('jenis_id'),
						'nama_jenis' => $this->put('nama_jenis'));
		$this->db->where('jenis_id',$jenis_id);
		$update = $this->db->update('jenis_id',$data);
		if($update)
		{
			$this->response($data,200);
		}
		else
		{
			$this->response(array('status' => 'fail' , 502));
		}
	}

function index_delete()
	{
		$jenis_id = $this->delete('jenis_id');
		$this->db->where('jenis_id',$jenis_id);
		$delete = $this->db->delete('jenis_id');
		if($delete)
		{
			$this->response(array('status' => 'delete success'), 201);
		}
		else
		{
			$this->response(array('status' => 'delete fail'), 502);
		}

	}
	
}