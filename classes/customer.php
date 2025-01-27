<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class customer
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		//comment
		public function insert_binhluan($content,$productId,$customerId,$date,$rate){
			// $product_id = $_POST['product_id_binhluan'];
			// $tenbinhluan = $_POST['tennguoibinhluan'];
			// $binhluan = $_POST['binhluan'];
			if($content==''){
				$alert = "<span class='error'>Không để trống các trường</span>";
				return $alert;
			}else{
				$query = "INSERT INTO tbl_comment(content,productId,customerId,date,rate) VALUES('$content','$productId','$customerId','$date',$rate)";
					$result = $this->db->insert($query);
				
					return $result;
				// 	if($result){
				// 		$alert = "<span class='success'>Bình luận đã gửi</span>";
				// 		return $alert;
				// 	}else{
				// 		$alert = "<span class='error'>Bình luận không thành công</span>";
				// 		return $alert;
				// }
			}
		}
		public function del_comment($id){
			$query = "DELETE FROM tbl_comment where commentId ='$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa bình luận thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa bình luận không thành công</span>";
				return $alert;
			}
		}
		public function getComment($productId){
			$query = "SELECT * FROM tbl_comment INNER JOIN tbl_product ON tbl_comment.productId=tbl_product.productId 
			where tbl_product.productId ='$productId'";
			$result = $this->db->select($query);
			// if(mysqli_num_rows($result)){
			// 	while($row = $result->fetch_assoc()){
			// 		$data[] = $row;
			// 	}
			// 	return $data;
			// }
			return $result;
		}
		public function getCommentPage($productId,$start,$limit){
			$query = "SELECT * FROM tbl_comment INNER JOIN tbl_product ON tbl_comment.productId=tbl_product.productId
			where tbl_product.productId ='$productId' LIMIT $start,$limit";
			$result = $this->db->select($query);
			// if(mysqli_num_rows($result)){
			// 	while($row = $result->fetch_assoc()){
			// 		$data[] = $row;
			// 	}
			// 	return $data;
			// }
			return $result;
		}
		public function getRate($productId){
			$query = "SELECT * FROM tbl_comment INNER JOIN tbl_product ON tbl_comment.productId=tbl_product.productId 
			where tbl_product.productId ='$productId'";
			$result = $this->db->select($query);
			// if(mysqli_num_rows($result)){
			// 	while($row = $result->fetch_assoc()){
			// 		$data[] = $row;
			// 	}
			// 	return $data;
			// }
			return $result;
		}

		public function show_comment(){
			$query = "SELECT * FROM tbl_comment INNER JOIN tbl_product ON tbl_product.productId = tbl_comment.productId 
			INNER JOIN tbl_customer ON tbl_customer.id = tbl_comment.customerId order by commentId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_customers($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			// $city = mysqli_real_escape_string($this->db->link, $data['city']);
			if($data['zipcode']){
				$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			}else $zipcode = 0;
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			// $country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($name=="" || $email=="" || $address=="" || $phone =="" || $password ==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				header('location:index.php?action=home');

				return $alert;
			}else{
				$check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Email Already Existed ! Please Enter Another Email</span>";
					setcookie('err_resgiter', $alert, time() + 3600);
					header('location:index.php?action=login');
				}else{
					$query = "INSERT INTO tbl_customer(name,zipcode,email,address,phone,password) VALUES('$name','$zipcode','$email','$address','$phone','$password')";
					$result = $this->db->insert($query);
					if($result){
					$alert = "<script> window.location='index.php?action=login'; alert(\"Đăng ký thành công\"); </script>";

						// $alert = "<span class='success'>Customer Created Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Customer Created Not Successfully</span>";
						
						return $alert;
					}
				}
			}
		}
		public function login_customers($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($email=='' || $password==''){
				$err = "<span class='error'>Password and Email must be not empty</span>";
				setcookie('err_login', $err, time() + 3600);
				
				return false;
			}else{
				
				$check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
				$result_check = $this->db->select($check_login);
				if($result_check){
					$value = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['name']);
					$alert = "<script> window.location='index.php?action=home'; alert(\"Đăng nhập thành công\"); </script>";
					// return header("Location:index.php?action=home");
					return $alert;
				}else{
					$err = "<span class='error'>Email or Password doesn't match</span>";
					setcookie('err_login', $err, time() + 3600);

					return header("Location:index.php?action=login");
					return false;
				}
			}
		}
		public function getUserEmail($email){
			$query = "SELECT * FROM tbl_customer WHERE email='$email'";
			$result = $this->db->select($query);
			
			return $result;
		}
		//forgetPass	
		public function forgetPass($email,$pass){
			$pass = mysqli_real_escape_string($this->db->link, md5($pass));
			$query = "UPDATE  tbl_customer SET password='$pass' WHERE email='$email'";
			$result = $this->db->insert($query);
			$alert = "<script> window.location='index.php?action=login'; alert(\"Đổi mật khẩu thành công\"); </script>";
			
			return $alert;
		}	
		// public function forgetPass($email,$pass){
		// 	$pass = mysqli_real_escape_string($this->db->link, md5($pass));
		// 	$query = "UPDATE  tbl_customer SET password='$pass' WHERE email='$email'";
		// 	$result = $this->db->update($query);
		// 	$alert = "<script> window.location='index.php?action=login'; alert(\"Đổi mật khẩu thành công\"); </script>";
			
		// 	return $alert;
		// }
		public function updatePass($pass, $email){
			$query = "UPDATE tbl_customer SET password='$pass' WHERE email='$email'";
			$result = $this->db->update($query);
			
			return $result;
		}
		public function show_customers($id){
			$query = "SELECT * FROM tbl_customer WHERE id='$id'";
			$result = $this->db->select($query);
			
			return $result;
		}
		public function update_customers($data, $id){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			
			if($name=="" || $zipcode=="" || $email=="" || $address=="" || $phone ==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			}else{
				$query = "UPDATE tbl_customer SET name='$name',zipcode='$zipcode',email='$email',address='$address',phone='$phone' WHERE id ='$id'";
				$result = $this->db->insert($query);
				if($result){
						$alert = "<span class='success'>Customer Updated Successfully</span>";
						return $alert;
				}else{
						$alert = "<span class='error'>Customer Updated Not Successfully</span>";
						return $alert;
				}
				
			}
		}
		
		


	}
?>