<?php
namespace App\Models;
use CodeIgniter\Model;
class DirectPageModel extends Model
{
	// ---------------------------------------- Get Forgot ------------------------------------------------------			  
	public function direct_insert($data)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('direct_payment');
		if($builder->insert($data))
		{
			return $db->insertID();
		}
		else
		{
			return 0;
		} 
	}
	// ----------------------------------- state drop down ------------------------------------------------------	
	
	
	//------------------------------------ submitedt data --------------------------------------------	
	
	function direct_client_records($clt_id)
	{      
		$db = \Config\Database::connect();
		$query = $db->table('direct_payment')
			->where('clientid', $clt_id)
			->where('submit', 'N')
			->orderBy('submit_date','desc')
			->get();
		return $query->getResultArray();
	}
	
	function direct_batch($clt_id)
	{   
		$db = \Config\Database::connect();
		$query = $db->table('direct_payment')
			->where('clientid', $clt_id)
			->where('submit', 'Y')
			->orderBy('submit_date','desc')
			->groupBy('submit_date')
			->get();
		return $query->getResultArray();
	}  
	
	
	
	/////////////////////////////////delete//////////////////////////////////////////////////////////	
	
	function direct_delete($id,$client_id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('direct_payment');
		$builder->where('id', $id);
		$builder->where('clientid', $client_id);
		$builder->delete();
		if($db->affectedRows() > 0) {
			return 1;
		} else {
			return 0;
		}
	} 
	
	//----------------------------------------------- save ------------------------------
	
	function direct_submit_data($id,$client_id)
	{
		$db = \Config\Database::connect();
		$data['submit']='Y';
		$builder = $db->table('direct_payment');
		$builder->where('id', $id);
		$builder->where('clientid', $client_id);
		$builder->update($data);
		$db->close();

	} 
	
	//---------------------------------------------select to edit --------------------------------	
	
	function direct_client_edit_records($id,$clt_id)
	{   
		$db = \Config\Database::connect();
		$query = $db->table('direct_payment')
			->where('clientid', $clt_id)
			->where('id', $id)
			->where('submit', 'N')
			->orderBy('submit_date', 'desc')
			->get();
		return $query->getResultArray();
		
	} 
	
	// ------------------------------------- edit data --------------------------------------------		
	
	function direct_editdita($data,$id,$clientid)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('direct_payment');
		$builder->where('id', $id);
		$builder->where('clientid', $clientid);
		$builder->update($data);
		$db->close();
	}  
	
	//--------------------------------------  get batch data -------------------------------------------
	function direct_client_records_view($clt_id,$date)
	{     
		
		$db = \Config\Database::connect();
		$query = $db->table('direct_payment')
			->where('clientid', $clt_id)
			->where('submit_date', $date)
			->where('submit', 'Y')
			->orderBy('submit_date','desc')
			->get();
		return $query->getResultArray();
	}  	
	//--------------------------------------------- finish or enter another records--------------------------	
	
	//--------------------------------------  get batch data -------------------------------------------
	
	function get_direct_finish_view($clt_id,$id)
	{            
		
		$db = \Config\Database::connect();
		$query = $db->table('direct_payment')
			->where('clientid', $clt_id)
			->where('submit', 'N')
			->where('archive', 'N')
			->orderBy('submit_date','desc')
			->get();
		return $query->getResultArray();
		
	}  	
}		  	