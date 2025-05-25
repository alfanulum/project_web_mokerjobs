<?php

namespace App\Helpers;

class HtmlHelper
{
  public static function cleanJobHtml($html)
  {
    if (empty($html)) {
      return '';
    }

    // Remove all HTML attributes except basic formatting
    $html = preg_replace('/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i', '<$1$2>', $html);

    // Allow only safe, basic formatting tags
    $allowedTags = '<p><br><ul><ol><li><strong><em><b><i><u><div>';

    // Strip tags and properly close HTML
    $cleanHtml = strip_tags($html, $allowedTags);

    // Fix any broken HTML that might remain
    $cleanHtml = self::closeTags($cleanHtml);

    return $cleanHtml;
  }

  private static function closeTags($html)
  {
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedTags = $result[1];

    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedTags = $result[1];

    $lenOpened = count($openedTags);

    if (count($closedTags) == $lenOpened) {
      return $html;
    }

    $openedTags = array_reverse($openedTags);

    for ($i = 0; $i < $lenOpened; $i++) {
      if (!in_array($openedTags[$i], $closedTags)) {
        $html .= '</' . $openedTags[$i] . '>';
      } else {
        unset($closedTags[array_search($openedTags[$i], $closedTags)]);
      }
    }

    return $html;
  }
}
