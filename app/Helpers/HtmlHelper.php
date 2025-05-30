<?php

namespace App\Helpers;

class HtmlHelper
{
  public static function cleanJobHtml($html)
  {
    if (empty($html)) {
      return '';
    }

    // Daftar tag yang diizinkan (tambahkan ol dan li)
    $allowedTags = '<p><div><br><ul><ol><li><strong><em><b><i><u><span>';

    // Konversi style alignment ke class Tailwind
    $html = self::convertAlignmentToTailwind($html);

    // Strip tags dan pertahankan yang diizinkan
    $cleanHtml = strip_tags($html, $allowedTags);

    // Perbaiki tag yang tidak tertutup
    $cleanHtml = self::closeTags($cleanHtml);

    return $cleanHtml;
  }


  private static function convertAlignmentToTailwind($html)
  {
    // Konversi style text-align ke class Tailwind
    $html = preg_replace(
      '/style="text-align:\s*(left|right|center|justify);?"/i',
      'class="text-$1"',
      $html
    );

    // Konversi indentasi (margin-left) ke class Tailwind
    $html = preg_replace(
      '/style="margin-left:\s*(\d+)px;?"/i',
      'class="ml-$1"',
      $html
    );

    return $html;
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
