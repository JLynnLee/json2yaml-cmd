<?php declare(strict_types=1);
namespace App\Command;

use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Json数据转Yaml
 * @author: jialin
 * @Date: 2020/8/13
 * @Time: 14:17
 */
class Yaml extends Base {

    public function configure() {
        $this->setName('yaml')
        ->setDescription('Json to yaml')
        ->setHelp("Json数据转换为Yaml数据")
        ->setDefinition(
            new InputDefinition(array(
                new InputOption('in-file','I',InputOption::VALUE_REQUIRED,'待转换的文件地址'),
                new InputOption('out-file','O',InputOption::VALUE_REQUIRED,'转换后的文件地址'),
            ))
        );
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        //文件名或路径
        $in = $input->getOption('in-file');
        //文件名
        $out = $input->getOption('out-file');

        $res = $this->handleFile($in, $out);
        if ($res != 1) {
            $output->writeln($res);
        }

        return self::SUCCESS;
    }
}
