<?php 
namespace App\Models;
use CodeIgniter\Model;
class RegisterPageModel extends Model
{
	
	// ---------------------------------------- Get Forgot ------------------------------------------------------			  
	public function register_user($data)
	{
		
		$this->db = \Config\Database::connect();
		if($this->db->table('client_user')->insert($data))
		{
			return $this->db->insertID();
		}
		else
		{
			return 0;
		} 
	}	
	
	
	// -----------------------------check clients already exist or not when add agents --------------------------------
	
	public function check_duplicate($userid)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('client_user');
		
		$query = $builder->where('username', $userid)
		->get();
		
		if ($query->getNumRows() > 0) {
			return 0;
			} else {
			return 1;
		}
	}
	// -----------------------------check clients already exist or not when add edit --------------------------------	  	
	
	function check_duplicate_edit($userid,$id)
	{
		
		$q = $this->db->where(['username' => $userid,'id!=' => $id])
		->get('client_user');
		
		if ($q->num_rows()>0) {
			return 0 ;
			
			} else {
			
			return 1;
		}
	}	
	
	
	//-------------------------------------------------------------------------------------------------------
	
	// -------------------- insert varification code -----------------------
	public function varification_insert($data,$client_id)
	{
		
		$db = \Config\Database::connect();
		$builder = $db->table('client_emailvarify');
		$builder->where('ClientID', $client_id);
		$builder->delete();
		
		if ($builder->insert($data)) {
			return $db->insertID();
			} else {
			return 0;
		}
	}		
	
	// ---------------------------------------- Get varification code ------------------------------------------------------			  
	public function check_varification_code($VarifyCode)
	{
		$db      = \Config\Database::connect();
		$currenttime=date('Y-m-d H:i:s');
		$builder = $db->table('client_emailvarify');
		$query = $builder->where(['VarifyCode' => $VarifyCode,'ValidDateTime >' => $currenttime])
		->get();
		
		if ($query->getNumRows() > 0) {
			return 1 ;
			} else {
			return 1;
		}
		
	}		
	
	//-----------------------------------------------------------------------------------------------------------------
	
		//-------------------------- get user details ------------------------
	
	public function get_varification_codedeatils($VarifyCode)
    {
        $currenttime = date('Y-m-d H:i:s');
        $query = $this->db->table('client_emailvarify')->where(['VarifyCode' => $VarifyCode, 'ValidDateTime >' => $currenttime])->get();
        $result = $query->getResultArray();
        $this->db->close();
        return $result;
    }

	
	//---------------------------------------- update email varification status ---------------------------------------------

	public function email_editdita($data, $id)
    {
        $this->db->table('client_emailvarify')->where('ClientID', $id)->delete();
    
        $this->db->table('client_user')->where('id', $id)->update($data);
        $this->db->close();
    } 
	
}

?>