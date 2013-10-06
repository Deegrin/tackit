
<?php

	class Board
	{
		private $id;
		private $user_id;
		private $priv;
		private $title; 
		private $description; 
		private $creation_time;
		
		
		public function __construct()
		{
			
		}
		public function set_id($new_id)
		{
			$this->id=$new_id;
		}
		public function set_user_id($new_user_id)
		{
			$this->user_id=$new_user_id;
		}
		public function set_private($new_private)
		{
			$this->priv=$new_private;
		}
		public function set_title($new_title)
		{
			$this->title=$new_title;
		} 
		public function set_description($new_description)
		{
			$this->description=$new_description;
		} 
		public function set_creation_time($new_creation_time)
		{
			$this->creation_time=$new_creation_time;
		}
		
		public function get_id()
		{
			return $this->id;
		}
		public function get_user_id()
		{
			return $this->user_id;
		}
		public function get_private()
		{
			return $this->priv;
		}
		public function get_title()
		{
			return $this->title; 
		}
		public function get_description()
		{
			return $this->description; 
		}
		public function get_creation_time()
		{
			return $this->creation_time;
		}
	}
	
?>
