<?php

	class Series {

		private $id;

		private $title;

		private $url;

		private $image;

		public function getId() {
			return (int)$this->id;
		}

		public function setId($id) {
			$this->id = $id;
		}

		public function getTitle() {
			return $this->title;
		}

		public function setTitle($title) {
			$this->title = $title;
		}

		public function setUrl($url) {
			$this->url = $url;
		}

		public function getUrl() {
			return $this->url;
		}

		public function getImage() {
			return $this->image;
		}

		public function setImage($image) {
			$this->image = $image;
		}

	}