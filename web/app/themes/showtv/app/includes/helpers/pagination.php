<?php
/**
 * Pagination with separators
 *
 * @see http://stackoverflow.com/posts/6354523/revisions
 *
 * @param $current_page
 * @param $total_pages
 * @param int $show_separator_if_more_than
 * @param string $separator
 * @param null $walker
 *
 * @return array
 */
function get_pagination_items($current_page, $total_pages, $show_separator_if_more_than = 8, $separator = '...', $walker = null)
{
  $links = array();

  if ($total_pages > $show_separator_if_more_than) {
    // Specifies range of items in the middle
    $min = max($current_page - 2, 2);
    $max = min($current_page + 2, $total_pages - 1);

    // Always show the first number
    $links[] = 1;

    // If more than one space away from the beginning, show the separator
    if ($min > 2) {
      $links[] = $separator;
    }

    // Shows the middle numbers
    for ($i = $min; $i < $max + 1; $i++) {
      $links[] = $i;
    }

    // If more than one space away from the end, show the separator
    if ($max < $total_pages - 1) {
      $links[] = $separator;
    }

    // Always show the last number
    $links[] = $total_pages;
  } else {
    // Shows the numbers
    for ($i = 1; $i <= $total_pages; $i++) {
      $links[] = $i;
    }
  }

  // Apply a walker
  if (is_callable($walker)) {
    array_walk($links, $walker);
  }

  return $links;
}