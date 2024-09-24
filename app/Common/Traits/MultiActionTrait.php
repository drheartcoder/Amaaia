<?php 

namespace App\Common\Traits;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flash;
use Session;
use Validator;
 
trait MultiActionTrait
{
    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action'] = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Session::flash('Please Select '.$this->module_title.' To Perform Multi Actions');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Session::flash('error', 'Problem Occurred, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {

               $resDelete = $this->perform_delete(base64_decode($record_id));    
                Session::flash('success', $this->module_title. ' Deleted Successfully');
            } 
            elseif($multi_action=="activate")
            {

               $resActive = $this->perform_unblock(base64_decode($record_id)); 
               Session::flash('success', $this->module_title. ' Activated Successfully');
            }
            elseif($multi_action=="deactivate")
            {

               $resDeactive = $this->perform_block(base64_decode($record_id));   
               Session::flash('success', $this->module_title. ' inactivated Successfully');
            }
            elseif($multi_action=="approve")
            {

               $resApprove = $this->perform_unapprove(base64_decode($record_id)); 
               Session::flash('success', $this->module_title. ' Approved Successfully');
            }
            elseif($multi_action=="unapprove")
            {

               $resUnapprove = $this->perform_approve(base64_decode($record_id));   
               Session::flash('success', $this->module_title. ' Unapproved Successfully');
            }
        }

        return redirect()->back();
    }

    public function unblock($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_unblock(base64_decode($enc_id)))
        {
            Session::flash('success', str_singular($this->module_title). ' Activated Successfully');
            return redirect()->back();
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.str_singular($this->module_title).' Activation ');
        }

        return redirect()->back();
    }

    public function block($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_block(base64_decode($enc_id)))
        {
            Session::flash('success', str_singular($this->module_title). ' inactivated Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.str_singular($this->module_title).' Deactivation ');
        }

        return redirect()->back();
    }

    public function delete($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_delete(base64_decode($enc_id)))
        {
            Session::flash('success', str_singular($this->module_title). ' Deleted Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.str_singular($this->module_title).' Deletion ');
        }

        return redirect()->back();
    }

    /*public function approve($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_approve(base64_decode($enc_id)))
        {
            Session::flash('success', $this->module_title. ' Approved Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title. ' Approved');
        }

        return redirect()->back();
    }

    public function unapprove($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_unapprove(base64_decode($enc_id)))
        {
            Session::flash('success', $this->module_title. ' rejected Successfully');
        }
        else
        {
            Session::flash('error', 'Problem Occured While '.$this->module_title. ' rejecting');
        }

        return redirect()->back();
    }*/


    public function perform_unblock($id)
    {
        if($id!=null)
        {
            $responce = $this->BaseModel->where('id',$id)->update(['status'=>'1']);
            if($responce)
            {
                return TRUE;
            }
            return FALSE;            
        }
        return FALSE;
    }

    public function perform_block($id)
    {   
        if($id!=null)
        {
            $responce = $this->BaseModel->where('id',$id)->update(['status'=>'0']);
            if($responce)
            {
                return TRUE;
            }  
            return FALSE;          
        }
        return FALSE;
    }

   /* public function perform_approve($id)
    {
        if($id!=null)
        {
            $responce = $this->BaseModel->where('id',$id)->update(['admin_approval'=>'1']);
            if($responce)
            {
                return TRUE;
            }  
            return FALSE;          
        }
        return FALSE;
    }

    public function perform_unapprove($id)
    {
        if($id!=null)
        {
            $responce = $this->BaseModel->where('id',$id)->update(['admin_approval'=>'2']);
            if($responce)
            {
                return TRUE;
            }  
            return FALSE;          
        }
        return FALSE;
    }*/

    public function perform_delete($id)
    {
        $delete= $this->BaseModel->where('id',$id)->delete();
        
        if($delete)
        {
            return TRUE;
        }
        return FALSE;
    }
}
