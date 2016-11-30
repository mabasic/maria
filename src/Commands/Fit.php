<?php

namespace Mabasic\Maria\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Mabasic\Maria\Maria;

class Fit extends Command
{
    protected function configure()
    {
        $this
            ->setName('fit')
            ->setDescription('It grabs images from folder and converts them to desired dimensions and thumbnails.')
            ->setHelp("Combine cropping and resizing to format image in a smart way. The method will find the best fitting aspect ratio of your given width and height on the current image automatically, cut it out and resize it to the given dimension.")
            ->addArgument('input', InputArgument::REQUIRED, 'The folder of the images to grab.')
            ->addArgument('output', InputArgument::REQUIRED, 'The folder where to output the images.')
            ->addOption('width', null, InputOption::VALUE_REQUIRED, 'Desired width of the images.')
            ->addOption('height', null, InputOption::VALUE_REQUIRED, 'Desired height of the images.')
            ->addOption('prefix', null, InputOption::VALUE_REQUIRED, 'Add prefix thumb_ to images');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input_directory = $input->getArgument('input');
        $output_directory = $input->getArgument('output');
        $prefix = $input->getOption('prefix');
        $width = $input->getOption('width');
        $height = $input->getOption('height');

        $maria = new Maria($input_directory, $output_directory);

        if(!is_null($prefix)) $maria->addPrefix($prefix);

        $maria->fit($width, $height);

        $output->writeln("Finished!");

    }
}
