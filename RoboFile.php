<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */

define('DS', DIRECTORY_SEPARATOR);
class RoboFile extends \Robo\Tasks
{

    //Edited content of .env file
    private $env = [
        'datas' => [
            'tags'   => [],
            'values' => [],
        ]
    ];

    private $mail = [
        'datas' => [
            'tags'   => [],
            'values' => [],
        ]
    ];

    // Project path
    private $project_path;

    // Robo directory name
    private $robo_dir = '.robo' . DS;

    // define public methods as commands
    public function configure()
    {
        $this->getLocals();

        $this->getMemoryDriver();
        switch($this->driver) {
            case 'redis' :
                $this->getRedisConfig();
                break;
        }

        $this->getSessionConfig();
        $this->getMysqlConfig();
        $this->getMailConfig();

        $this->applyConfig();
    }

    private function getLocals()
    {
        $this->io()->title('Configuration de l\'environnement');
        // App Name
        $this->env['datas']['tags'][] = '##APP_NAME##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est le nom de l\'application ? ', 'Chopin');

        // Debug mode
        $this->env['datas']['tags'][] = '##APP_DEBUG##';
        $debug = $this->io()->confirm('Activer le mode debug ?', true);
        $this->env['datas']['values'][] = $debug ? 'true' : 'false';


        // Log level
        $this->env['datas']['tags'][] = '##APP_LOG_LEVEL##';
        $debug = $this->io()->choice('Choisissez le niveau de log. ',
        [
            'debug',
            'info',
            'notice',
            'warning',
            'error',
            'critical',
            'alert',
            'emergency'
        ], 'debug');

        $this->env['datas']['values'][] = $debug ? 'true' : 'false';

        // Env
        $this->env['datas']['tags'][] = '##APP_URL##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est l\'URL du site ?');

        // Env
        $this->env['datas']['tags'][] = '##APP_ENV##';
        $this->env['datas']['values'][] = $this->io()->choice('L\'environnement ?', ['local', 'staging'], 'local');


        $this->project_path = $this->io()->ask('Quel est la racine du projet ?', __DIR__ . DS);
        $this->robo_path = $this->project_path . $this->robo_dir;

        $this->env['input']  = $this->robo_path . '.env';
        $this->env['output'] = $this->project_path . '.env';
        $this->mail['input'] = $this->robo_path . 'config' . DS . 'mail.php';
        $this->mail['output'] = $this->project_path . 'config' . DS . 'mail.php';

    }

    private function getMysqlConfig()
    {
        $this->io()->title('Configuration de la base donnée MySQL');

        // DB Host
        $this->env['datas']['tags'][] = '##DB_HOST##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est l\'hôte ?', '127.0.0.1');

        // DB Port
        $this->env['datas']['tags'][] = '##DB_PORT##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est le port ?', '3306');

        // DB Name
        $this->env['datas']['tags'][] = '##DB_DATABASE##';
        $this->db_name = $this->env['datas']['values'][] = $this->io()->ask('Quel est le nom de la base a utiliser ?', 'chopin');

        // DB User
        $this->env['datas']['tags'][] = '##DB_USERNAME##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est le nom de l\'utilisateur de la base ?', $this->db_name);

        // DB Password
        $this->env['datas']['tags'][] = '##DB_PASSWORD##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est le mot de passe pour cet utilisateur ?', 'null');


    }

    private function getMemoryDriver()
    {
        $this->driver = $this->io()->choice('Quel driver souhaitez vous utiliser pour le cache et les sessions ?',
        [
            'redis',
            'apc',
            'array',
            'database',
            'file',
            'memcached',
            'redis'
        ], 'redis');

        // Session Driver
        $this->env['datas']['tags'][] = '##SESSION_DRIVER##';
        $this->env['datas']['values'][] = $this->driver;

        // Cache Driver
        $this->env['datas']['tags'][] = '##CACHE_DRIVER##';
        $this->env['datas']['values'][] = $this->driver;
    }

    private function getSessionConfig()
    {
        $this->io()->title('Configuration des parametres de session');

        // Session Lifetime
        $this->env['datas']['tags'][] = '##SESSION_LIFETIME##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est la durée de vie d\'une session (min) ?', '120');

    }

    private function getRedisConfig()
    {
        $this->io()->title('Configuration de redis');

        // Redis Host
        $this->env['datas']['tags'][] = '##REDIS_HOST##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est l\'hôte ?', '127.0.0.1');

        // Redis password
        $this->env['datas']['tags'][] = '##REDIS_PASSWORD##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est le mot de passe ?', 'null');

        // Redis Port
        $this->env['datas']['tags'][] = '##REDIS_PORT##';
        $this->env['datas']['values'][] = $this->io()->ask('Quel est le port utilisé ?', '6379');
    }

    private function getMailConfig()
    {
        $this->io()->title('Configuration des emails');

        $this->io()->note('
Le comportement "smtp" enverra les emails aux destinataires.
Le comportement "log" écrira les mails dans vos logs

Si vous choisissez "smtp", il sera possible de choisir une adresse d\'interception');

        $driver = $this->io()->choice('Définissez le comprtement de vos email', ['smtp', 'log'], 'smtp');
        // Redis password
        $this->env['datas']['tags'][] = '##MAIL_DRIVER##';
        $this->env['datas']['values'][] = $driver;

        if ($driver == 'smtp') {

            $this->io()->note('Laisser à null pour ne pas intercepter les mails');
            $this->interception = $this->io->ask('Définissez une adresse d\'interception.', 'null');

            if ($this->interception !== 'null') {
                $this->mail['input'] = $this->robo_path . 'config' . DS . 'mail_intercept.php';
                // Intercept mail @
                $this->mail['datas']['tags'][] = '##INTERCEPTION_MAIL##';
                $this->mail['datas']['values'][] = $this->interception;

                // Dest name
                $this->mail['datas']['tags'][] = '##DEST_NAME##';
                $this->mail['datas']['values'][] = $this->io()->ask('Nom du destinataire ? ', 'Fiora Laurent');

                // Mail Host
                $this->env['datas']['tags'][] = '##MAIL_HOST##';
                $this->env['datas']['values'][] = $this->io()->ask('Serveur SMTP ', 'smtp-mail.outlook.com');


                // Mail ¨Port
                $this->env['datas']['tags'][] = '##MAIL_PORT##';
                $this->env['datas']['values'][] = $this->io()->ask('Port SMTP ', '587');

                // Mail username
                $this->env['datas']['tags'][] = '##MAIL_USERNAME##';
                $this->env['datas']['values'][] = $this->io()->ask('Nom d\'utilisateur SMTP', 'null');

                // Mail Password
                $this->env['datas']['tags'][] = '##MAIL_PASSWORD##';
                $this->env['datas']['values'][] = $this->io()->ask('Mot de passe', 'null');

                // Mail encryption
                $this->env['datas']['tags'][] = '##MAIL_ENCRYPTION##';
                $this->env['datas']['values'][] = $this->io()->ask('Méthode de chiffrement', 'tls');
            }
        }


    }

    protected function buildFile($input, $output, $datas)
    {
        $copy = true;
        if (file_exists($output)) {
            $remove = $this->io()->confirm('Le fichier ' . $output . ' existe déjà. Souhaitez-vous le remplacer ?', true);

            if ($remove) {
                unlink($output);
            } else {
                $message = 'Le fichier ' . $output . ' n\'a pas été remplacé';
                $this->io()->note($message);
                $this->end_messages[] = $message;
                return false;
            }
        }

        $this->_copy($input, $output);
        $this->taskReplaceInFile($output)
        ->from($datas['tags'])
        ->to($datas['values'])
        ->run();

        return true;
    }

    protected function applyConfig()
    {
        $configs = [$this->env, $this->mail];

        foreach ($configs as $config) {
            $this->buildFile($config['input'], $config['output'], $config['datas']);
        }

    }

}