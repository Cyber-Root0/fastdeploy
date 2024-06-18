<?php
/*
 * Copyright (c) 2024 Bruno Venancio Alves
 *
 * Author: Bruno Venancio Alves
 * Email: boteistem@gmail.com
 *
 * Permission is granted to use, modify, and distribute this software with
 * acknowledgment of the original author. This notice must not be removed
 * or altered from any source distribution.
 */
namespace FastDeploy\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use FastDeploy\Service\Nginx;

class Deploy extends Command
{
    private Nginx $nginx;
    public function __construct(){
        $this->nginx = new Nginx();
        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setName('deploy')
            ->setDescription('Realiza o deploy com proxy reverso')
            ->addOption('rport', 'r', InputOption::VALUE_REQUIRED, 'Remote port from server.')
            ->addOption('subdomain', 's', InputOption::VALUE_REQUIRED, 'Subdominio da aplicação temporária.'); 
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $rport = $input->getOption('rport');
        $subdomain = $input->getOption('subdomain');
        var_dump($this->nginx->execute($subdomain, $rport));
        return Command::SUCCESS;
    }

}