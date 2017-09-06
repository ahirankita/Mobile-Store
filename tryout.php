 //Signup

require 'PasswordHash.php';
			 
			  $hash_cost_log2 = 8;
			  $hash_portable = FALSE;
			  $hasher = new PasswordHash($hash_cost_log2, $hash_portable);
			  $hash = $hasher->HashPassword($password);
			  if (strlen($hash) < 20)
			  {
			  die("failed to hash new password");
			  }
			  unset($hasher);

			  $password = $hash;

//logincheck

$hash_cost_log2 = 8;
$hash_portable = FALSE;
$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
$hash = '*';

if($hasher->CheckPassword($password, $hash))
 {
	 
 		$_SESSION['loggedin'] = 1;
		$_SESSION['username'] = $username;
		$_SESSION['usertype'] = $usertype;
		setcookie('user', $username);
		
 	$rs .= "welcome $username";