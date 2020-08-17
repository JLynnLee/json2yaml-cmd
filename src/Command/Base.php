<?php declare(strict_types=1);
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use App\Command\Yaml as YamlCmd;

class Base extends Command {

    public function json2Yaml($data) {
        if (is_string($data)) {
            $data = json_decode($data,true);
        }
        return (Yaml::dump($data));
    }

    public function yaml2Json($data) {
        try {
            return json_encode(Yaml::parse($data), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
            return null;
        }
    }

    public function handleFile($in, $out) {
        $type = 'file';
        if (empty($in)) {
            //管道或重定向是否有数据
            echo "\n程序若无响应请按回车激活程序\n";
            $stdin = fopen('php://stdin', 'r');
            //每次读取 1024 字节
            $buffer = 1024;
            $i = 1;
            //循环读取，直至读取完整个文件
            while(!feof($stdin)) {
                $in .= fread($stdin,$buffer);
                $tmp = str_replace(PHP_EOL, '', $in);
                if (empty($tmp)) {
                    return "<info>没有传入数据</info>";
                }
                $i++;
            }
            fclose($stdin);
            $type = 'stdin';
        }

        if ($in) {
            if ($type == 'file') {
                if (!file_exists($in) && !file_exists("tmp_file/" . $in)) {
                    return "<error>error：文件不存在</error>";
                }

                if (strpos($in, 'tmp_file') !== false) {
                    $data = file_get_contents($in);
                } else {
                    $data = file_get_contents("tmp_file/" . $in);
                }
            } else {
                $data = $in;
            }

            if ($data) {

                $res = null;

                if ($this instanceof Json) {
                    if (strpos($in, 'json') !== false && $type == 'file') {
                        return "<error>error：文件格式不对，请传入yaml文件</error>";
                    }

                    if (isset($out) && strpos($out,'json') === false) {
                        $out .= '.json';
                    }

                    $res = $this->Yaml2Json($data);
                }

                if ($this instanceof YamlCmd) {
                    if (strpos($in, 'yaml') !== false && $type == 'file') {
                        return "<error>error：文件格式不对，请传入json文件</error>";
                    }

                    if (isset($out) && strpos($out,'yaml') === false) {
                        $out .= '.yaml';
                    }
                    $res = $this->Json2Yaml($data);
                }

                if ($out) {
                    if (strpos($out, 'tmp_file/') === false) {
                        $out = 'tmp_file/'.$out;
                    }
                    file_put_contents($out, $res);
                    return "<info>Content：\n{$out}</info>";
                } else {
                    return "<info>Content：\n{$res}</info>";
                }
            } else {
                return "<debug>Notice：\n文件内容为空}</debug>";
            }
        }

        return self::FAILURE;
    }
}

