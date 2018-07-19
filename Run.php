<?php

require("Dijkstra.php");

function run() {
	$g = new Graph();

	$g->addedge("a","b",3);

	$g->addedge("b","a",3);
	$g->addedge("b","c",2);
	$g->addedge("b","d",1);

	$g->addedge("c","b",2);

	$g->addedge("d","b",1);	
	$g->addedge("d","e",3);
	$g->addedge("d","f",1);

	$g->addedge("e","l",3);

	$g->addedge("f","i",2);
	$g->addedge("f","g",1);

	$g->addedge("i","j",1);
	$g->addedge("j","i",1);

	$g->addedge("g","k",2);
	$g->addedge("g","n",2);

	$g->addedge("l","k",1);
	
	$g->addedge("k","g",2);
	$g->addedge("k","m",1);

	$g->addedge("m","o",4);
	$g->addedge("n","o",1);
	
	$g->addedge("o","m",4);
	$g->addedge("o","n",1);
	

	list($distances, $prev) = $g->paths_from("a");
	
	$path = $g->paths_to($prev, "o");
	
	print_r($path);
	
}


run();

