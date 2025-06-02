<?php

namespace App\Helpers;

class HtmlHelper
{
  public static function cleanJobHtml($html)
  {
    if (empty($html)) {
      return '';
    }

    // Daftar tag yang diizinkan
    $allowedTags = '<p><div><br><ul><ol><li><strong><em><b><i><u><span><h1><h2><h3><h4><h5><h6>';

    // Konversi style alignment ke class Tailwind
    $html = self::convertAlignmentToTailwind($html);

    // Bersihkan HTML dan pertahankan yang diizinkan
    $cleanHtml = strip_tags($html, $allowedTags);

    // Perbaiki tag yang tidak tertutup
    $cleanHtml = self::closeTags($cleanHtml);

    // Konversi style list ke class Tailwind
    $cleanHtml = self::convertListStyles($cleanHtml);

    return $cleanHtml;
  }

  private static function convertAlignmentToTailwind($html)
  {
    // Konversi style text-align ke class Tailwind
    $patterns = [
      '/style="text-align:\s*(left|right|center|justify);?"/i' => 'class="text-$1"',
      '/style="margin-left:\s*(\d+)px;?"/i' => 'class="ml-$1"',
      '/<p\s+([^>]*)align="(left|right|center|justify)"([^>]*)>/i' => '<p $1class="text-$2"$3>'
    ];

    return preg_replace(array_keys($patterns), array_values($patterns), $html);
  }

  private static function convertListStyles($html)
  {
    // Konversi list-style-type untuk unordered lists
    $html = preg_replace(
      '/<ul\s+([^>]*)style="list-style-type:\s*(disc|circle|square);?"([^>]*)>/i',
      '<ul $1class="list-$2"$3>',
      $html
    );

    // Konversi list-style-type untuk ordered lists
    $html = preg_replace(
      '/<ol\s+([^>]*)style="list-style-type:\s*(decimal|lower-roman|upper-roman|lower-alpha|upper-alpha);?"([^>]*)>/i',
      '<ol $1class="list-$2"$3>',
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
