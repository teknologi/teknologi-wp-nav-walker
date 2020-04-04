<?php
namespace Teknologi_Nav_Walker;

/**
  * nav walker
  */
class Walker_Nav_Menu extends \Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
      $object = $item->object;
      $type = $item->type;
      $title = $item->title;
      $description = $item->description;
      $permalink = $item->url;
      $classes = "";
      if ($item->current && !preg_match('/#/', $permalink)) {
          $classes = "active";
      }

      $output .= "<li class='" . $classes . "'>";

      //Add SPAN if no Permalink
      if( $permalink && $permalink != '#' ) {
          $output .= '<a href="' . $permalink . '">';
      } else {
          $output .= '<span>';
      }

      $output .= $title;

      if( $permalink && $permalink != '#' ) {
          $output .= '</a>';
      } else {
          $output .= '</span>';
      }
    }
  }