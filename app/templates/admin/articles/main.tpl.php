<?php include($this -> _include('../header.tpl.php')); ?>
<?

	if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_START) {
		echo "Понедельник 00.00 - Среда 18.00";
	}
	if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_VOTE) {
		echo "Среда 18.00 - Пятница 18.00";
	}
	if(ARTICLE_COMPETITION_STATUS::getCompetitionStage() == ARTICLE_COMPETITION_STATUS::COMPETITION_FINAL) {
		echo "Пятница 18.00 - Воскресенье 00.00";
	}

?>
<div class="list" id="list_block">
	<?php include($this -> _include('article_list.tpl.php')); ?>
</div>
<?php include($this -> _include('../footer.tpl.php')); ?>