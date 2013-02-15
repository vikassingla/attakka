<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb extends CI_Model
{
	 public function __construct()
    {
        parent::__construct();
		$CI = & get_instance();
		$CI->config->load("gt_config");
			
		$config = array		
		(
			'appId' => $CI->config->item('appId'),
			'secret' => $CI->config->item('secret'),
		);
		$this->load->library('Facebook',$config);
	}
	public function get_fb_user()
	{
		
	$user = $this->facebook->getUser();
		
        if($user) {
            try {
                $user_info = $this->facebook->api('/me');
                return $user_info;
            } catch(FacebookApiException $e) {
             //   echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
                $user = null;
            }
        } else {
           // echo "<a href=\"{$this->facebook->getLoginUrl()}\">Login using Facebook</a>";
		 $loginUrl = $this->facebook->getLoginUrl();
		   
		  
		   
		  // $loginUrl['canvas'] = 1;
		 //  $loginUrl['redirect_uri'] = 'http://apps.facebook.com/savethedatestory/';
		   
			
		 /*?> echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";<?php */
		  
	// this is local setting
	
	$app_id = '469181369767955';
	$app_secret = '95c430151b6a399a15a14048f43b6112';
	$canvas_page = "http://apps.facebook.com/movingofficeapp/";
	$canvas_url = "http://localhost:888/project/movingOfficeApp/";
	
	
	$display= 'page';
	$scope= 'manage_pages, offline_access, read_insights, publish_stream, user_about_me, user_likes, email'; 
	$redirect_url = 'http://apps.facebook.com/movingofficeapp/';
	$oauth_url    = 'https://www.facebook.com/dialog/oauth?canvas=1&client_id='.$app_id.'&display='.$display.'&redirect_uri='.urlencode($redirect_url).'&scope='.$scope;
	
	
	echo "<script type=\"text/javascript\">top.location.href = \"".$oauth_url."\";</script>";
	



 /*
 // this is live setting
 
 $app_id = '381120988613178';
$app_secret = 'b2e1a278c2d233bf8ee466018bcba1ee';
$canvas_page = "http://apps.facebook.com/savethedatestory/";
$canvas_url = "http://www.powerofvisuals.com/savethedatestory_fb/";


$display= 'page';
$scope= 'manage_pages, offline_access, read_insights, publish_stream, user_about_me, user_likes, email'; 
$redirect_url = 'http://apps.facebook.com/savethedatestory/';
$oauth_url    = 'https://www.facebook.com/dialog/oauth?canvas=1&client_id='.$app_id.'&display='.$display.'&redirect_uri='.urlencode($redirect_url).'&scope='.$scope;


echo "<script type=\"text/javascript\">top.location.href = \"".$oauth_url."\";</script>";
*/
		   
		   
        }
    }
	
	public function fb_profile_picture($size,$user_id)
	{
		//$picture = $this->facebook->api("/me/picture?type=.$size");
		
		$picture = "http://graph.facebook.com/$user_id/picture?type=$size";
		
		return $picture;
	}
	
	public function friends_of_me($user_id)
	{		
	$fql = "SELECT uid, first_name, last_name, email FROM user WHERE uid in (SELECT uid2 FROM friend where uid1 = ".$user_id.")";
	$friends = $this->facebook->api(array(
			'method'       => 'fql.query',
			'access_token' => $this->facebook->getAccessToken(),
			'query'        => $fql,
	));
	
	return $friends;	
	}
	function birthday_of_me($user_id)
	{
	$facebook = init_facebook();
	$fql = "SELECT birthday_date from user where uid='.$user_id.'";
	$birthday = $this->facebook->api(array(
	'method' => 'fql.query',
	'access_token' => $this->facebook->getAccessToken(),
	'query' => $fql,	
	));
	return $birthday;	
	}
	
	public function get_checkins($user_id, $user_location)
 	{
	  //SELECT coords, tagged_uids, page_id FROM checkin WHERE author_uid= me()
	 $xml_deocode_data = NULL;
	 $fql = "SELECT coords, tagged_uids, page_id FROM checkin WHERE author_uid=".$user_id;
	 $check_ins = $this->facebook->api(array(
	 'method' => 'fql.query',
	 'access_token' => $this->facebook->getAccessToken(),
	 'query' => $fql, 
	 ));
	 if(isempty($check_ins))
	 {
	 	$url = "http://where.yahooapis.com/geocode?q=".$user_location;
		$ch = curl_init($url);
 		curl_setopt($ch,CURLOPT_URL,$url);
 		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 		curl_setopt($ch, CURLPROTO_HTTPS, 1);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 		$xml_geocode_data = curl_exec($ch);
 		curl_close($ch);		
 		
	 }
  
 }
 
 
 public function friendlist($user_id)
	{		
	$fql = "SELECT uid, first_name, last_name FROM user WHERE uid in (SELECT uid2 FROM friend where uid1 = ".$user_id.")";
	$friends = $this->facebook->api(array(
			'method'       => 'fql.query',
			'access_token' => $this->facebook->getAccessToken(),
			'query'        => $fql,
	));
	
	return $friends;	
	}	
	
	public function get_detail($user_id)
	{	
		/*$fql = "SELECT uid, first_name, last_name, email ,location FROM user WHERE uid  = ".$user_id.")";
		$user_detail = $this->facebook->api(array(
				'method'       => 'fql.query',
				'access_token' => $this->facebook->getAccessToken(),
				'query'        => $fql,
		));*/

	
		$user_detail = $this->facebook->api("/$user_id", 'get', array("fields"=>"name,location,email"));
		return $user_detail;	
	}
	
	public function get_user_checkins($user_id)
	 
	{		
		$fql = "SELECT coords, tagged_uids, page_id FROM checkin WHERE author_uid=".$user_id;
		$check_ins = $this->facebook->api(array(
				'method'       => 'fql.query',
				'access_token' => $this->facebook->getAccessToken(),
				'query'        => $fql,
		));
		
		return $check_ins;	
	}	
		
	/*	public	function get_user_checkins($user_id)  
		 {  
			// $fql = "SELECT coords, tagged_uids, page_id FROM checkin WHERE author_uid=".$user_id;
			$user_info = $this->facebook->api('/me');
			$fql = 'SELECT coords, tagged_uids, page_id FROM checkin WHERE author_uid='. me();
			
			 $check_ins = $this->facebook->api(array(
			   'method'       => 'fql.query',
			   'access_token' => $this->facebook->getAccessToken(),
			   'query'        => $fql,
			 ));
			 
		 
		 	return $check_ins; 
		 }
	
	
	
	*/
		 
		 	public	function get_user_picture($user_id,$location_city)  
		 {  
			// $fql = "SELECT pid FROM photo_tag WHERE subject=".$user_id;
			
			//echo $fql = "SELECT aid, owner, name, object_id FROM album WHERE location=".$location_city;
			
			 $fql = "SELECT aid, owner, name, object_id FROM album WHERE owner =".$user_id;
			
			//SELECT aid, owner, name, object_id FROM album WHERE owner = (user id)
			 
			 $user_picture = $this->facebook->api(array(
			   'method'       => 'fql.query',
			   'access_token' => $this->facebook->getAccessToken(),
			   'query'        => $fql,
			 ));
			 
		 
		 	return $user_picture; 
		 }
		 
		 
		 	public	function album($user_id,$location_city)  
		 {  
			// $fql = "SELECT pid FROM photo_tag WHERE subject=".$user_id;
			
			//echo $fql = "SELECT aid, owner, name, object_id FROM album WHERE location=".$location_city;
			
			 $fql = "SELECT aid, owner, name, object_id  , link , description , size , visible FROM album WHERE aid='100002122158735_37224'";
			
			//SELECT aid, owner, name, object_id FROM album WHERE owner = (user id)
			 
			 $user_picture = $this->facebook->api(array(
			   'method'       => 'fql.query',
			   'access_token' => $this->facebook->getAccessToken(),
			   'query'        => $fql,
			 ));
			 
		 
		 	return $user_picture; 
		 }		 
		 public	function permission($user_id)  
		 {  
		 
			  $permission = $this->facebook->api(array(
					"method"    => "fql.query",
					'access_token' => $this->facebook->getAccessToken(),
					"query"     => "SELECT read_stream,offline_access,publish_stream FROM permissions WHERE uid=".$user_id
				));
			 return $check_ins; 
		 }
		 
	public function get_distance($location1, $location2)
	{
		$geocoding_loc_one = get_long_lat($location1);
		$geocoding_loc_two = get_long_lat($loscation2);
		$lat1 = $geocoding_loc_one['lat'];
		$lat2 = $geocoding_loc_two['lat'];
		$long1 = $geocoding_loc_one['lng'];
		$long2 = $geocoding_loc_two['lng'];
		$R= 6371;
		$dif_lat = deg2rad($lat2-$lat1);
		$dif_long = deg2rad($long2-$long1);
		$lat1 = deg2rad($lat1);
		$lat2 = deg2rad($lat2);
		$a = sin($dif_lat/2) * sin($dif_lat/2) + sin($dif_long)* sin($dif_long) * cos($lat1) * cos($lat2);
		$c = 2 * atan2(sqrt($a), sqrt(1-$a));
		$distance = $R * $c;
		return $distance;
	}
public function get_long_lat($location)
{
	
		 $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$location.'&sensor=false';
		
		$ch = curl_init($url);
 		curl_setopt($ch,CURLOPT_URL,$url);
 		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 		curl_setopt($ch, CURLPROTO_HTTPS, 1);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 		$data = curl_exec($ch);
		
 		curl_close($ch);
		
	
		$json_object = json_decode($data,true);
		
		return $json_object;

		
	
 	/*	if(empty($json_object))  
  		{
  			return -1;
  		}	  
  		else 
  		{
  		 	$gecoding = array (
  								'lng' => $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'},
  								'lat' => $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}
							   ); 
							   
		//	print_r($geocoding);
				   
			
  			return $geocoding;
  		}*/
		
		
		
		
}	


function get_lat_lng($address)
{
	
	
	
	$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
	
	
	$json = json_decode($json);

	
	
	$gecoding = array ();
	//status
	
/*	stdClass Object
(
    [results] => Array
        (
        )

    [status] => ZERO_RESULTS
)
	
	*/
//	echo  $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	
	if(!empty($json->results)){
	
	$gecoding = array (
  								'lng' => $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'},
  								'lat' =>  $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}
							   ); 
							   
	//print_r($gecoding);		
	}				   
		
							   
	return $gecoding ;							   
	
	
}
	
  
	

public function return_near_by_friends_by_location()
{
  $friends = array();
  $me = $this->get_fb_user();
  
  $session_get_fb_user_detail = $this->session->userdata('get_fb_user_detail');
  $user_id = $session_get_fb_user_detail['id'];

	if(empty($session_get_fb_user_detail['id']))
	{	
		echo 	"cookies are not allowed please allow cookies to proceed - please select your browser to know how to do that <br/>";
		echo	'<a href="http://support.google.com/chrome/bin/answer.py?hl=en&answer=95647"> Chrome</a><br/>';
		echo	'<a href="http://www.wikihow.com/Block-and-Accept-Cookies-in-Internet-Explorer"> Internet Explorer</a><br/>';
		echo	'<a href="http://helpcenter.suntrust.com/doc/sn6427.xml?TOPNAME=Browser+Support&NAME=Safari"> Safari</a><br/>';
		echo	'<a href="http://support.mozilla.org/en-US/kb/Websites%20say%20cookies%20are%20blocked"> Fire Fox</a><br/>';
		die("browser cookies are blocked please allow cookies to run this application");
	}
		
		
		//$data['session_data'] = $session_get_fb_user_detail;
 
 // if(!isset($me['current_location']['name']))
 // {
 		//  $me['current_location']['name'] = 'Indore';
   
//  }
 //$fql = 'SELECT uid, first_name,last_name, current_location FROM user WHERE uid in (SELECT uid2 FROM friend WHERE uid1 = '.$me['id'].')';
 
 $fql = 'SELECT uid, first_name,last_name, current_location FROM user WHERE uid in (SELECT uid2 FROM friend WHERE uid1 = '.$user_id.')';
 
 $friends = $this->facebook->api(array(
   'method'       => 'fql.query',
   'access_token' => $this->facebook->getAccessToken(),
   'query'        => $fql,
 ));
 $i=0;

 
/*//echo $me['current_location']['name'];
 foreach($friends as $row)
 {
	 if($me['current_location']['name'] == $row['current_location'])
	 {
		 $friends_array[$i] = $row;
		 $i++;
	 }
 }*/
 
/* print_r('<pre>');
 print_r($friends_array);*/
 
 return $friends; 
 
}

	public function get_fb_album_by_user_id($user_id)
	{
		//SELECT aid, owner, name, object_id FROM album WHERE aid="20531316728_324257"
		$albums = 'SELECT aid, owner, name, object_id FROM album WHERE owner='.$user_id;
		$places = $this->facebook->api(array(
	   'method'       => 'fql.query',
	   'access_token' => $this->facebook->getAccessToken(),
	   'query'        => $fql,
	 ));
	 return $albums;
			
		
	}
	
	public function get_page_id_by_user_id($user_id, $resource_type)
	{
		$resource_type = 'photo';
		//SELECT id, tagged_uids FROM location_post WHERE page_id=110506962309835
		$photos[]=NULL;	
		$fql = 'SELECT page_id, tagged_uids FROM location_post WHERE author_uid='. $user_id;
		$page_ids = $this->facebook->api(array(
	   'method'       => 'fql.query',
	   'access_token' => $this->facebook->getAccessToken(),
	   'query'        => $fql,
	 ));
	 $ziseof = $page_ids;
	 for($i = 0 ; $i < $sizeof ; $i++ )
	 {
		if($page_ids[i]['type']='photo')
		$photos = array
		(
			'page_ide' => $page_ids[i]['page_id'],
		);
	 }
	 return $photos;
	 }
		


	public function get_fb_user_album($user_id){
	//SELECT aid, owner, name, object_id FROM album WHERE aid="20531316728_324257"
	
		//SELECT id, tagged_uids FROM location_post WHERE page_id=110506962309835
		$fql = 'SELECT aid, owner, name, object_id FROM album WHERE owner='.$user_id;
		$albums = $this->facebook->api(array(
	   'method'       => 'fql.query',
	   'access_token' => $this->facebook->getAccessToken(),
	   'query'        => $fql,
	 ));
	 return $albums;
		
	}

	public function get_fb_photos_by_album_id($album_id)
	{
		//$album_id = "100002122158735_37224";
		//SELECT id, tagged_uids FROM location_post WHERE page_id=110506962309835
		$fql = 'SELECT pid FROM photo WHERE owner='.'"'.$album_id.'"';
		$albums = $this->facebook->api(array(
	   'method'       => 'fql.query',
	   'access_token' => $this->facebook->getAccessToken(),
	   'query'        => $fql,
	 ));
	 return $albums;
	}
	public function get_facebook_user_photos_by_places_id($place_id)
	{
		
	}
	public function get_facebook_friends_photo_by_pace_id($place_id)
	{
		
	}
	// this method is used for the get placess
	public function get_facebook_placess()
	{
		$fql = 'SELECT name,description,geometry,latitude,longitude,checkin_count,display_subtext FROM place';
		$places = $this->facebook->api(array(
	   'method'       => 'fql.query',
	   'access_token' => $this->facebook->getAccessToken(),
	   'query'        => $fql,
	 ));
	 return $places;	
	}	

public function get_user_photo_by_user_id($user_id)
{
	
	
	$fql = 'SELECT aid, owner, name, object_id FROM album WHERE owner='.'"'.$user_id.'"';
	$albums = $this->facebook->api(array(
			'method'       => 'fql.query',
			'access_token' => $this->facebook->getAccessToken(),
			'query'        => $fql,
	));
	
	

	$photos = NULL;
	$i=0;
	foreach($albums as $data)
	{
	
	//$fql = 'SELECT pid,src_big,place_id,created,caption FROM photo WHERE aid='.'"'.$data['aid'].'"';
	//$fql = 'SELECT pid,src_big,place_id,created,caption FROM photo WHERE aid='.'"'.$data['aid'].'"';
	 $fql = 'SELECT pid,src_big, src_small,place_id,created,caption FROM photo WHERE aid='.'"'.$data['aid'].'"';
	
	
	$photo = $this->facebook->api(array(
			'method'       => 'fql.query',
			'access_token' => $this->facebook->getAccessToken(),
			'query'        => $fql,
	));
	if(!empty($photo))
	{
		$photos[$i]=$photo;
		
	}	
	$i++;	
	}
	

	
	return $photos;

}
	
public	function location_by_place_id($place_id)
	{
		$fql = 'SELECT name FROM place WHERE page_id='.$place_id;
		$place = $facebook->api(array(
		'method'       => 'fql.query',
		'access_token' => $facebook->getAccessToken(),
		'query'        => $fql,
	));
	return $place;
	}
	
	
	 public function top_friends($user_id)
 {  
 	  $me = $this->get_fb_user();
	// $fql = "SELECT uid, first_name, last_name, email FROM user WHERE uid in (SELECT uid2 FROM friend where uid1 = ".$user_id.")";
	  $fql = 'SELECT uid, first_name,last_name, current_location FROM user WHERE uid in (SELECT uid2 FROM friend WHERE uid1 = '.$me['id'].')';
	 $friends = $this->facebook->api(array(
	   'method'       => 'fql.query',
	   'access_token' => $this->facebook->getAccessToken(),
	   'query'        => $fql,
	 ));
 
	//return $friends;	
	
}

 function getArrayFirstIndex($arr)
    {
	    foreach ($arr as $key => $value)
	    return $key;
    }





public function get_user_photo_by_location($user_id, $location)
{
	
	$photos = array ();
	
	$p =0;
	$all_photos = $this->get_user_photo_by_user_id($user_id);
	
	
	//print_r('<pre>');
	//print_r($all_photos);
	
	
	foreach($all_photos as $key=>$value)
					{
						
						if(!empty($all_photos[$key]))
						 {
							 foreach($all_photos[$key] as $key2=>$value2){
							 
									if($value2['place_id']!='')	{
											$photos[] = array (
											'photo_source'=>$value2['src_big'],
											'location' => $value2['place_id']
										);
									}		
									
						
							 
							 }
						}	 
						
					}	 
	
	/*print_r('<pre>');
	print_r($photos);*/
	
	return $photos;
	
	
}	
public	function get_friends_photo($user_id , $location = NULL)
{
	$friends_photo = array ('photo' => NULL);
	$friends = $this->friends_of_me($user_id);
	foreach($friends as $data)
	{
		$friends_photo['$photo'] = $this->get_user_photo_by_location($user_id, $location);
	}
	
	return $friends_photo;
}

public function update_status($user_id , $staus)
{
	
	//Facebook Wall Update
	$params = array('access_token'=>$this->facebook->getAccessToken(), 'message'=>$status);
	$url = "https://graph.facebook.com/$user_id/feed";
	$ch = curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_URL => $url,
	CURLOPT_POSTFIELDS => $params,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_VERBOSE => true
	));
	$result = curl_exec($ch);
	// End
}


public function get_locations($location_autocomplete)
{
 $access_token = $this->facebook->getAccessToken();
 $url = "https://graph.facebook.com/search?q=$location_autocomplete&type=adcity&access_token=$access_token";
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_VERBOSE => true
));
$result = curl_exec($ch);
if($result!=''){
	$result = json_decode($result,true);
}	
return $result;

// End
}

public function get_friends_associated_with_Object($object_id , $Object_name, $user_id)
{

	//$friends = $this->friends_of_me($user_id);// ab friends ki id database sey get kr k is function ko chalao
	$query = $this->db->get_where('user_friends', array('user_id' => $user_id) /*, $limit, $offset*/);
	$friends = $query->result_array();
	
//	print_r("<pre>");
//	print_r($friends);
	
 	$i = 0;
	foreach ($friends as $data)
	{
		$query_trip_object = $this->db->get_where('trip_objects', array('object_id' => $object_id, 'Object_name' => $Object_name, 'user_id' => $data['friend_id'])/*, $limit, $offset*/);
	
		if($query->num_rows() > 0)
		{
			
			$output =  $query_trip_object->row_array() ;
		//	if(!empty($output)){		
				$friends_array[$i] = $query_trip_object->row_array() ;
		//	}
			$i++;
		}
	}
	
	
	return $friends_array;
}

public function get_friends_by_location($user_id, $location)
{
 	//$location = "Ottawa";
	
	$query = $this->db->query("Select * from user_friends where user_id='$user_id' and  location like '%$location%'");
	//echo $this->db->last_query();
	return $query->result_array();
	
}

public function get_user_by_location($location)
{
 	//$location = "Ottawa";	
	
  $session_get_fb_user_detail = $this->session->userdata('get_fb_user_detail');
  $user_id = $session_get_fb_user_detail['id'];
	
	
	$query = $this->db->query("Select * from users where user_id != '$user_id' and location like '%$location%'");
	//echo $this->db->last_query();
	return $query->result_array();
	
}		

		

public function get_friends_question_count($user_id, $Object_name, $object_id, $object_type)
{

	$return_data = array(
		'number' => array(),
		'friends' => array()
		);
	$friends_array = array();	

	//$friends = $this->friends_of_me($user_id);// ab friends ki id database sey get kr k is function ko chalao
	$query = $this->db->get_where('user_friends', array('user_id' => $user_id) /*, $limit, $offset*/);
	$friends = $query->result_array();
	
//	print_r("<pre>");
//	print_r($friends);
	
 	$i = 0;
	foreach ($friends as $data)
	{
		$query_trip_object = $this->db->get_where('questions', array('object_id' => $object_id, 'Object_name' => $Object_name, 'user_id' => $data['friend_id'],'object_type' => $object_type)/*, $limit, $offset*/);
	
		if($query->num_rows() > 0)
		{
			
			$output =  $query_trip_object->row_array() ;
			//echo "<br/>K";
		//	echo $query_trip_object->num_rows();
			
		//	if(!empty($output)){		
				$result_query = $query_trip_object->row_array() ;
				if(!empty($result_query)){
					$friends_array[] = $result_query ;
				}	
		//	}
			$i++;
		}
		
		
		
	
		//return $return_data;
		
	}
	//die;
		
	
	 $count = sizeof($friends_array);
	
		$return_data = array(
		'number' => $count,
		'friends' => $friends_array,
		);
	
	return $return_data;
	
}


public function get_friends_booking_count($user_id,$object_id)
{

	$return_data = array(
		'number' => array(),
		'friends' => array()
		);
	$friends_array = array();	

	//$friends = $this->friends_of_me($user_id);// ab friends ki id database sey get kr k is function ko chalao
	$query = $this->db->get_where('user_friends', array('user_id' => $user_id) /*, $limit, $offset*/);
	$friends = $query->result_array();
	
//	print_r("<pre>");
//	print_r($friends);
	
 	$i = 0;
	foreach ($friends as $data)
	{
		$query_trip_object = $this->db->get_where('booking', array('flex_trip_id' => $object_id,'user_id' => $data['friend_id'])/*, $limit, $offset*/);
	
		if($query->num_rows() > 0)
		{
			
			$output =  $query_trip_object->row_array() ;
			//echo "<br/>K";
		//	echo $query_trip_object->num_rows();
			
		//	if(!empty($output)){		
				$result_query = $query_trip_object->row_array() ;
				if(!empty($result_query)){
					$friends_array[] = $result_query ;
				}	
		//	}
			$i++;
		}
		
		
		
	
		//return $return_data;
		
	}
	//die;
		
	
	 $count = sizeof($friends_array);
	
		$return_data = array(
		'number' => $count,
		'friends' => $friends_array,
		);
	
	return $return_data;
	
}

function checkuser_like_or_not_tab_page($user_id)
	{
	  $at = $this->facebook->getAccessToken();
	  $url = "https://graph.facebook.com/$user_id/likes/128100537328277?access_token=".$at;
		
		$ch = curl_init($url);
 		curl_setopt($ch,CURLOPT_URL,$url);
 		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 		curl_setopt($ch, CURLPROTO_HTTPS, 1);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 		$data = curl_exec($ch);
		
		if($data!='')
		{
			$json_object = json_decode($data,true);
			
			if(!empty($json_object['data'][0]['id']))
			  {
				
				return $like = 1; 
				
				
			  }else{
				 // echo "not like";
			  }
			
			//print_r("<pre>");
			//print_r($json_object);
		
		}
		
		
		
 		curl_close($ch);
	}

}
?>