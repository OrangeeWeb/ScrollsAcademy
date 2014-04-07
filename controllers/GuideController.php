<?php
	class GuideController extends Controller {
	
		public function viewGuideAction($url){
			// set up entity and repository
			$em = $this->getApp()->get("EntityManager");
			$guideRepository = $em->getRepository("Guide");
			
			// look for guide in the repo
			if (($guide = $guideRepository->findOneBy("url", $url)) !== false){

				// For now we just get one guide of each level - TODO use the tags from the guide
				$relatedGuides = array();
				//get the random guides for the relateds
				$relatedGuides[] = $guideRepository->findRandomByCategory("beginner");
				$relatedGuides[] = $guideRepository->findRandomByCategory("intermediate");
				$relatedGuides[] = $guideRepository->findRandomByCategory("master");

				$guide->categories = $guideRepository->findGuideCategories($guide->id);

				return $this->render("guide.html", array(
					"guide" => $guide,
					"relatedGuides" => $relatedGuides
				));
			} else { // guide not found in the repository
				$r = new HtmlResponse();
				$r->setContent("Guide not found");
			}
			
			return $r;
		}
	}