<?php

/**
 * Prevent a path from going above its starting point 
 * (ie. ./first/path/../example will resolve to ./first/example
 * However ./second/../../../../example will resolve to ./example instead of ./../../../example)
 */
function clean_path($path) {
	$pathSplit = explode('/', $path);

	$pathStack = array();
	foreach ($pathSplit as $pathPart) {
		if ($pathPart == "..") {
			array_pop($pathStack);
		} else {
			array_push($pathStack, $pathPart);
		}
	}

	$pathCleaned = "";
	foreach ($pathStack as $pathPart) {

	}
}

/**
 * Prevents duplicate slashes in paths when appending
 */
function path_append($basePath, $relativePath) {
	return rtrim($basePath, '/') . '/' . trim($relativePath, '/');
}

/**
 * Secure a path to not be allowed in directores above the sandbox base directory.
 * Used to prevent a security breach when a path is built using user input
 * Example:
 * $sandboxBase="/var/www" and $relativePath="./something/../../../etc/shadow"
 * instead of resolving to /etc/shadow, this will resolve to /var/www/etc/shadow
 * which will cause an error instead of a security breach
 */
function sandbox_relative_path($sandboxBase, $relativePath) {
	$relativePathCleaned = clean_path($relativePath);
	return path_append($sandboxBase, $relativePath);
}
