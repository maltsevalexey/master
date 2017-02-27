<div>
		<p align="center"><?= $text_1; ?></p>
		<p align="center"><?= $text_2; ?></p>
		<table class="table_main">

		<? foreach ($total_cat_news as $v_cat_news) {
			$news_id = $v_cat_news['news_id'];
			$news_name = $v_cat_news['news_name'];
			$news_description = $v_cat_news['news_description'];
			$news = $v_cat_news['news'];
			$news_image = $v_cat_news['news_image'];
			$date_news = $v_cat_news['date_news'];
			$date_news = date("d.m.Y", strtotime($date_news));
			$cat_id = $v_cat_news['category_id'];
			?>
			<tr>
				<td class="main_table_td"><img class="img" src="<?= $news_image; ?>" alt = "фото категории <?= $cat_id ?>"></td>
				<td class="main_table_td_flex">
					<h3><a href="<?= $_SERVER['PHP_SELF'].'?news='.$news_id;?>" ><?= $news_name; ?></a></h3><br>
					<h5><?= $news_description; ?></h5><br>
					<div class="pub_date"><?= $publicated.$date_news; ?></div>
					<? } ?>
				</td>
			</tr>
		</table>
		
		<div class="pagination"><?= $pagctrl; ?></div>
	</div>
