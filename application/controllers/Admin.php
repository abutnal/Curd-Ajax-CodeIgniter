<?php
class Admin extends MY_Controller{
	public $message;
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		$this->message = ['status'=>'<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Well done!</strong>Profile Updated successfully
						</div>'];
	}
	public function index(){
		$this->load->view('dashboard');
		
	}
	

	public function create(){
		$data = ['name'=>$this->input->post('name'),'phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'), 'photo'=>$_FILES['photo']['name']];
		$this->form_validation->set_rules('name','Name', 'trim|required');
		$this->form_validation->set_rules('phone','Phone', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if (empty($_FILES['photo']['name'])) {
		$this->form_validation->set_rules('photo', 'Profile Photo', 'required');
		}
		if($this->form_validation->run() == TRUE){
			if($this->admin_model->insert($data)){
				
				move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/image/'.basename($_FILES['photo']['name']));
				echo json_encode($this->message.'Profile saved successfully
						</div>');
			}
			else
			{
				
				echo json_encode($this->message.'Failed Try Again
						</div>');
			}
		}
		else{
			$errors = ['name'=>form_error('name','<p class="text-danger">','</p>'), 'phone'=>form_error('phone','<p class="text-danger">','</p>'), 'email'=>form_error('email','<p class="text-danger">','</p>'), 'photo'=>form_error('photo','<p class="text-danger">','</p>')];
			 echo json_encode($errors);
		}

	}


	 public function show(){
		$data = $this->admin_model->select_all('user_tbl');
		$count=1;
		$html="";
		$html .='<thead>';
		$html .='<th>SL</th>';
		$html .='<th>Name</th>';
		$html .='<th>Phone</th>';
		$html .='<th>Email</th>';
		$html .='<th>Photo</th>';
		$html .='<th>Action</th>';
		$html .='</thead>';
		foreach ($data as $row) {
		$html .='<tr>';
		$html .='<td>'.$count++.'</td>';
		$html .='<td>'.$row->name.'</td>';
		$html .='<td>'.$row->phone.'</td>';
		$html .='<td>'.$row->email.'</td>';
		$html .='<td><img src="'.base_url().'assets/image/'.$row->photo.'" width="30px" height="30px"></td>';
		$html .='<td><a href="" data-id="'.$row->user_id.'" id="update" class="btn btn-primary btn-xs">Edit</a>&nbsp;&nbsp;<a href="" data-id="'.$row->user_id.'" id="delete" class="btn btn-danger btn-xs">Delete</a></td>';
		$html .='</tr>';
		}
		echo json_encode($html);
	 }


	 public function update(){
	 	$data = $this->input->post();
	 	$where = ['user_id'=>$this->input->post('user_id')];
	 	unset($data['user_id']);
	 	$this->form_validation->set_rules('name','Name', 'required');
	 	$this->form_validation->set_rules('phone','Phone', 'required');
	 	$this->form_validation->set_rules('email','Email', 'required');
	 	if($this->form_validation->run() == TRUE){
	 		if($this->admin_model->update('user_tbl',$data, $where)){
				echo json_encode($this->message);
	 		}
	 		else{
	 			$message = ['status'=>'<div class="alert alert-dismissible alert-warning">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Well done!</strong> Failed to update, Try again
						</div>'];
				echo json_encode($message);
	 		}
	 	}
	 	else{
	 		$errors = ['name'=>form_error('name','<p class="text-danger">','</p>'), 'phone'=>form_error('phone','<p class="text-danger">','</p>'), 'email'=>form_error('email','<p class="text-danger">','</p>')];
	 		echo json_encode($errors);
	 	}
	 }



	public function select_where(){
		if (isset($_POST['update'])) {
			$where = ['user_id'=>$_POST['user_id']];
		$html = "";
		$data = $this->admin_model->select_where('user_tbl',$where);
		foreach ($data as $row) {
		$html .='<div class="panel panel-primary" id="update_form">';
		$html .='<div class="panel-heading">Profile Form</div>';
		$html .='<div class="panel-body">';
		$html .='<div class="row"><div id="errors"></div>';
		$html .='<form action="'.base_url('admin/update').'" method="post" enctype="multipart/form-data" id="updateForm">';
		$html .='<div class="col-md-12">
		<input type="hidden" value="'.$row->user_id.'" name="user_id">
		<input type="text" value="'.$row->name.'" name="name" placeholder="Name" id="" class=" form-control">
						<div id="error-name"></div>
		</div>';
		$html .='<div class="col-md-12"><input type="text" value="'.$row->phone.'" name="phone" placeholder="phone" id=""class="form-control">
				<div id="error-phone"></div>
		</div>';
		$html .='<div class="col-md-12"><input type="text" value="'.$row->email.'" name="email" placeholder="Email" id=""class="form-control">
			<div id="error-email"></div>
		</div>';
		$html .='<div class="col-md-12"><div class="form-group">
		<img src="'.base_url('assets/image/').$row->photo.'" style="max-width:200px; max-height:50px; width:auto; height:50px;">
		<input type="file" value="" name="photo" placeholder="" id="" class="form-control"></div></div> ';
		$html .='<div class="col-md-12">';
		$html .='<a href="" id="cancel" class="btn btn-default pull-left">Back</a>';
		$html .='<input type="submit" value="Update" name="update"  id="" class="btn btn-primary pull-right"></div>';
		$html .='</form>';
		$html .='</div>';
		$html .='</div>';
		$html .='</div>';
		}
			echo json_encode($html);
		}
	}


	public function delete(){
		$where = ['user_id'=>$this->input->post('user_id')];
		if($this->admin_model->delete('user_tbl', $where))
		{
			$message = ['status'=>'<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Well done!</strong> Record Deleted successfully.
						</div>'];
				echo json_encode($message);
		}
	}

} 


