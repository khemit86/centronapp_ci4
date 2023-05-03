<?php
namespace App\Controllers;
use App\Models\NonmedicalcollectionsPageModel;
class Nonmedicalcollections extends BaseController {
	/**

	 * Index Page for this controller.

	 * Maps to the following URL

	 * Since this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com

	 */

//------------------------------------------------------------------------------------------

 
//------------------------------------------------------------------------------------------	 

	public function index()
	{
		//echo"-------------".$this->session->client_id;
		 error_reporting(0);
		$session = \Config\Services::session();
		$data['cid']=$session->get('client_id');
		$clt_id=$session->get('client_id');
		$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();
		$data['state']= $nonmedicalcollectionspagemodel->state_dropdown();
		$data['client_records']= $nonmedicalcollectionspagemodel->collection_client_records($clt_id);
		$data['client_batch']= $nonmedicalcollectionspagemodel->collection_batch($clt_id);
		return view('nonmedicalcollections_view',$data);
	}

//------------------------------------------------------------------------------------------		 

	public function action()
	{

		$session = \Config\Services::session();
		$validation = \Config\Services::validation();
		$request = \Config\Services::request();

		$validation->setRule('fname', 'first name', 'required|trim');
		$validation->setRule('lname', 'last name', 'required|trim');
		$validation->setRule('address', 'address', 'required|trim');
		$validation->setRule('city', 'city', 'required|trim');
		$validation->setRule('st', 'state', 'required|trim');
		$validation->setRule('zip', 'zipcode', 'required|trim');
		$validation->setRule('amountdue', 'amount due', 'required|trim');
		$validation->setRule('dls', 'last service date', 'required|trim');
		$validation->setRule('charge_off_date', 'charge Off date', 'required|trim');

		if($validation->withRequest($this->request)->run()) 
		{

			$data=$request->getPost();
			
			
			$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();	
			unset($data['smt_enter']);
			unset($data['dob']);
			unset($data['Patientdob']);
			unset($data['Spousedob']);
			unset($data['dls']);
			unset($data['charge_off_date']);
			//------------------------------------------------------------------------------------------------------------------

			$dob=$request->getPost('dob'); 

			if($dob!='')

			{

			$dobarr=explode("/",$dob);

			$data['dob']=$dobarr['2']."-".$dobarr['0']."-".$dobarr['1'];

			} 

			//------------------------------------------------------------------------------------------------------------------	

			$Patientdob=$request->getPost('Patientdob'); 

			if($Patientdob!='')

			{

			$Patientdobarr=explode("/",$Patientdob);

			$data['Patientdob']=$Patientdobarr['2']."-".$Patientdobarr['0']."-".$Patientdobarr['1'];

			}  

			//------------------------------------------------------------------------------------------------------------------		

			$Spousedob=$request->getPost('Spousedob');

			if($Patientdob!='')

			{

			$Spousedobarr=explode("/",$Spousedob);

			$data['Spousedob']=$Spousedobarr['2']."-".$Spousedobarr['0']."-".$Spousedobarr['1'];

			}	

			//------------------------------------------------------------------------------------------------------------------		

			$dls=$request->getPost('dls'); 

			if($dls!='')

			{

			$dlsarr=explode("/",$dls);

			$data['dls']=$dlsarr['2']."-".$dlsarr['0']."-".$dlsarr['1'];

			} 

			//------------------------------------------------------------------------------------------------------------------		

			$charge_off_date=$request->getPost('charge_off_date'); 

			if($charge_off_date!='')

			{

			$dlsarr=explode("/",$charge_off_date);

			$data['charge_off_date']=$dlsarr['2']."-".$dlsarr['0']."-".$dlsarr['1'];

			}

			//------------------------------------------------------------------------------------------------------------------		

			$dlp=$request->getPost('dlp'); 

			if($dlp!='')

			{

			$dlparr=explode("/",$dlp);

			$data['dlp']=$dlparr['2']."-".$dlparr['0']."-".$dlparr['1'];	

			}  
			//------------------------------------------------------------------------------------------	//------------------------------------------------------------------------------------------------------------------	 

			$collectionid=$nonmedicalcollectionspagemodel->collections_insert($data);

			//-------------------------------------------- Email Code Gose Here ------------------------------------------------
			$EmailStrClient = "";  
			$EmailStrClient.="----------------------------------------------------<br><br>

			Your file has been successfully uploaded to our server. Thank you for your continued business.<br><br><br><br>

			Thanks,<br><br>
			Centron Services, Inc.<br>

			Toll Free – 866-495-7227<br>

			Local 406-495-7227<br>
			----------------------------------------------------------------------";
			$subject="Centron File Upload";

			// ------------------- load email library ------------------------------------------------------------ 



			$email = \Config\Services::email(); // loading for use
			$SystemEmailUser = SystemEmailUser;	


			$client_email=$session->get('client_email'); 
			$EmailUser=EmailUser;
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
			//------------------------------ email code gose here --------------------------------------------------

			$session->setFlashdata('collections', 'Collections records added successfully');
			return redirect()->to('nonmedicalcollections/finish/'.$collectionid);

		}
		else
		{

			//echo"-------------".$this->session->client_id;

			$data['cid']=$session->get('client_id');
			$clt_id=$session->get('client_id');
			error_reporting(0);
			$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();	
			$data['state']= $nonmedicalcollectionspagemodel->state_dropdown();
			$data['client_records']= $nonmedicalcollectionspagemodel->collection_client_records($clt_id);
			$data['client_batch']= $nonmedicalcollectionspagemodel->collection_batch($clt_id);
			return view('nonmedicalcollections_view',$data);

		} 

	}  

	  //--------------------------------------------------- delete --------------------------------------------------------------- 
	public function delete()
	{
		$session = \Config\Services::session();
		$data['cid']=$session->get('client_id');
		$clt_id=$session->get('client_id');
		$id=$this->request->uri->getSegment(3);
		$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();	
		$nonmedicalcollectionspagemodel->collection_delete($id,$clt_id);
		$session->setFlashdata('collections', 'Collections records deleted successfully');
		return redirect()->to('nonmedicalcollections');
	}

	//--------------------------------------------------- save ----------------------------------------------------------------- 

	public function save()
	{

			

				$clt_id=$this->session->client_id;

				$id=$this->uri->segment(3);

				$this->load->model('Nonmedicalcollections_page');

				$this->Nonmedicalcollections_page->collection_submit_data($id,$clt_id);

				//---------------------------------- send email -----------------------------------------------------

						

						

						$client_fname=$this->session->client_fname;

						$client_lname=$this->session->client_lname;

						$client_company=$this->session->client_company;

						$client_acctno=$this->session->client_acctno;

						$client_email=$this->session->client_email;

						$subDate=date('H:i a m/d/Y'); 

						$SystemEmailUser = SystemEmailUser;

						

						$EmailStr = "";  //EMAIL CENTRON ABOUT PRECOLLECTION DATA REGISTRATION

						$EmailStr .= "---------------------------------------<br><br>

						

						A Non Medical Collection Record has just been added to the database.  You should go to your Maintenance Console to download this record. <br><br><br><br> 

						

						

						

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

							$this->load->library('email');

							$config = array (

									  'mailtype' => 'html',

									  'charset'  => 'utf-8',

									  'priority' => '1'

									   );

							$this->email->initialize($config);

							$this->email->from($SystemEmailUser, '');

							$this->email->to($EmailUser);

							$this->email->subject('Centron Non Medical Collection Record');

							$this->email->message($EmailStr);

							$this->email->send();



						

				

				//---------------------------------------------------------------------------------------------------

				$this->session->set_flashdata('collections', 'Collections records submitted successfully');

				redirect(base_url('nonmedicalcollections'));

	 

	 }    

	//collection_submit_data($data,$id)

	 

	  //--------------------------------------------------- edit ----------------------------------------------------------------- 

	public function edit()
	{
		error_reporting(0);
		$session = \Config\Services::session();
		$clt_id=$session->get('client_id');
		$data['cid']=$session->get('client_id');
		$id=$this->request->uri->getSegment(3);
		$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();	
		$data['state']= $nonmedicalcollectionspagemodel->state_dropdown();
		$data['edit_collection']=$nonmedicalcollectionspagemodel->collection_client_edit_records($id,$clt_id);
		return view('nonmedicalcollections_modify',$data);
	}	

			  

		 //------------------------------------------- edit data -----------------------------------------------------------------

		      	

	public function editdo()
	{ 

		$validation = \Config\Services::validation();
		$session = \Config\Services::session();
		$request = \Config\Services::request();

		$validation->setRule('fname', 'first name', 'required|trim');
		$validation->setRule('lname', 'last name', 'required|trim');
		$validation->setRule('address', 'address', 'required|trim');
		$validation->setRule('city', 'city', 'required|trim');
		$validation->setRule('st', 'state', 'required|trim');
		$validation->setRule('zip', 'zipcode', 'required|trim');
		$validation->setRule('amountdue', 'amount due', 'required|trim');
		$validation->setRule('dls', 'last service date', 'required|trim');
		$validation->setRule('charge_off_date', 'charge off date', 'required|trim');

		if($validation->withRequest($this->request)->run())
		{
			$data=$request->getPost();
			$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();		
			unset($data['smt_enter']);
			unset($data['dob']);
			unset($data['Patientdob']);
			unset($data['Spousedob']);
			unset($data['dls']);
			unset($data['charge_off_date']);
			unset($data['dlp']);
			//------------------------------------------------------------------------------------------------------------------

			$dob=$request->getPost('dob'); 

			$dobarr=explode("/",$dob);

			$data['dob']=$dobarr['2']."-".$dobarr['0']."-".$dobarr['1'];//------------------------------------------------------------------------------------------------------------------	

			$Patientdob=$request->getPost('Patientdob'); 

			$Patientdobarr=explode("/",$Patientdob);

			$data['Patientdob']=$Patientdobarr['2']."-".$Patientdobarr['0']."-".$Patientdobarr['1'];
		//------------------------------------------------------------------------------------------------------------------		

			$Spousedob=$request->getPost('Spousedob');

			$Spousedobarr=explode("/",$Spousedob);

			$data['Spousedob']=$Spousedobarr['2']."-".$Spousedobarr['0']."-".$Spousedobarr['1'];
		//------------------------------------------------------------------------------------------------------------------		

			$dls=$request->getPost('dls'); 

			$dlsarr=explode("/",$dls);

			$data['dls']=$dlsarr['2']."-".$dlsarr['0']."-".$dlsarr['1'];
		//------------------------------------------------------------------------------------------------------------------		

			$charge_off_date=$request->getPost('charge_off_date'); 

			$dlsarr=explode("/",$charge_off_date);

			$data['charge_off_date']=$dlsarr['2']."-".$dlsarr['0']."-".$dlsarr['1'];
		//------------------------------------------------------------------------------------------------------------------		
			$dlp=$request->getPost('dlp'); 
			$dlparr=explode("/",$dlp);
			$data['dlp']=$dlparr['2']."-".$dlparr['0']."-".$dlparr['1'];	//------------------------------------------------------------------------------------------	
		//--------------------------------------------------------------------------------------------------------

			$clt_id=$session->get('client_id');
			$id=$request->getPost('id');
			$collectionid=$nonmedicalcollectionspagemodel->collections_editdita($data,$id,$clt_id);
			$session->setFlashdata('collections', 'Collections records updated successfully');
			return redirect()->to('nonmedicalcollections');

		 }
		else
		{

			$clt_id=$session->get('client_id');
			$data['cid']=$session->get('client_id');
			$id=$request->getPost('id');
			$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();	
			$data['state']= $nonmedicalcollectionspagemodel->state_dropdown();
			$data['edit_collection']=$nonmedicalcollectionspagemodel->collection_client_edit_records($id,$clt_id);   
			return view('nonmedicalcollections_modify',$data);

		 }   
	} 	

//---------------------------------- finish ------------------------------------------------------------

//---------------------------------- finish ------------------------------------------------------------			 

	public function finish()
	{
		$session = \Config\Services::session();
		$data['cid']=$session->get('client_id');
		$clt_id=$session->get('client_id');
		error_reporting(0);
		$id=$this->request->uri->getSegment(3);
		$data['id']=$id;
		$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();
		$data['client_records']= $nonmedicalcollectionspagemodel->collection_finish_records($clt_id,$id);
		$session->setFlashdata('collections', 'Non-Medical collection records submitted successfully. Save record to administrator click on finish button. ');
		return view('nonmedicalcollections_finish_view',$data);

	}	 		

	  	 		

	  

  //--------------------------------------------------- save ----------------------------------------------------------------- 

  //--------------------------------------------------- save ----------------------------------------------------------------- 

  

	public function bulk_action()
	{
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$id_arr=$request->getPost('id');

		if(count($id_arr) > 0)
		{	   
			$clt_id=$session->get('client_id');
			$nonmedicalcollectionspagemodel = new NonmedicalcollectionsPageModel();
			$i=0;
			foreach($id_arr as $id)	
			{
				$nonmedicalcollectionspagemodel->collection_submit_data($id,$clt_id);

				//---------------------------------- send email -----------------------------------------------------
				$client_fname=$session->get('client_fname');
				$client_lname=$session->get('client_lname');
				$client_company=$session->get('client_company');
				$client_acctno=$session->get('client_acctno');
				$client_email=$session->get('client_email');
				$subDate=date('H:i a m/d/Y'); 
				$SystemEmailUser = SystemEmailUser;
				$EmailStr = "";  //EMAIL CENTRON ABOUT PRECOLLECTION DATA REGISTRATION
				$EmailStr .= "---------------------------------------<br><br>
				A Non Medical Collection Record has just been added to the database.  You should go to your Maintenance Console to download this record. <br><br><br><br> 
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
					$EmailUser=EmailUser;														
					
					$email = \Config\Services::email(); // loading for use
					$email->setTo($EmailUser);
					$email->setMailType('html');
					$email->setFrom($SystemEmailUser, '');
					$email->setSubject('Centron Non Medical Collection Record');
					
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
		//---------------------------------------------------------------------------------------------------
			 $session->setFlashdata('collections', 'Records finalized and sent to staff successfully');
					//return redirect()->to('direct');
			 return redirect()->to('nonmedicalcollections');

		}
		else
		{
		
			$session->setFlashdata('collections', 'Nothing to finalize please select records to finalized.');
			return redirect()->to('nonmedicalcollections');
		 
		}	 	
	}   		 		


}

?>