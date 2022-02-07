<?php

namespace App\Command;

use \Redis;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CachePurgeCommand extends Command
{
    protected static $defaultName = 'app:cache:purge';

    protected const CACHE_KEYS_PREFIX = [
        'hp' => [
            'id' => 'symfony:homepage:about',
            'name' => 'Homepage about section'
        ],
    ];

    private $redis, $parameterBag;

    public function __construct(Redis $redis, ParameterBagInterface $parameterBag)
    {
        parent::__construct();
        $this->redis = $redis;
        $this->parameterBag = $parameterBag;
    }

    protected function configure(): void
    {
        $this->setName('Purge redis cache')
            ->setDescription('Purging the redis cache contents by using key arguments.')
            ->addArgument(
                'redis-key',
                InputOption::VALUE_REQUIRED,
                'The cache key to purge ['.
                implode('|', array_keys(static::CACHE_KEYS_PREFIX)).'].'
            )
            ->addOption(
                'yes',
                'y',
                InputOption::VALUE_NONE,
                'Yes option for non-interactive purging of the redis contents'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getArgument('redis-key')) {
            if (isset(self::CACHE_KEYS_PREFIX[$input->getArgument('redis-key')])) {
                $value = self::CACHE_KEYS_PREFIX[$input->getArgument('redis-key')];
                $activateNonInteractiveOption = $input->getOption('yes');

                if (!$activateNonInteractiveOption) {
                    $helper = $this->getHelper('question');
                    $question = new ConfirmationQuestion('Purging '.$value['name'].
                        ' Continue with this action ? (y/n) :', true);
                    $activateNonInteractiveOption = $helper->ask($input, $output, $question);
                }

                if ($activateNonInteractiveOption) {
                        $redisKey = $value['id'];

                        $db = $this->parameterBag->get('database')['db1'];
                        $this->redis->select($db);

                        if ($this->redis->get($redisKey)) {
                            $this->redis->del($redisKey);
                            $output->writeln('<info>Redis cache `'.$redisKey.'` purged successfully :)</info>');
                        } else {
                            $output->writeln('<error>Redis cache `'.$redisKey.'` unavailable</error>');
                        }


                    return Command::SUCCESS;
                }

                $output->writeln('<error>Purging '.$value['name'].' Aborted !</error>');

                return Command::FAILURE;
            }
            $output->writeln('<error>This argument does not exist ! Please choose from ['.
                implode('|', array_keys(static::CACHE_KEYS_PREFIX)).']</error>');

            return Command::FAILURE;
        }
        $output->writeln('<error>Argument \'redis-key\' is missing. Please choose from ['.
            implode('|', array_keys(static::CACHE_KEYS_PREFIX)).']</error>');

        return Command::FAILURE;
    }
}
