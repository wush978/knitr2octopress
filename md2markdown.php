<?php

$src = $argv[1];

if (!file_exists( $src )) {
	echo "$src does not exist\n";
	exit(1);
}

$md = file_get_contents( $src );

$subpattern1 = '(?P<id>.*)';
$subpattern2 = '(?P<filename>figure/.*.png)';

$pattern = '$^!\[' . $subpattern1 . '\]\(' . $subpattern2 . '\)$Um';

preg_match_all($pattern, $md, $matches);

for ($i = 0;$i < count($matches[0]);$i++) {
	$search = $matches[0][$i];
	$file_name = $matches['filename'][$i];
	$id = $matches['id'][$i];
	$base64 = base64_encode(file_get_contents(__DIR__ . '/' . $file_name));
	$replacement = "<img id=\"$id\" src=\"data:image/png;base64,$base64\" />";
	$md = str_replace($search, $replacement, $md);
}
$dst = str_replace('.md', '.markdown', $src);
file_put_contents( $dst, $md );
