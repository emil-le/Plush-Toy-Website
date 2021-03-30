<?php
    function url()
    {
        $link = "http://localhost/PlushToy/";
        return $link;
    }

    function redirect_to($page = 'index.php') {
        $url = url(). $page;
        header("Location: $url");
        exit();
    }
	function dd($data, $exit = true)
    {
        echo"<pre>";
        print_r($data);
        echo"<pre>";

        if($exit)
        {
            die;
        }
    }// end pre

    function safe_title($str = '')
    {
        $str = html_entity_decode($str, ENT_QUOTES, "UTF-8");
        $filter_in = array('#(a|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#', '#(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#', '#(e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#', '#(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#', '#(i|ì|í|ị|ỉ)#', '#(I|ĩ|Ì|Í|Ị|Ỉ|Ĩ)#', '#(o|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#', '#(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#', '#(u|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#', '#(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#', '#(y|ỳ|ý|ỵ|ỷ|ỹ)#', '#(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)#', '#(d|đ)#', '#(D|Đ)#');
        $filter_out = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'y', 'Y', 'd', 'D');
        $text = preg_replace($filter_in, $filter_out, $str);
        $text = preg_replace('/[^a-zA-Z0-9]/', ' ', $text);
        $text = trim(preg_replace('/ /', '-', trim(strtolower($text))));
        $text = preg_replace('/--/', '-', $text);
        $text = preg_replace('/--/', '-', $text);
        return preg_replace('/--/', '-', $text);
    }// end safe_title


    function the_excerpt($text,$num)
    {
        
        if(strlen($text)> $num)
        {
            $cutstring = substr($text,0,$num);
            $word = substr($text,0,strrpos($cutstring,' '));
            return $word ;
        }
        else
        {
            return $text;
        }
    }//end the_excerpt

    function pagination($display,$table,$link,$record)
	{
		global $start;
		if(isset($_GET['p']) && filter_var($_GET['p'] , FILTER_VALIDATE_INT,array('min_range' =>1)))
			{
				$page = $_GET['p'];
			}
			else
			{
				if($record > $display)
				{
					$page = ceil($record / $display);
				}
				else{
					$page = 1;
				}
			}
			$output = "<ul class ='pagination'>";
		if($page >1)
		{
			$current_page = ($start / $display) +1;
			if($current_page!=1)
			{
				$output .="<li class='paginate_button previous' id='example1_previous'>
                    <a href='".$link."?s=".($start - $display)."&p={$page}'aria-controls='example1' data-dt-idx='0' tabindex='0'>Previous</a></li>";
			}
			for($i=1;$i<=$page;$i++)
			{
				if($i != $current_page)
				{
					$output .="<li><a href='".$link."?s=".($display * ($i-1))."&p={$page}' aria-controls='example1' data-dt-idx='1' tabindex='".$i."'>{$i}</a></li>";
					
				}
				else
				{
					$output .="<li ><a href='".$link."?s=".($display * ($i-1))."p={$page}' aria-controls='example1' data-dt-idx='1' tabindex='".$i."'>{$i}</a></li>";
				}
			}//end for loop
			 
			if($current_page != $page)
			{
				$output .="<li class='paginate_button next' id='example1_next'><a href='".$link."?s=".($start + $display)."&p={$page}' aria-controls='example1' data-dt-idx='7' tabindex='0'>Next</a></li>";
			}
		}// end pagination section
		$output .="</ul>";	
		return $output ;
	}// end pagination


    // Hàm phân trang, gồm các biến
    // $display: số lượng sản phẩm hiện thị
    // $table : bảng dữ liệu
    // $link : url 
    // $record : tổng số lượng sản phẩm
    function navigation($display,$table,$link,$record)
    {
        global $start;
        if(isset($_GET['p']) && filter_var($_GET['p'] , FILTER_VALIDATE_INT,array('min_range' =>1)))
            // kiểm tra số trang hiện tại
            {
                $page = $_GET['p'];
            }
            else // nếu không có thì kiểm tra số lượng hiện thị có lớn hơn
            // tổng số trang hay không, nếu có thì phân trang
            {
                if($record > $display)
                {
                    $page = ceil($record / $display);
                }
                else{
                    $page = 1;
                }
            }
            $output = "<ul>";
        if($page >1) //hiện thị thanh phân trang
        {
            $current_page = ($start / $display) +1; //trang hiện tại
            if($current_page!=1) // nếu không phải trang 1 thì xuất ra html bên dưới
            {
                $output .="<li class='pagination-previous' id='example1_previous'>
                    <a href='".$link."s=".($start - $display)."&p={$page}'aria-controls='example1' data-dt-idx='0' tabindex='0'>Previous</a></li>";
            }

            for($i=1;$i<=$page;$i++) //tạo link cho các số trang
            {
                if($i != $current_page)
                {
                    $output .="<li> <a href='".$link."s=".($display * ($i-1))."&p={$page}' aria-controls='example1' data-dt-idx='1' tabindex='".$i."'>{$i}</a></li>";
                    
                }
                else
                {
                    $cls = "class = 'active'";
                    $output .="<li <?php if(isset ($page)){ echo  $cls ;} ><a href='".$link."s=".($display * ($i-1))."p={$page}' aria-controls='example1' data-dt-idx='1' tabindex='".$i."'>{$i}</a></li>";
                }
            }//end for loop

            if($current_page != $page) //Hiện thị Next và Previous 
            {
                $output .="<li class='pagination-next' id='example1_next'><a href='".$link."&s=".($start + $display)."&p={$page}' aria-controls='example1' data-dt-idx='7' tabindex='0'>Next</a></li>";
            }
        }// end pagination section
        $output .="</ul>";  
        return $output ;
    }// end pagination

	function validate_id($id)
	{
		if(isset($id) && filter_var($id,FILTER_VALIDATE_INT,array('min_range'=>1)))
		{
			$val_id = $id;
			return $val_id;
		}
		else
		{
			return NULL;
		}
		
	}// end validate_id

	function the_content($text)
	{
		$sanitized = htmlentities($text,ENT_COMPAT,'UTF-8');
		return str_replace(array("\r\n"),array("<p>","</p>"),$sanitized);
	}

	function clean_email($value)
	{
		$suspects = array('to:', 'bcc:','cc:','content-type:','mime-version:', 'multipart-mixed:','content-transfer-encoding:');
		foreach ($suspects as $s)
		{
			if(strpos($value,$s) !== FALSE)
			{
				return '';
			}
			
			$value = str_replace(array('\n', '\r', '%0a', '%0d'), '', $value);
			return trim($value);
		}
	}

    function get_client_ip()
    {
    	$str= "cao da";
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress ;
    }

    /**
     * 
     *
     * @param  url $link
     * @return html
     */
    
    if ( ! function_exists('makeDeleteButton'))
    {
        function makeDeleteButton($link) {
            echo '<a class="btn btn-xs btn-danger" href="'. $link .'"><i class="icon-trash"></i></a>';
        }
    }

    if ( ! function_exists('makeEditButton'))
    {
        function makeEditButton($link) {
            echo '<a class="btn btn-xs btn-success" href="'. $link .'"><i class="icon-pencil"></i></a>';
        }
    }
    

    /**
     * show active button
     *
     * @param  url $link
     * @param  integer $currentActiveValue
     * @return html
     */
    
    if (! function_exists('makeActiveButton'))
    {
        function makeActiveButton($link, $currentActiveValue) {
            $classActive = $currentActiveValue == 1 ? 'fa-check-square' : 'fa-square-o';
            return '<a class="btn-action btn-xs btn-active-action" href="'. $link .'"><i class="fa '. $classActive .' fa-2x"></i></a>';
        }
    }

    if(! function_exists('testInputString'))
    {
	    function testInputString($data)
	    {
	    	if(isset($data) && !empty($data))
	    	{
	    		$data = strip_tags($data);
	    		return $data;
	    	}else
	    	{
	    		return false;
	    	}
	    }
	}
	if(!function_exists("testInputInt"))
	{
	     function testInputInt($data)
	    {
	    	if(isset($data) && filter_var($data,FILTER_VALIDATE_INT,array('min_range'=>1)))
			{
				$data = strip_tags($data);
				return $data;
			}else
			{
				return false;
			}
	    }
	}

	if(! function_exists('isset_sesion'))
	{
		function isset_sesion($data)
		{
			if (isset($data)) {
				# code...
				return $data;
			}
			else
			{
				return false;
			}
		}
	}

	if (! function_exists('get_date')) {
		# code...
		function get_date()
		{
			$now = getdate();
			return $currentDate = $now["mday"] . "/" . $now["mon"] . "/" . $now["year"]; 
		}
	}

    if ( ! function_exists('rdr_url'))
    {
        function rdr_url($url = "")
        {
            header("Location: {$url}",true, 301);
            exit();
        }
    }

    if (!function_exists("warning")) {
    	# code...
    	function warning($data)
    	{
    		echo"<div class='alert alert-danger customalert'>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> ".$data."
                  </div>";
                  
    	}
    }

    if(! function_exists("success"))
    {
    	function success($data)
    	{
    		echo "<div class='alert alert-success customalert' id='alertjs'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$data."
                    
                  </div>";
                  
    	}
    }

   
    if (!function_exists('uploadImage')) {
        # code...
        function uploadImage($data,$folder ="",$action =" ")
        {

            if(isset($_FILES['image'])) {

                $allowed = array('image/jpeg', 'image/jpg', 'image/png', 'images/x-png');
                if(in_array(($_FILES['image']['type']), $allowed)) {

                    if(move_uploaded_file($_FILES['image']['tmp_name'], "../../upload/".$folder."/".$_FILES['image']['name'])) {
                        
                    } else {
                       
                        return true;
                    }
                } else {
                    $_SESSION['error'] = "Error unable to upload image loading (the image file you uploaded is not in the allowed format).";
                    rdr_url("../views/".$folder."/index.php?action=".$action);
                    return false;
                } 
            } // END isset $_FILES

            if(isset($_FILES['image']['tmp_name']) && is_file($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])) 
            {
                unlink($_FILES['image']['tmp_name']);
            }

            return  $_FILES['image']['name'];

        }
    }



    if(!function_exists('checkLogin'))
    {
        function checkLogin($id,$role_id)
        {
            if(isset($id) && isset($role_id) && !empty($id) && !empty($role_id))
            {
            }
            else
            {
                redirect_to('admin/views/');
            }
        }
    }


	

?>