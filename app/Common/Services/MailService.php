<?php 

namespace App\Common\Services;
use Illuminate\Http\Request;
use App\Models\EmailTemplateModel;
use Session;
use Mail;
use Auth;
use URL;
use PDF;


class MailService
{
	public function get_email_template($email_template_id = false)
	{
		$arr_template_data = [];

		$obj_email_template = EmailTemplateModel::where('id',$email_template_id)->first();

		if($obj_email_template)
		{
			$arr_template_data = $obj_email_template->toArray();
		}

		return $arr_template_data;												

	}

	public function send_mail($arr_email,$content)
	{
    $from_email                    = isset($arr_email['from_mail']) ? $arr_email['from_mail'] : 'admin@amaaia.com';
    $project_name                  = config('app.project.name');
    try{

    $send_mail = Mail::send(array(), array(),function($message) use($arr_email,$content,$from_email,$project_name)
    {
      $to_name = isset($arr_email['to_name']) ? $arr_email['to_name'] :'';
      $message->from($from_email,$project_name);
      $message->to($arr_email['to_email_id'],$to_name)
      ->subject($arr_email['subject'])
      ->setBody($content, 'text/html');
    });
  }
  catch (\Swift_TransportException $e) 
  {
    return false;
  }

    if(count(Mail::failures()) > 0){
      return false;
    }
    else
    {
      return true;
    }

    return $send_mail;
  }

  public function send_contact_enquiry_mail($arr_data = array())
  {

   $arr_email = [];

   if(isset($arr_data))
   {
    $arr_email['to_email_id']      = isset($arr_data['email'])?$arr_data['email']:'';
    $arr_email['to_name']          = isset($arr_data['name'])?$arr_data['name']:'';
    $locale                        = isset($arr_data['locale'])?$arr_data['locale']:'en';

    $arr_email_template = [];

    $arr_email_template = $this->get_email_template('4',$locale);
    if($arr_email_template)
    {

     $subject = isset($arr_email_template['template_subject']) ? $arr_email_template['template_subject'] : ''; 

     $content = isset($arr_email_template['template_html']) ? $arr_email_template['template_html'] : '';

     $content = str_replace("##SUBJECT##",$arr_email_template['template_subject'], $content);
     $content = str_replace("##USERNAME##",$arr_email['to_name'], $content);
     
     $content = view('admin.email.general', compact('content'))->render();
     $content = html_entity_decode($content);

     $arr_email['subject']= isset($subject)? $subject:'';
     $send_mail = $this->send_mail($arr_email,$content);

     return $send_mail;
   }
   return FALSE;	
 }
 return false;
}
    // Contact enquiry reply mail from admin 
public function send_contact_enquiry_reply_mail($arr_data = false)
{
 $arr_email = [];

 if(isset($arr_data))
 {
  $arr_email['to_email_id']      = isset($arr_data['email'])?$arr_data['email']:'';
  $arr_email['to_name']          = isset($arr_data['name'])?$arr_data['name']:'';

  $arr_email_template = [];

  $arr_email_template = $this->get_email_template('1');

  if($arr_email_template)
  {
   $subject = isset($arr_email_template['template_subject']) ? $arr_email_template['template_subject'] : ''; 

   $content = isset($arr_email_template['template_html']) ? $arr_email_template['template_html'] : '';

   $content = str_replace("##SUBJECT##",$arr_email_template['template_subject'], $content);
   $content             = str_replace("##USERNAME##",$arr_email['to_name'], $content);
   $content             = str_replace("##REPLY##",$arr_data['reply'], $content);
   $content     		 = view('admin.email.general', compact('content'))->render();
   $content      		 = html_entity_decode($content);

   $arr_email['from_mail'] =  isset($arr_email_template['template_from_mail']) ? $arr_email_template['template_from_mail'] : '';
   
   $arr_email['subject']= isset($subject)? $subject:'';
   $send_mail = $this->send_mail($arr_email,$content);



   return $send_mail;
 }
 return FALSE;	
}
return false;
}

public function send_user_registration_email($arr_data = array())
{   
  $arr_email = [];

  if(isset($arr_data['to_email_id']))
  {
    $arr_email['to_email_id']      = isset($arr_data['to_email_id'])?$arr_data['to_email_id']:'';
    $arr_email['to_name']          = isset($arr_data['name'])?$arr_data['name']:'';
    $arr_email['verification_url'] = isset($arr_data['verification_url'])?$arr_data['verification_url']:'';
    $arr_email['user_type']        = isset($arr_data['user_type'])?$arr_data['user_type']:'';
    
    $email_subject  = config('app.project.name').' : '.'Welcome to '.config('app.project.name');

    $arr_email_template = [];

    $arr_email_template = $this->get_email_template('4');

    
    if($arr_email_template)
    {           
      $subject = isset($arr_email_template['template_subject']) ? $arr_email_template['template_subject'] : ''; 

      $content = isset($arr_email_template['template_html']) ? $arr_email_template['template_html'] : '';

      $verification_link = $arr_email['verification_url'];

      $content = str_replace("##FIRST_NAME##",$arr_data['name'], $content);
      $content = str_replace("##SUBJECT##",$arr_email_template['template_subject'], $content);
      $content = str_replace("##USER_TYPE##",$arr_email['user_type'],$content);
      $content = str_replace("##VERIFICATION_LINK##",$verification_link, $content);
      $content = str_replace("##PROJECT_NAME##",config('app.project.name'), $content);

      $content = view('admin.email.general', compact('content'))->render();
      $content = html_entity_decode($content);

      $arr_email['subject']= isset($subject)? $subject:'';

      $arr_email['from_mail'] =  isset($arr_email_template['template_from_mail']) ? $arr_email_template['template_from_mail'] : '';
      

      $send_mail = $this->send_mail($arr_email,$content);

      return $send_mail;
    }
    return FALSE;   
  }
  
  return false;
}


public function gift_card_send_mail($arr_data = array())
{   
  $arr_email = [];

  if(isset($arr_data['to_email_id']))
  {

    $arr_email['to_email_id']      = isset($arr_data['to_email_id'])?$arr_data['to_email_id']:'';
    $arr_email['sender_name']      = isset($arr_data['sender_name'])?$arr_data['sender_name']:'';
    $arr_email['card_name']        = isset($arr_data['card_name'])?$arr_data['card_name']:'';
    $arr_email['amount']           = isset($arr_data['amount'])?$arr_data['amount']:'';
    $arr_email['code']             = isset($arr_data['code'])?$arr_data['code']:'';
    $arr_email['mobile_no']        = isset($arr_data['mobile_no'])?$arr_data['mobile_no']:'';
    
    $email_subject  = config('app.project.name').' : '.'Welcome to '.config('app.project.name');

    $arr_email_template = [];

    $arr_email_template = $this->get_email_template('5');

    
    if($arr_email_template)
    {           
      $subject = isset($arr_email_template['template_subject']) ? $arr_email_template['template_subject'] : ''; 

      $content = isset($arr_email_template['template_html']) ? $arr_email_template['template_html'] : '';

      $content = str_replace("##SENDER_NAME##",$arr_data['sender_name'], $content);
      $content = str_replace("##SUBJECT##",$arr_email_template['template_subject'], $content);
      $content = str_replace("##CARD_NAME##",$arr_email['card_name'],$content);
      $content = str_replace("##CARD_NAME##",$arr_email['card_name'],$content);
      $content = str_replace("##WEBSITE_NAME##",config('app.project.name'),$content);
      $content = str_replace("##AMOUNT##",$arr_email['amount'],$content);
      $content = str_replace("##GIFT_CARD_CODE##",$arr_email['code'],$content);
      $content = str_replace("##GIFT_CARD_CODE##",$arr_email['code'],$content);
      $content = str_replace("##EMAIL##",$arr_email['to_email_id'],$content);
      $content = str_replace("##MOBILE_NO##",$arr_email['mobile_no'],$content);
      $content = str_replace("##SIGNUP_LINK##",url('/signup'), $content);
     $content = str_replace("##PROJECT_LINK##",url('/'), $content);
      
      $content = str_replace("##PROJECT_NAME##",config('app.project.name'), $content);

      $content = view('admin.email.general', compact('content'))->render();
      $content = html_entity_decode($content);

      $arr_email['subject']= isset($subject)? $subject:'';

      $arr_email['from_mail'] =  isset($arr_email_template['template_from_mail']) ? $arr_email_template['template_from_mail'] : '';

      $send_mail = $this->send_mail($arr_email,$content);

      return $send_mail;
    }
    return FALSE;   
  }
  return false;
}

public function order_send_mail($arr_data = null)
{
  $status = false;

  if($arr_data!=null)
  {
    $arr_email['to_email_id'] = isset($arr_data['order_email'])?$arr_data['order_email']:'';
    $arr_email['to_name']     = isset($arr_data['order_fname'])?$arr_data['order_fname']:'';
    $locale                   = isset($arr_data['locale'])?$arr_data['locale']:'en';
    $subject                  = 'Ammaia : Invoice';
    $content                  = view('front.email.invoice', $arr_data)->render();
    $content                  = html_entity_decode($content);
    
    $pdf                  = PDF::loadView('front.email.invoice_pdf', $arr_data);
    $data                 = $pdf->save(base_path().'/uploads/invoices/'.$arr_data['order_id'].'.pdf');
    $arr_email['subject'] = isset($subject)? $subject:'';
    $status               = $this->send_mail($arr_email,$content);

    return $status;
  }
  return $status;
}
}