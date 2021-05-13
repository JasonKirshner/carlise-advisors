<section class="pagination" data-module="pagination">
	<?php
	if ($total > 1) :
		echo paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
			'current' => $paged,
			'total' => $total,
			'prev_next' => false,
			// 'prev_text' => get_svg('chevron-left', 'pagination__arrow pagination__arrow--prev'),
			// 'next_text' => get_svg('chevron-right', 'pagination__arrow pagination__arrow--next')
		));
	endif;
	?>
</section>
