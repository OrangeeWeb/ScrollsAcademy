<?php	
	class Route {
		
		private $id;
		
		private $data;
		
		private $controllerName;
		private $actionName;
		
		public function __construct($id, $data){
			$this->id = $id;
			$this->data = $data;
			
			// we can assume a controller + action is already defined
			// since we have checked for that while compiling the route
			list($this->controllerName, $this->actionName) = explode("::", $this->data['action']);
		}
		
		public function hasKey($key){
			return isset($this->data[$key]);
		}
		
		public function set($key, $d){
			$this->data[$key] = $d;
		}
		
		public function get($key){
			return $this->data[$key];
		}
		
		public function getControllerName(){
			return $this->controllerName . "Controller";
		}
		
		public function getActionName(){
			return $this->actionName . "Action";
		}
		
		public function getParameterNames(){
			$out = array();
			foreach ($this->get("paramMap") as $p){
				$out[] = $p;
			}
			
			return $out;
		}
		
		public function getUrlParameters(){
			// is always set for matching routes, no need to check
			return $this->get("urlMatch");
		}
		
		public function insertParameters(array $params){
			$outPath = $this->get("path");
			
			foreach ($params as $key => $value){
				// check whether this parameter is valid
				$outPath = str_replace(Route::wrapParameter($key), $value, $outPath);
			}
			
			return $outPath;
		}
		
		public function getId(){
			return $this->id;
		}
		
		public static function wrapParameter($str){
			return "{" . $str . "}";
		}
	}