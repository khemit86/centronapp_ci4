<?php
namespace App\Controllers;
use App\Models\DirectPageModel;
class Direct extends BaseController {
	/**
		
		* Index Page for this controller.
		
		* Maps to the following URL
		
		* Since this controller is set as the default controller in
		
		* config/routes.php, it's displayed at http://example.com/
		
	*/
	
	public function index()
	{
		
		error_reporting(0);
		$session = \Config\Services::session();
		$data['cid']=$session->get('client_id');
		$clt_id=$session->get('client_id');
		$directpagemodel = new DirectPageModel();
		$data['client_records']= $directpagemodel->direct_client_records($clt_id);
		$data['client_batch']= $directpagemodel->direct_batch($clt_id);
		return view('direct_view',$data);
	}
	
	//===========================================
	
	
	
	public function action()
	
	{
		
		$validation = \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$validation->setRule('name', 'name', 'required|trim');
		$validation->setRule('payment', 'payment', 'required|trim');
		$validation->setRule('balance', 'balance', 'required|trim');
		$validation->setRule('paytype', 'payment type', 'required|trim');
		$directpagemodel = new DirectPageModel();
		
		if($validation->withRequest($this->request)->run())
		{
			$data=$request->getPost();
			
			unset($data['smt_enter']);
			unset($data['client_fname']);
			unset($data['client_company']);
			unset($data['client_acctno']);//------------------------------------------------------------------------------------------	//------------------------------------------------------------------------------------------------------------------	
			$collectionid=$directpagemodel->direct_insert($data);
			
			//-------------------------------------------- Email Code Gose Here ------------------------------------------------
			
			$EmailStrClient = "";  
			
			$EmailStrClient.="----------------------------------------------------<br><br>
			Your file has been successfully uploaded to our server. Thank you for your continued business.<br><br><br><br>
			Thanks,<br><br>
			
			Centron Services, Inc.<br>
			
			Toll Free – 866-495-7227<br>
			
			Local 406-495-7227<br>
			
			Email: jmfallang@centronservices.com<br><br><br>
			----------------------------------------------------------------------";
			$subject="Centron File Upload";
			
			// ------------------- load email library ------------------------------------------------------------ 
			
			$EmailUser =EmailUser;  // to
			$SystemEmailUser = SystemEmailUser;  // from
			$client_email=$session->get('client_email'); 
			$email = \Config\Services::email(); // loading for use
			
			$email->setTo(trim($client_email));
			$email->setMailType('html');
			$email->setFrom($SystemEmailUser, '');
			$email->setSubject($subject);
			
			$email->setMessage($EmailStrClient);

			// Send email
			if ($email->send()) {
				//echo 'Email successfully sent, please check.';
			} else {
				//$data = $email->printDebugger(['headers']);
				
			}
			//$this->email->send(); //kmt
			
			//------------------------------ email code gose here --------------------------------------------------
			
			$session->setFlashdata('collections', 'Records added successfully.');
			return redirect()->to('direct/finish/'.$collectionid);
			
		}
		else{
			
			$data['cid']=$session->get('client_id');
			$clt_id=$session->get('client_id');
			$data['client_records']= $directpagemodel->direct_client_records($clt_id);
			$data['client_batch']= $directpagemodel->direct_batch($clt_id);
			return view('direct_view',$data);
			
		} 
		
	} 
	//--------------------------------------------------- delete --------------------------------------------------------------- 
	
	public function delete()
	{
		$session = \Config\Services::session();
		$data['cid']=$session->get('client_id');
		$clt_id=$session->get('client_id');
		$id=$this->request->uri->getSegment(3);
		$directpagemodel = new DirectPageModel();
		$directpagemodel->direct_delete($id,$clt_id);
		$session->setFlashdata('collections', 'Direct payment records deleted successfully.');
		return redirect()->to('direct');
	}
	
	//--------------------------------------------------- save ----------------------------------------------------------------- 
	
	public function save()
	{
		
		$session = \Config\Services::session();
		$clt_id=$session->get('client_id');
		$id=$this->request->uri->getSegment(3);
		
		$directpagemodel = new DirectPageModel();
		$directpagemodel->direct_submit_data($id,$clt_id);

		$client_fname=$session->get('client_fname');
		$client_lname=$session->get('client_lname');
		$client_company=$session->get('client_company');
		$client_acctno=$session->get('client_acctno');
		$client_email=$session->get('client_email');
		
		$subDate=date('H:i a m/d/Y'); 
		$SystemEmailUser = SystemEmailUser;
		$EmailStr = "";  
		$EmailStr .= "-----------------------------------------------<br><br>
		A Direct Payment has just been added to the database.  You should go to your Maintenance Console to download this record. <br><br><br><br> 
		-------------------<br><br>
		
		CLIENT INFO:<br>
		-------------------<br><br>
		
		$client_fname $client_lname<br>
		$client_company<br>
		$client_email<br>
		
		Account # $client_acctno<br>
		
		Date: $subDate <br><br>
		-------------------<br><br><br><br>
		-------------------<br><br><br><br>
		";
		
		$EmailUser=EmailUser;	
		
		$email = \Config\Services::email(); // loading for use
   
		$email->setTo($EmailUser);
		$email->setMailType('html');
		$email->setFrom($SystemEmailUser, '');
		$email->setSubject('Centron Direct Payment  Record');

		$email->setMessage($EmailStr);

		// Send email
		if ($email->send()) {
			//echo 'Email successfully sent, please check.';
		} else {
			//$data = $email->printDebugger(['headers']);
			
		}
		$session->setFlashdata('collections', 'Records finalized and sent to staff successfully.');
		return redirect()->to('direct');
	}    
	
	//collection_submit_data($data,$id)
	//--------------------------------------------------- edit ----------------------------------------------------------------- 
	public function edit()
	{
		$session = \Config\Services::session();
		$clt_id=$session->get('client_id');
		$data['cid']=$session->get('client_id');
		$id=$this->request->uri->getSegment(3);
		$directpagemodel = new DirectPageModel();
		$data['edit_direct']=$directpagemodel->direct_client_edit_records($id,$clt_id);   
		return view('direct_modify',$data);
	}
	
	//------------------------------------------- edit data -----------------------------------------------------------------
	
	public function editdo()
	{ 
		$validation = \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$validation->setRule('name', 'name', 'required|trim');
		$validation->setRule('payment', 'payment', 'required|trim');
		$validation->setRule('balance', 'balance', 'required|trim');
		$validation->setRule('paytype', 'payment type', 'required|trim');
		if($validation->withRequest($this->request)->run())
		{
			
			$data=$request->getPost();
			$directpagemodel = new DirectPageModel();		
			unset($data['smt_enter']);
			unset($data['id']);
			unset($data['client_fname']);
			unset($data['client_company']);
			unset($data['client_acctno']);//------------------------------------------------------------------------------------------	//--------------------------------------------------------------------------------------------------------
			
			$clt_id=$session->get('client_id');
			$id=$request->getPost('id');
			$collectionid=$directpagemodel->direct_editdita($data,$id,$clt_id);
			$session->setFlashdata('collections', 'Direct payment updated successfully.');
			return redirect()->to('direct');
			
		}
		else
		{
			
			$clt_id=$session->get('client_id');
			$data['cid']=$session->get('client_id');
			$id=$request->getPost('id');
			$directpagemodel = new DirectPageModel();	
			$data['edit_direct']=$directpagemodel->direct_client_edit_records($id,$clt_id);   
			return view('direct_modify',$data);
			
		}   
	} 		
	
	
	//-------------------------------------------View batch all data---------------------------------------------	 
	
	public function batches()
	
	{
	
		$session = \Config\Services::session();
		$clt_id=$session->get('client_id');
		$data['cid']=$session->get('client_id');
		$date=$this->request->uri->getSegment(4);
		$id=$this->request->uri->getSegment(3);
		$directpagemodel = new DirectPageModel();	
		$data['date']=$date;
				
		$data['client_records']=$directpagemodel->direct_client_records_view($clt_id,$date);
		return view('direct_batch_view',$data);
		
	}	
	//-------------------------------------- print batch all data ------------------------------------------------  
	
	public function printpage()
	{

		$session = \Config\Services::session();
		$clt_id=$session->get('client_id');
		$data['cid']=$session->get('client_id');
		$date=$this->request->uri->getSegment(3);
		
		$directpagemodel = new DirectPageModel();	
		$data['date']=$date;
		$data['client_records']=$directpagemodel->direct_client_records_view($clt_id,$date);
		return view('direct_batch_print',$data);
	} 
	
	
	//---------------------------------- finish ------------------------------------------------------------
	
	//---------------------------------- finish ------------------------------------------------------------
	
	
	public function finish()
	{
		$session = \Config\Services::session();
		$data['cid']=$session->get('client_id');
		$clt_id=$session->get('client_id');
		$id=$this->request->uri->getSegment(3);
		$directpagemodel = new DirectPageModel();
		$data['client_records']= $directpagemodel->get_direct_finish_view($clt_id,$id);
		$data['id']=$id;
		
		$session->setFlashdata('collections', 'Records saved successfully. Finalize record to send saved records to collections staff, or enter another record.');
		return view('direct_finish_view',$data);
		
		//echo"<pre>";
		//print_r($data['client_records']);
		//echo"</pre>";
		
	}
	//---------------------------------- bulk action ------------------------------------------------------------			   
	
	public function bulk_action()
	{
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$id_arr=$request->getPost('id');
		$i=0;
		if(count($id_arr) > 0)
		{
			
			$clt_id=$session->get('client_id');
			$directpagemodel = new DirectPageModel();
			
			foreach($id_arr as $id)	
			{
				
				$directpagemodel->direct_submit_data($id,$clt_id);
				$client_fname=$session->get('client_fname');
				$client_lname=$session->get('client_lname');
				$client_company=$session->get('client_company');
				$client_acctno=$session->get('client_acctno');
				$client_email=$session->get('client_email');
				$subDate=date('H:i a m/d/Y'); 
				$SystemEmailUser = SystemEmailUser;
				$EmailStr = "";  
				$EmailStr .= "-----------------------------------------------<br><br>
				A Direct Payment has just been added to the database.  You should go to your Maintenance Console to download this record. <br><br><br><br> 
				-------------------<br><br>
				CLIENT INFO:<br>
				-------------------<br><br>
				$client_fname $client_lname<br>
				$client_company<br>
				$client_email<br>
				Account # $client_acctno<br>
				Date: $subDate <br><br>
				-------------------<br><br><br><br>
				
				-------------------<br><br><br><br>
				";
				// condition due to when I add and finalize multiple records, it STILL sends staff multiple email notices. It should only send staff ONE email notice when the finalize option is sent.
				
				if($i==0)
				{
					$email = \Config\Services::email(); // loading for use
					$EmailUser=EmailUser;
					$email->setTo($EmailUser);
					$email->setMailType('html');
					$email->setFrom($SystemEmailUser, '');
					$email->setSubject('Centron Direct Payment  Record');
					$email->setMessage($EmailStr);
					// Send email
					if ($email->send()) {
						//echo 'Email successfully sent, please check.';
					} else {
						//$data = $email->printDebugger(['headers']);
						
					}
				}
				
				$i++;					
				
			}	
			$session->setFlashdata('collections', 'Records finalized and sent to staff successfully.');
			return redirect()->to('direct');
			
		} // end count else 
		else
		{
			
			$session->setFlashdata('collections', 'Nothing to finalize please select records to finalized.');
			return redirect()->to('direct');
			
		}	
	}		   	  
	
	
}

?>