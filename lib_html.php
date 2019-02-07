<?php

/* Generacja znaczników P, Span i TD */
  
function P( $html='', $class='', $id='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	$ident = ( $id == '' ) ? '' : " id=\"$id\" name=\"$id\"";
	return "<p$cl$ident>".$html."</p>";
}
function Span( $html='', $class='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	return "<span$cl>".$html.'</span>';
}

function TD( $html='', $class='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	return "<td$cl>".$html.'</td>';
}
