<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SalaryController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AddAdvancedSalary()
    { 
      $employee = DB::table('employees')->get();
      return view('advanced_salary', compact('employee'));
    }

    public function AllSalary()
    {
      $salary=DB::table('advance_salaries')
             ->join('employees','advance_salaries.emp_id','employees.id')
             ->select('advance_salaries.*','employees.name','employees.salary','employees.photo')
             ->orderBy('id','DESC')
             ->get();
    	return view('all_advanced_salary', compact('salary'));
    }

    public function InsertAdvanced(Request $request)
    {
    	$month=$request->month;
    	$emp_id=$request->emp_id;
   	
   		$advanced=DB::table('advance_salaries')
   		          ->where('month',$month)
   		          ->where('emp_id',$emp_id)
   		          ->first();

   		if ($advanced === NULL) {
   		    $data=array();
	    	$data['emp_id']=$request->emp_id;
	    	$data['month']=$request->month;
	    	$data['advanced_salary']=$request->advanced_salary;
	    	$data['year']=$request->year;

    	 $advanced=DB::table('advance_salaries')->insert($data);
    	  if ($advanced) {
                 $notification=array(
                 'messege'=>'Successfully Advanced Paid ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
   		    }else{
   		    	$notification=array(
                 'messege'=>'Oopss !! Allready advanced Paid in this month! ',
                 'alert-type'=>'error'
                  );
                 return Redirect()->back()->with($notification);
   		    }          	
    }

    public function PaySalary()
    {

        $employee=DB::table('employees')
        
        ->get();
        return view('pay_salary', compact('employee')); 

    }




    //Category Function are here------------------------------

    public function AddCategory()
    {
      return view('add_category');
    }

    public function InsertCategory(Request $request)
    {
      $data=array();
      $data['cat_name']=$request->cat_name;
      $cat=DB::table('categories')->insert($data);
       if ($cat) {
                 $notification=array(
                 'messege'=>'Successfully Category Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             } 

    }

      public function AllCategory()
    {
      $category=DB::Table('categories')->get();
      return view('all_category', compact('category'));
    }

    public function DeleteCategory($id)
    {
      $dlt=DB::table('categories')->where('id',$id)->delete();
      if ($dlt) {
                 $notification=array(
                 'messege'=>'Successfully Category Deleted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             } 
    }

    public function EditCategory($id)
    {
      $cat=DB::table('categories')->where('id',$id)->first();
      return view('edit_category')->with('cat',$cat);
    }

    public function UpdateCategory(Request $request,$id)
    {
       $data=array();
       $data['cat_name']=$request->cat_name;
       $cat_up=DB::table('categories')->where('id',$id)->update($data);
        if ($cat_up) {
                 $notification=array(
                 'messege'=>'Successfully Category Updated ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all.category')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }
    }

    public function PayAdvanced($id)
    {
       $advanced = DB::table('advance_salaries')
            ->where('id', $id)
            ->first();
        return view('advanced_pay', compact('advanced'));
    }

    public function SalaryPay($id)
    {
        $employees = DB::table('employees')
           ->where('id', $id)
           ->first();
         return view('salary_pay', compact('employees'));
    }

    public function InsertSalary(Request $request)
    {
        $salary_month=$request->salary_month;
        $employee_id=$request->employee_id;
        $paid_ammount=DB::table('salaries')
                ->where('salary_month',$salary_month)
                ->where('employee_id',$employee_id)
                ->first();
        if($paid_ammount === NULL)
        {
            $data = array();
            $data['employee_id'] = $request->employee_id;
            $data['salary_month'] = $request->salary_month;
            $data['paid_amount'] = $request->paid_amount;
            $insert_salary = DB::table('salaries')->insert($data);
            if ($insert_salary) {
                 $notification=array(
                 'messege'=>'Successfully Salary Paid ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
          }else{
            $notification=array(
                 'messege'=>'Oopss !! Allready Salary Paid in this month! ',
                 'alert-type'=>'error'
                  );
                 return Redirect()->back()->with($notification);
          } 
        }

        public function AllPaidSalary()
        {
            $all_paid_salary = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('salaries.*', 'employees.name')
            ->get();
            return view('all_paid_salary', compact('all_paid_salary'));
        }


        public function CategoryDetails($id)
        {
           $cat = DB::table('products')
               ->join('categories', 'products.cat_id', 'categories.id')
               ->select('products.*', 'categories.cat_name')
               ->where('categories.id', $id)
               ->get();
           return view('category_details', compact('cat'));
        }
    

}

