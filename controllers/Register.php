<?php
namespace App\Controllers;
use App\Models\RegisterPageModel;
class Register extends BaseController {
	
	/**
		
		* Index Page for this controller.
		
		* Maps to the following URL
		
		* Since this controller is set as the default controller in
		
		* config/routes.php, it's displayed at http://example.com/
		
	*/
	
	public function index()
	{
		return view('register_view');
	}
	
	public function captcha()
	{
		// Generate a captcha code
		$captcha_code = substr(md5(random_bytes(10)), 0, 6);

		// Store the captcha code in a session variable
		session()->set('captcha_code', $captcha_code);

		// Create a captcha image
		$captcha_image = imagecreatetruecolor(120, 50);
		$background_color = imagecolorallocate($captcha_image, 255, 255, 255);
		imagefilledrectangle($captcha_image, 0, 0, 120, 50, $background_color);
		$text_color = imagecolorallocate($captcha_image, 0, 0, 0);
		$font = './public/assets/fonts/Sofia-Regular.otf';
		imagettftext($captcha_image, 20, 0, 10, 30, $text_color, $font, $captcha_code);

		// Output the captcha image to the browser
		header('Content-Type: image/png');
		imagepng($captcha_image);
		imagedestroy($captcha_image); 
	}
	
	
	//--------------------------------------- action ------------------------------------------ 
	
	
	//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	public function action()
	
	{
		
		$registerpagemodel = new RegisterPageModel();
		// -------------------------- form vaildation ---------------------------------------
		$validation = \Config\Services::validation();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
		$validation->setRule('company', 'company', 'required|trim');
		$validation->setRule('fname', 'first name', 'required|trim');
		$validation->setRule('lname', 'last name', 'required|trim');
		$validation->setRule('username', 'user name', 'required|min_length[7]|trim');
		$validation->setRule('password', 'password', 'required|min_length[7]|max_length[15]|passwordCheckValidation[password]',['passwordCheckValidation'=>'The {field} field must have at least one lowercase/uppercase letter, special character and number.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~')]);
		$validation->setRule('re_password', 'confirmed password', 'required|trim|matches[password]');
		$validation->setRule('acctno', 'account no.', 'required|trim');
		$validation->setRule('email', 'email', 'required|valid_email|trim');
		$validation->setRule('mobile', 'mobile no.', 'required|trim');


		// -------------------- check validation is pass ------------------------------------	
		$username=$request->getPost('username');
		$is_duplicate=$registerpagemodel->check_duplicate($username);

		$user_input = $request->getPost('SecurityCode');
		$captcha_code = session()->get('captcha_code');	
		if($validation->withRequest($this->request)->run() && ($is_duplicate==1) && $user_input == $captcha_code) 
		{			   	
			
			$data=$request->getPost();
			unset($data['smt_enter']);
			unset($data['SecurityCode']);
			unset($data['re_password']);
			
			$data['password'] = base64_encode(base64_encode($data['password']));
			
			$memberid=$registerpagemodel->register_user($data);
			//---------------------------------- mail code go here ------------------------------------

			$currentdatetime=date('Y-m-d H:i:s');
			$vcod=md5($currentdatetime);
			
			$data_1['AddedDateTime']=date('Y-m-d H:i:s');
			$data_1['ValidDateTime']=date('Y-m-d H:i:s', strtotime("+10 minutes"));
			$data_1['IpAddress']=$_SERVER['REMOTE_ADDR'];
			$data_1['VarifyCode']=$vcod;
			$data_1['ClientID']=$memberid;
			$insert=$registerpagemodel->varification_insert($data_1,$memberid);
			if($memberid > 0)	
			
			{	    
				
				$company=$request->getPost('company');
				$fname=$request->getPost('fname');
				$lname=$request->getPost('lname');
				$acctno=$request->getPost('acctno');
				$email=$request->getPost('email');
				$emailTo=$request->getPost('email');
				
				$EmailStr = "";  //EMAIL CENTRON ABOUT CLIENT REGISTRATION
				
				$EmailStr .= "----------------------------------------------------------------------------<br>"; 
				
				$EmailStr .= "$fname $lname [$email] has just registered for an account.  You should go to your Maintenance Console to approve them.  
				--------------------------------------------------------------------------------<br>
				$fname $lname <br>
				Organization:  $company<br>
				Centron Account Number:  $acctno<br>
				Email:  $email<br>
				--------------------------------------------------------------------------------<br>
				";
				
				$EmailUser =EmailUser;  // to
				$SystemEmailUser = SystemEmailUser;  // from
				
				$email = \Config\Services::email(); // loading for use
				
				$email->setTo($EmailUser);
				$email->setMailType('html');
				$email->setFrom($SystemEmailUser, '');
				$email->setSubject('Centron Account Registration');
				
				$email->setMessage($EmailStr);

				// Send email
				if ($email->send()) {
					//echo 'Email successfully sent, please check.';
				} else {
					//$data = $email->printDebugger(['headers']);
				}
				
				
				//mail("$EmailUser", "Centron Account Registration", $EmailStr,"From: $SystemEmailUser\nReply-To: $SystemEmailUser\n");
				$EmailStr2 = "";  //EMAIL CLIENT ABOUT REGISTRATION
				
				$EmailStr2 .= "$fname $lname <br><br>
				
				Thank you for registering for an online account with Centron Services, Inc.  Your registration application has been forwarded to our staff and we will contact you shortly with your approval information.  Please be aware that this may take up to 48 hours to complete as we manually verify each account. <br><br>
				<br><br>
				
				Sincerely,<br>
				
				";
				$email->setTo($emailTo);
				$email->setMailType('html');
				$email->setFrom($SystemEmailUser, '');
				$email->setSubject('Centron Account Registration');
				
				$email->setMessage($EmailStr2);

				// Send email
				if ($email->send()) {
					//echo 'Email successfully sent, please check.';
				} else {
					//$data = $email->printDebugger(['headers']);					
				}
				
				//mail("$email", "Centron Services Account Registration", $EmailStr2,"From: $SystemEmailUser\nReply-To: $SystemEmailUser\n");
				
			}			
			//---------------------------------- mail code go here ------------------------------------	
			
			//---------------------------------- mail code go here ------------------------------------		
			$session->setFlashdata('register', 'You have registered successfully. We manually verify each account and it may take up to 48 hours.');
			return redirect()->to('register');
			
		}
		
		else
		{
			
			if($is_duplicate==0)
			{
				$session->setFlashdata('register', 'Usernmae is already exist please choose another name');
			}
			$user_input = $request->getPost('SecurityCode');
			$captcha_code = session()->get('captcha_code');
		
			if($user_input!=$captcha_code)  
			{
				$session->setFlashdata('register', 'Please enter correct security code');
			}
			return view('register_view');
			
		}  
		
		
		
	}	
	
	
	
	// ---------------------------------------------------- email varification -------------------------------------------
	
	
	
	public function emailvarify()
	{
	
		$session = \Config\Services::session();
	    $varificationcode = $this->request->uri->getSegment(3);
		
	    $registerpagemodel = new RegisterPageModel();
		
		$check= $registerpagemodel->check_varification_code($varificationcode);
		
		if($check==1)
		{
			
			$data['clientdetails']= $registerpagemodel->get_varification_codedeatils($varificationcode);
			
		
			$id=$data['clientdetails'][0]['ClientID'];
			
			$data_edit['emailvarify']=1;
			
			 $registerpagemodel->email_editdita($data_edit,$id);
			
		    $session->setFlashdata('register', 'Your email verified successfully.');
			return redirect()->to('register');
		}
		
		else
		
		{
			
			$session->setFlashdata('register', 'Sorry, Varification code has been expired/invalid.');
			
		    return redirect()->to('register');
			
		} 
		
		
		
		
		
	}	 
	
	
	
	
	
	
	
}

//ALTER TABLE `client_user` ADD `emailvarify` INT(10) NOT NULL DEFAULT '0' AFTER `new`;

?>