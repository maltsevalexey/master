
		<main class="main">
		<p align="center"><?= $text_1; ?></p>
		<p align="center"><?= $text_2; ?></p>
		<table class="table_main">

		<? foreach ($total_home as $v_home) {
			$news_id = $v_home['news_id'];
			$news_name = $v_home['news_name'];
			$news_description = $v_home['news_description'];
			$news = $v_home['news'];
			$news_image = $v_home['news_image'];
			$date_news = $v_home['date_news'];
			$cat_id = $v_home['category_id'];
			$date_news = date("d.m.Y", strtotime($date_news));
			?>
			<tr>
				<td class="main_table_td"><a href="<?= $_SERVER['PHP_SELF']; ?>?news=<?= $news_id; ?>" >
					<img class="img" src="<?= $news_image; ?>" alt = "фото категории <?= $cat_id ?> "></td></a>
				<td class="main_table_td_flex">

					<h3><a href="<?= $_SERVER['PHP_SELF']; ?>?news=<?= $news_id; ?>" ><?= $news_name; ?></a>
						</h3>
					<h5><?= $news_description; ?></h5>
					<div class="pub_date"><?= $publicated.$date_news; ?></div>
					</div>
					<? }; ?>
                </td>
			</tr>
		</table>
		
		<div class="pagination"><?= $pagctrl; ?></div>
		</main>













