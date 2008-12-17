<?php
class SiteCommentView extends BaseSiteView{
	
		function CommentList($info){
			$this -> setTemplate(null, 'comment_list.tpl.php');
			$this -> set($info);
			return $this -> parse();
		}
		
		public function parseCommentText($text){
		    //preg_match("'(.*)(\[quote\s+name=\"(.*?)\"](.*?)\[/quote\])(.*)'si", $text, $items);
		    preg_match("'(.*?)\[quote'si", $text, $items1); // перед первым комментарием
		    preg_match_all("'\[quote\s+name=\"(.*?)\"](.*?)\[/quote\]'si", $text, $items2); // все комментарии
		    preg_match_all("'\[/quote\](.*?)\[quote'si", $text, $items3); // между комментариями
		    preg_match("'.*\[/quote\](.*)'si", $text, $items4); // после последнего комментария
		    
		    $res_text = "";
		    if ($items1){
		        $res_text .= nl2br(htmlspecialchars($items1[1]));
		        $i=1; $key2=0;
		        foreach ($items2[1] as $key=>$item2){
		            if ($i/2 == 1){ // между цитатами
		                $res_text .= nl2br(htmlspecialchars($items3[1][$key2]));
		                $key2++; $i=1;
		            }else $i++;
		            // цитата
		            $res_text .= $this->headQuote($item2);
		            $res_text .= $this->bodyQuote(htmlspecialchars_decode($items2[2][$key]));
		        }
		        if ($items4){
		            $res_text .= nl2br(htmlspecialchars($items4[1]));
		        }
		    }else $res_text = nl2br(htmlspecialchars($text));
		    /*
		    echo "<pre>";
		    print_r($items1);
		    echo "<hr/>";
		    print_r($items2);
		    echo "<hr/>";
		    print_r($items3);
		    echo "<hr/>";
		    print_r($items4);
		    echo "</pre><hr/>";
		    */
		    return $res_text;
		}
		
		function headQuote($text){
		    return '<div class="title_quote">Цитата: '.htmlspecialchars($text).'</div>';
		}
		
		function bodyQuote($text){
		    return '<div class="quote">'.nl2br(htmlspecialchars($text)).'</div>';
		}
}
?>