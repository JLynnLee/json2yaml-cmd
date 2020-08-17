<?php declare(strict_types=1);
namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Root extends Base {

    public function configure() {
        $this->setName('root');
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("<info>v0.0.1\n转换数据格式小工具</info>\n");
        $output->writeln('Usage:');
        $output->writeln('  conv [flags]');
        $output->writeln("  conv [command]\n");
        $output->writeln('Available Commands:');
        $output->writeln('  help        Help about any command');
        $output->writeln('  json        转json');
        $output->writeln("  yaml        转yaml\n");
        $output->writeln('Flags:');
        $output->writeln(' -h, --help              help for conv');
        $output->writeln(' -I, --in-file string    待转换的文件地址');
        $output->writeln(' -O, --out-file string   转换后的文件地址');
        return self::SUCCESS;
    }
}
