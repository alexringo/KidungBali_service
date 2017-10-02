<?php


require APPPATH . '/libraries/REST_Controller.php';

/**
* 
*/
class kidung extends REST_CONTROLLER
{
	
	function __construct($config = 'rest')
	{
		parent::__construct($config);
	}


function index_get()
	{
		$judul_id = $this->get('judul_id');
		if($judul_id=='')
		{
				$materi=$this->db->get('view_materi')->result_array();
				
		}
		else
		{
				$this->db->where('judul_id', $judul_id);
				$materi=$this->db->get('view_materi')->result_array();
		}
				$json = $this->response($materi,200);
				
	}

function index_post()
	{
	
		$data = array('judul_id' => $this->post('judul_id'),
						'isi'=>$this->post('isi'),
						'judul' =>$this->post('judul'),
						'suara'=>$this->post('suara'),
						'jenis_id'=>$this->post('jenis_id'));
		$insert=$this->db->insert('materi',$data);
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
		$judul_id = $this->put('judul_id');
		$data = array('judul_id' => $this->put('judul_id'),
						'judul' => $this->put('judul'),
						'jenis_id'=>$this->put('jenis_id'),
						'isi'=>$this->put('isi'),
						'suara'=>$this->put('suara'));
		$this->db->where('judul_id',$judul_id);
		$update = $this->db->update('materi',$data);
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
		$judul_id = $this->delete('judul_id');
		$this->db->where('judul_id',$judul_id);
		$delete = $this->db->delete('materi');
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