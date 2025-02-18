<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class product
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}


	public function filter($query, $start, $end)
	{
		// $tukhoa = $this->fm->validation($tukhoa);
		// $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
		$query .= " LIMIT $start,$end  ";
		$result = $this->db->select($query);
		return $result;
	}
	public function search_product($tukhoa)
	{
		$tukhoa = $this->fm->validation($tukhoa);
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

		FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

		INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE productName LIKE '%$tukhoa%' OR brandName LIKE '%$tukhoa%' 
		OR catName LIKE '%$tukhoa%' OR product_desc  LIKE '%$tukhoa%' ";
		// $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
		$result = $this->db->select($query);
		return $result;
	}
	public function insert_image_byId($productId, $data)
	{
		$query = "INSERT INTO tbl_image(productId, link) VALUES('$productId', '$data')";
		$result = $this->db->insert($query);
	}
	public function insert_product($data, $files)
	{


		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];
		$file_image_library = $_FILES['files']['name'];
		$file_image_name = implode(",", $file_image_library);

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;

		if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "") {
			$alert = "<span class='error'>Fields must be not empty</span>";
			return $alert;
		} else {
			if (!empty($file_image_library)) {
				foreach ($file_image_library as $key => $val) {
					$files_tmp = "uploads/" . $val;
					move_uploaded_file($_FILES['files']['tmp_name'][$key], $files_tmp);
				}
			}

			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
			$result = $this->db->insert($query);
			// insert anh by productId
			$query1 = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 1";
			$result_image = $this->db->select($query1);


			if ($result_image) {
				print_r($file_image_name);
				$row = $result_image->fetch_assoc();
				if ($row)
				// print_r($row);
				{
					$result1 = $this->insert_image_byId($row['productId'], $file_image_name);
				}
			}
			if ($result) {
				$alert = "<span class='success'>Insert Product Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Insert Product Not Success</span>";
				return $alert;
			}
		}
	}
	public function insert_slider($data, $files)
	{
		$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);

		//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;


		if ($sliderName == "" || $type == "") {
			$alert = "<span class='error'>Fields must be not empty</span>";
			return $alert;
		} else {
			if (!empty($file_name)) {
				//Nếu người dùng chọn ảnh
				if ($file_size > 2048000) {

					$alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					return $alert;
				} elseif (in_array($file_ext, $permited) === false) {
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
					$alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unique_image')";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='success'>Slider Added Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Slider Added Not Success</span>";
					return $alert;
				}
			}
		}
	}
	public function show_slider()
	{
		$query = "SELECT * FROM tbl_slider where type='1' order by sliderId desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_slider_list()
	{
		$query = "SELECT * FROM tbl_slider order by sliderId desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_product()
	{
		// $query = "

		// SELECT p.*,c.catName, b.brandName

		// FROM tbl_product as p,tbl_category as c, tbl_brand as b where p.catId = c.catId 

		// AND p.brandId = b.brandId 

		// order by p.productId desc";

		$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 

			order by tbl_product.productId desc";

		// $query = "SELECT * FROM tbl_product order by productId desc";

		$result = $this->db->select($query);
		return $result;
	}
	public function update_type_slider($id, $type)
	{

		$type = mysqli_real_escape_string($this->db->link, $type);
		$query = "UPDATE tbl_slider SET type = '$type' where sliderId='$id'";
		$result = $this->db->update($query);
		return $result;
	}
	public function del_slider($id)
	{
		$query = "DELETE FROM tbl_slider where sliderId = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Slider Deleted Successfully</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Slider Deleted Not Success</span>";
			return $alert;
		}
	}
	public function update_product($data, $files, $id)
	{


		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];
		$file_image_library = $_FILES['files']['name'];
		$file_image_name = implode(",", $file_image_library);

		// print_r($file_image_name);
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;


		if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "") {
			$alert = "<span class='error'>Fields must be not empty</span>";
			return $alert;
		} else {
			if ($file_image_library != "") {

				foreach ($file_image_library as $key => $val) {
					$files_tmp = "uploads/" . $val;
					move_uploaded_file($_FILES['files']['tmp_name'][$key], $files_tmp);
				}
				if ($file_image_name) {
					$query1 = "UPDATE tbl_image SET link='$file_image_name' WHERE productId = '$id'";
					$result_image = $this->db->update($query1);
				}
			}
			if (!empty($file_name)) {
				//Nếu người dùng chọn ảnh
				if ($file_size > 2048000) {

					$alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					return $alert;
				} elseif (in_array($file_ext, $permited) === false) {
					//  echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
					$alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "UPDATE tbl_product SET
					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					image = '$unique_image',
					product_desc = '$product_desc'
					WHERE productId = '$id'";
			} else {
				//Nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_product SET

					productName = '$productName',
					brandId = '$brand',
					catId = '$category', 
					type = '$type', 
					price = '$price', 
					
					product_desc = '$product_desc'

					WHERE productId = '$id'";
			}
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Product Updated Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Product Updated Not Success</span>";
				return $alert;
			}
		}
	}
	public function del_product($id)
	{
		$query = "DELETE FROM tbl_product where productId = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Product Deleted Successfully</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Product Deleted Not Success</span>";
			return $alert;
		}
	}
	public function del_wlist($proid, $customer_id)
	{
		$query = "DELETE FROM tbl_wishlist where productId = '$proid' AND customer_id='$customer_id'";
		$result = $this->db->delete($query);
		return $result;
	}
	public function getproductbyId($id)
	{
		$query = "SELECT * FROM tbl_product where productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	//END BACKEND 
	public function getImageByProductId($productId)
	{

		$query = "SELECT * FROM tbl_image WHERE productId=" . $productId;
		$result = $this->db->select($query);
		//    $data[]="k dk";
		//    $data[]=$query;
		//    $data[]=$result;
		//    $data['image'] = mysqli_fetch_all($result,MYSQLI_ASSOC);
		//    $data[]=$row;
		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row['link'];
			}
		}
		$result = explode(",", $data[0]);
		return $result;
	}
	public function getproduct_feathered()
	{
		$query = "SELECT * FROM tbl_product where type = '0' order by RAND()  ";
		$result = $this->db->select($query);
		return $result;
	}
	//New Products
	public function getNew_product()
	{

		$query = "SELECT * FROM tbl_product order by productId desc LIMIT 5";
		$result = $this->db->select($query);
		return $result;
	}
	//Hàng bán chạy
	public function getproduct_topSelling($start, $end)
	{
		$query = "SELECT * FROM tbl_product INNER JOIN tbl_order ON tbl_product.productId = tbl_order.productId LIMIT $start,$end";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_store($start, $end)
	{
		$query = "SELECT * FROM tbl_product  LIMIT $start,$end";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_new()
	{
		$sp_tungtrang = 4;
		if (!isset($_GET['trang'])) {
			$trang = 1;
		} else {
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang - 1) * $sp_tungtrang;
		$query = "SELECT * FROM tbl_product order by productId desc LIMIT $tung_trang,$sp_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}


	public function get_all_product()
	{
		$query = "SELECT * FROM tbl_product";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_details($id)
	{
		$query = "

			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 

			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 

			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'

			";

		$result = $this->db->select($query);
		return $result;
	}
	public function getRelatedProduct($brandId, $catId)
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '$brandId' or catId='$catId' order by productId desc LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestDell()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '6' order by productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestOppo()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '3' order by productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestHuawei()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '4' order by productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestSamsung()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId = '2' order by productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_compare($customer_id)
	{
		$query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_wishlist($customer_id)
	{
		$query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function insertCompare($productid, $customer_id)
	{

		$productid = mysqli_real_escape_string($this->db->link, $productid);
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

		$check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id ='$customer_id'";
		$result_check_compare = $this->db->select($check_compare);

		if ($result_check_compare) {
			$msg = "<span class='error'>Product Already Added to Compare</span>";
			return $msg;
		} else {

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();

			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];



			$query_insert = "INSERT INTO tbl_compare(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_compare = $this->db->insert($query_insert);

			if ($insert_compare) {
				$alert = "<span class='success'>Added Compare Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Added Compare Not Success</span>";
				return $alert;
			}
		}
	}
	public function insertWishlist($productid, $customer_id)
	{
		$productid = mysqli_real_escape_string($this->db->link, $productid);
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

		$check_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
		$result_check_wlist = $this->db->select($check_wlist);

		if ($result_check_wlist) {
			$msg = "<span class='error'>Product Already Added to Wishlist</span>";
			return $msg;
		} else {

			$query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();

			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];



			$query_insert = "INSERT INTO tbl_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_wlist = $this->db->insert($query_insert);

			if ($insert_wlist) {
				$alert = "<span class='success'>Added to Wishlist Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Added to Wishlist Not Success</span>";
				return $alert;
			}
		}
	}
}
?>