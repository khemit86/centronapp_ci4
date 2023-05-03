<?php 
namespace App\Models;
use CodeIgniter\Model;
/**
	****************************************************************************** 
*/

class PrecollectionsPageModel extends Model
{
	// ---------------------------------------- Get Forgot ------------------------------------------------------			  
	public function collections_insert($data)
	{

		$db = \Config\Database::connect();
		$builder = $db->table('collection');
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
	// ----------------------------------- state drop down ------------------------------------------------------		  
	
	function state_dropdown()
	{   
		$db = \Config\Database::connect();
		$query = $db->table('state')
			->orderBy('name','asc')
			->get();
		return $query->getResultArray();
		$db->close();
	}  
	//------------------------------------ select batch  common--------------------------------------------		
	//------------------------------------ select batch   common--------------------------------------------
	
	
	
	function collection_batch($clt_id)
	{    
		$db = \Config\Database::connect();
		$query = $db->table('collection')->select('submit_date,id,straight_pre')
		->orderBy('submit_date','desc')
		->groupBy('submit_date')
		->where('clientid', $clt_id)
		->where('submit', 'Y')
		->where('straight_pre', 'P')
		->get();
		return $query->getResultArray();
		$db->close();
		
	} 
	
	//------------------------------------ submitedt data --------------------------------------------
	//------------------------------------ submitedt data --------------------------------------------	
	function collection_client_records($clt_id)
	{     
		$db = \Config\Database::connect();
		$query = $db->table('collection')
			->orderBy('submit_date','desc')
			->where('clientid', $clt_id)
			->where('submit', 'N')
			->where('archive', 'N')
			->where('straight_pre', 'P')
			->get();
		return $query->getResultArray();
		$db->close();
	} 
	
	/////////////////////////////////delete//////////////////////////////////////////////////////////	
	
	function collection_delete($id,$client_id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('collection');
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
	
	function collection_submit_data($id,$client_id)
	{
		$db = \Config\Database::connect();
		$data['submit']='Y';
		$data['email_sent']='Y';
		$data['submit_date']=date('Y-m-d');
		$data['submit']='Y';
		$builder = $db->table('collection');
		$builder->where('id', $id);
		$builder->where('clientid', $client_id);
		$builder->update($data);
		$db->close();
		
	} 
	
	//---------------------------------------------select to edit --------------------------------	
	
	function collection_client_edit_records($id,$clt_id)
	{    
		$db = \Config\Database::connect();
		$query = $db->table('collection')
			->where('clientid', $clt_id)
			->where('id', $id)
			->where('submit', 'N')
			->where('archive', 'N')
			->where('straight_pre', 'P')
			->orderBy('submit_date', 'desc')
			->get();
		return $query->getResultArray();
		$db->close();
	} 
	
	// ------------------------------------- edit data --------------------------------------------		
	
	function collections_editdita($data,$id,$clientid)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('collection');
		$builder->where('id', $id);
		$builder->where('clientid', $clientid);
		$builder->update($data);
		$db->close();

	}
	
	//------------------------------------------ finish -----------------------------------------------
	function collection_finish_records($clt_id,$id)
	{     
		$db = \Config\Database::connect();
		$query = $db->table('collection')
			->where('clientid', $clt_id)
			->where('submit', 'N')
			->where('archive', 'N')
			->where('straight_pre', 'P')
			->orderBy('submit_date','desc')
			->get();
		return $query->getResultArray();
		
	}  
	
}	