<?php declare(strict_types=1);
/**
 * @param string $dir
 * @param string $data
 * @author: jialin
 */
function writeLog(string $data, string $dir = APP_PATH.'/runtime/logs/cmd.log') {
    $tmp = dirname($dir);
    createDir($tmp);
    file_put_contents($dir, $data, FILE_APPEND);
}

function createDir($dir, $mode = 0777) {
    if (is_dir($dir) || @mkdir($dir, $mode)) return true;
    if (!@mkdir(dirname($dir), $mode)) return false;
    return @mkdir($dir, $mode);
}
