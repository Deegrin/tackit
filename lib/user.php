	
<?php

	class User
	{
		private $id;
		private $active;
		private $first_name;
		private $last_name;
		private $email;
		private $username;
		private $password;
		private $password_salt;
		private $creation_time;
		
		public function __construct()
		{
			
		}
		public function set_id($new_id)
		{
			$this->id=$new_id;				
		}
		public function set_active($new_active)
		{
			$this->active=$new_active;
		}
		public function set_first_name($new_first_name)
		{
			$this->first_name=$new_first_name;
		}
		public function set_last_name($new_last_name)
		{
			$this->last_name=$new_last_name;
		}
		public function set_email($new_email)
		{
			$this->email=$new_email;
		}
		public function set_username($new_username)
		{
			$this->username=$new_username;
		}
		public function set_password($new_password)
		{
			$this->password=$new_password;
		}
		public function set_password_salt($new_password_salt)
		{
			$this->password_salt=$new_password_salt;
		}
		public function set_creation_time($new_creation_time)
		{
			$this->creation_time=$new_creation_time;
		}
		
		public function get_id()
		{
			return $this->id;
		}
		public function get_active()
		{
			return $this->active;
		}
		public function get_first_name()
		{
			return $this->first_name;
		}
		public function get_last_name()
		{
			return $this->last_name;
		}
		public function get_email()
		{
			return $this->email;
		}
		public function get_username()
		{
			return $this->username;
		}
		public function get_password()
		{
			return $this->password;
		}
		public function get_password_salt()
		{
			return $this->password_salt;
		}
		public function get_creation_time()
		{
			return $this->creation_time;
		}
	}
	
?>
