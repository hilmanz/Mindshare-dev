<?php
/** MODEL DATA 
 ** @cendekiApp
 **/
global $ENGINE_PATH;
include_once APP_PATH."Dashboard/helper/countryNameHelper.php";

class SocialModel extends SQLData{
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
		$this->countryID = new countryNameHelper();
	}
	
	function getProjectDetail($id){
		$this->open(0);
		$c=	"SELECT *
			FROM tbl_project k
			WHERE k.id = '9';";
		$f=	$this->fetch($c);
		$this->close();
		return $f;
	}
	
	function getFBPageDetails($id){
		$this->open(0);
		$c=	"SELECT *
			FROM fb_page_name
			WHERE proID = '9'";
		$f=	$this->fetch($c);
		$this->close();
		return $f;
	}
	function getFBVolume($id){
		$this->open(0);
		$c= "SELECT c.day AS tgl,c.fans AS likefan,k.value AS story, b.value AS post, k.day
			FROM fb_page_fans c 
			LEFT JOIN fb_page_stories_day k ON k.proID = c.proID AND k.day = c.day
			LEFT JOIN fb_page_posts_impressions_day b ON b.proID = c.proID AND b.day = c.day
			WHERE c.proID = '".$id."'
			AND c.day >= DATE_SUB('2012-05-14', INTERVAL 6 DAY)
			GROUP BY tgl";
		$f = $this->fetch($c,1);
		$this->close();
		// var_dump($f);exit;
		return $f;
	}
	
	function getFBTotalVolume($id){
		$this->open(0);
		$c= "SELECT SUM(c.fans) AS likefan, SUM(k.value) AS story, SUM(b.value) AS post
			FROM fb_page_fans c 
			LEFT JOIN fb_page_stories_day k ON k.proID = c.proID AND k.day = c.day
			LEFT JOIN fb_page_posts_impressions_day b ON b.proID = c.proID AND b.day = c.day
			WHERE c.proID = '".$id."'";
		$f = $this->fetch($c);
		$this->close();
		// var_dump($f);exit;
		return $f;
	}
	
	function getFBVisit($id){
		$this->open(0);
		$c= "SELECT c.day AS tgl, c.value AS visitAll, k.value AS visitUnique
			FROM fb_page_views_day c
			LEFT JOIN fb_page_views_day k
			ON k.proID = c.proID
			WHERE c.proID = '".$id."'
			AND c.day >= DATE_SUB('2012-05-14', INTERVAL 6 DAY)
			GROUP BY tgl";
		$f = $this->fetch($c,1);
		$this->close();
		// var_dump($f);exit;
		return $f;
	}
	
	function getFBReach($id){
		$this->open(0);
		$c= "SELECT c.day AS tgl, c.value AS organic, k.value AS paid, b.value AS viral  
			FROM fb_page_impressions_organic_unique_day c
			LEFT JOIN fb_page_impressions_paid_unique_day k
			ON k.proID = c.proID AND k.day = c.day
			LEFT JOIN fb_page_impressions_viral_unique_day b
			ON b.proID = c.proID AND b.day = c.day
			WHERE c.proID = '".$id."'
			AND c.day >= DATE_SUB('2012-05-14', INTERVAL 6 DAY)
			GROUP BY tgl";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getFBReachTotal($id){
		$this->open(0);
		$c= "SELECT SUM(c.value) AS organic, SUM(k.value) AS paid, SUM(b.value) AS viral  
			FROM fb_page_impressions_organic_unique_day c
			LEFT JOIN fb_page_impressions_paid_unique_day k
			ON k.proID = c.proID AND k.day = c.day
			LEFT JOIN fb_page_impressions_viral_unique_day b
			ON b.proID = c.proID AND b.day = c.day
			WHERE c.proID = '".$id."'";
		$f = $this->fetch($c);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getFBDemography($id){
		$this->open(0);
		$c= "SELECT c.demografi AS age, SUM(c.value) AS nilai
			FROM fb_page_fans_gender_age c
			WHERE c.proID = '".$id."'
			AND c.day >= DATE_SUB('2012-05-14', INTERVAL 6 DAY)
			GROUP BY age";
		$f = $this->fetch($c,1);
		$this->close();
		// var_dump($f);exit;
		return $f;
	}
	
	function getFBLocation($id){
		$this->open(0);
		$c= "SELECT c.region AS country, SUM(c.value) AS nilai
			FROM fb_page_fans_country c
			WHERE c.proID = '".$id."'
			AND c.day >= DATE_SUB('2012-05-14', INTERVAL 6 DAY)
			GROUP BY c.region
			ORDER BY nilai DESC LIMIT 10";
		$f = $this->fetch($c,1);
		$this->close();
		
		foreach ($f as $loc){
			// $place = explode(",", $loc['city']);
			// $city[] = $place[0];
			$location[] = $this->countryID->countryName($loc['country']);
			$value[] = intval($loc['nilai']);
		}
		$locPart = array(
					"location" => $location,
					"value" => $value
					);
		 // var_dump($locPart);exit;
		return $locPart;
	}
	
	function getFBPost($id){
		$this->open(0);
		$c= "SELECT *
			FROM fb_post_impressions_unique
			WHERE proID = '9';";
		$f = $this->fetch($c,1);
		$this->close();
		// var_dump($f);exit;
		return $f;
	}
	
	function getFBCity($id){
		$this->open(0);
		$c= "SELECT c.region AS city, SUM(c.value) AS nilai
			FROM fb_page_fans_city c
			WHERE c.proID = '".$id."'
			AND c.day >= DATE_SUB('2012-05-14', INTERVAL 6 DAY)
			GROUP BY c.region
			ORDER BY nilai DESC LIMIT 10";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWVolume($id){
		$this->open(0);
		$c= "SELECT c.published_date AS tgl, c.mentions AS mention, c.people AS person, c.rt AS retwit
			FROM campaign_daily_summary c
			WHERE c.campaign_id = '16'
			AND c.published_date >= DATE_SUB('2011-10-03', INTERVAL 6 DAY)";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWVolumeTotal($id){
		$this->open(0);
		$c= "SELECT SUM(c.mentions) AS mention, SUM(c.people) AS person, SUM(c.rt) AS retwit
			FROM campaign_daily_summary c
			WHERE c.campaign_id = '16'";
		$f = $this->fetch($c);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWFollower($id){
		$this->open(0);
		$c= "SELECT c.published_date AS tgl, c.author_id AS author, c.followers AS jml
			FROM account_followers c
			WHERE c.campaign_id = '16'
			AND c.published_date >= DATE_SUB('2011-09-24', INTERVAL 6 DAY)";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWSentiment($id){
		$this->open(0);
		$c= "SELECT SUM(c.positive) AS plus, SUM(c.negative) AS minus, SUM(c.neutral) AS normal
			FROM campaign_sentiment_summary c
			WHERE c.campaign_id = '16'
			AND c.published_date >= DATE_SUB('2011-10-03', INTERVAL 6 DAY)";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWSentimentTotal($id){
		$this->open(0);
		$c= "SELECT SUM(c.positive) AS plus, SUM(c.negative) AS minus, SUM(c.neutral) AS normal
			FROM campaign_sentiment_summary c
			WHERE c.campaign_id = '16'";
		$f = $this->fetch($c);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWCountPeople($id){
		$this->open(0);
		$c= "SELECT COUNT(author_id) AS unik
			FROM people
			WHERE campaign_id = '16'";
		$f = $this->fetch($c);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWSentimentDaily($id){
		$this->open(0);
		$c= "SELECT c.published_date AS tgl, c.positive AS plus, c.negative AS minus, c.neutral AS normal
			FROM campaign_sentiment_summary c
			WHERE c.campaign_id = '16'";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWWordcloud($id){
		$this->open(0);
		$c= "SELECT keyword, total, sentiment
			FROM top_keywords
			WHERE campaign_id = '16'
			GROUP BY keyword
			ORDER BY total DESC
			LIMIT 50";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWKeyword($id){
		$this->open(0);
		$c= "SELECT keyword, total, sentiment
			FROM top_keywords
			WHERE campaign_id = '16'
			GROUP BY keyword
			ORDER BY total DESC
			LIMIT 10";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	function getTWConversations($id){
		$this->open(0);
		$c= "SELECT *
			FROM top_conversations
			WHERE campaign_id = '16'
			ORDER BY followers DESC
			LIMIT 10";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	function getTWCountries($id){
		$this->open(0);
		$c= "SELECT *
			FROM top_countries
			WHERE campaign_id = '16'
			ORDER BY mentions DESC
			LIMIT 10";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWKOL($id, $sentiment){
		$this->open(0);
		$c= "SELECT campaign_id, author_id, author_avatar, total, sentiment_type
			FROM kols
			WHERE campaign_id = '16'
			AND sentiment_type = '".$sentiment."'";
		$f = $this->fetch($c,1);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	
	function getTWProfileDetails($id, $author){
		$this->open(0);
		$c= "SELECT author_id, author_name, author_avatar, followers, impression, rt_impression, total_mentions, rt_mention, coordinate_x, coordinate_y
			FROM people
			WHERE campaign_id = '16'
			AND author_id = '".$author."'";
		$f = $this->fetch($c);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	function getTotalImpression($id){
		$this->open(0);
		$c= "SELECT SUM(impression) AS total
			FROM people
			WHERE campaign_id = '16'";
		$f = $this->fetch($c);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	function getTWPeopleRank($id, $author){
		$this->open(0);
		$c= "SELECT rank
			FROM people_rank
			WHERE campaign_id = '16'
			AND author_id = '".$author."'";
		$f = $this->fetch($c);
		$this->close();
		 // var_dump($f);exit;
		return $f;
	}
	function getChannels($id){
		$this->open(0);
		$c=	"SELECT twitter, facebook, blog
			FROM source_count
			WHERE campaign_id = '16'";
		$f=	$this->fetch($c);
		$this->close();
		return $f;
	}
	function getTWTopCountries($id){
		$this->open(0);
		$c=	"SELECT country_name, mentions
			FROM top_countries
			WHERE campaign_id = '16'";
		$f=	$this->fetch($c,1);
		$this->close();
		return $f;
	}
	
	function getTWTotalImpression($id){
		$this->open(0);
		$c=	"SELECT SUM(impression) AS impresi, SUM(rt_impression) AS rt
			FROM people
			WHERE campaign_id = '16'";
		$f=	$this->fetch($c);
		$this->close();
		return $f;
	}
}