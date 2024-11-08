<?php /** @noinspection UnknownInspectionInspection */

/** @noinspection PhpUnused */

namespace eftec;

use eftec\CliOne\CliOne;
use Exception;
use RuntimeException;

/**
 * Class pdoonecli
 * It is the CLI interface for PdoOne.<br>
 * <b>How to execute it?</b><br>
 * In the command line, runs the next line:<br>
 * ```php
 * php vendor/eftec/PdoOne/lib/pdoonecli
 * or
 * vendor/bin/pdoonecli (Linux/macOS) / vendor/bin/pdoonecli.bat (Windows)
 * ```
 *
 * @see           https://github.com/EFTEC/PdoOne
 * @package       eftec
 * @author        Jorge Castro Castillo
 * @copyright (c) Jorge Castro C. Dual Licence: MIT and Commercial License  https://github.com/EFTEC/PdoOne
 * @version       2.5
 */
class PdoOneCli
{
    public const VERSION = '2.5';
    /** @var CliOne|null */
    public ?CliOne $cli=null;
    //protected $help;
    /** @var ?PdoOneCli the current instance */
    public static ?PdoOneCli $instance=null;

    public static function instance(bool $run = true): PdoOneCli
    {
        if (self::$instance === null) {
            self::$instance = new PdoOneCli($run);
        }
        return self::$instance;
    }
    public function __construct(bool $run = true)
    {
        self::$instance=$this;
        $this->cli = CliOne::instance();
        $this->cli->setErrorType();
        $this->cli->addMenu('mainmenu',
            function($cli) {
                $cli->upLevel('main menu');
                $cli->setColor(['byellow'])->showBread();
            }
            , 'footer');
        $this->cli->addMenuItem('mainmenu', 'connect',
            '[{{connect}}] Configure connection database', 'navigate:pdooneconnect');
        $this->cli->addMenu('pdooneconnect',
            function($cli) {
                $cli->upLevel('connect');
                $cli->setColor(['byellow'])->showBread();
            }
            , 'footer');
        $this->cli->addMenuItems('pdooneconnect', [
            'configure' => ['[{{connect}}] configure and connect to the database', 'connectconfigure'],
            'query' => ['[{{connect}}] run a query', 'connectquery'],
            'load' => ['[{{connect}}] load the configuration', 'connectload'],
            'save' => ['[{{connect}}] save the configuration', 'connectsave']
        ]);
        //$this->cli->addMenuItem('pdooneconnect');
        $this->cli->setVariable('connect', '<red>pending</red>');
        $listPHPFiles = $this->getFiles('.', '.config.php');
        $this->cli->createOrReplaceParam('fileconnect', [], 'longflag')
            ->setRequired(false)
            ->setCurrentAsDefault()
            ->setDescription('select a configuration file to load', 'Select the configuration file to use', [
                    'Example: <dim>"--fileconnect myconfig"</dim>']
                , 'file')
            ->setDefault('')
            ->setInput(false, 'string', $listPHPFiles)
            ->evalParam();
        if ($this->cli->getParameter('fileconnect')->missing === false) {
            $this->doReadConfig();
        }
        if ($run) {
            if ($this->cli->getSTDIN() === null) {
                $this->showLogo();
            }
            $this->cli->evalMenu('mainmenu', $this);
        }
    }

    public function menuFooter(): void
    {
        $this->cli->downLevel();
    }

    public function menuConnectHeader(): void
    {
        $this->cli->upLevel('connect');
        $this->cli->setColor(['byellow'])->showBread();
    }

    /**
     * @return void
     */
    protected function pdoEvalParam(): void
    {
        $this->cli->evalParam('databaseType', true);
        $this->cli->evalParam('server', true);
        $this->cli->evalParam('user', true);
        $this->cli->evalParam('password', true);
        $this->cli->evalParam('database', true);
        $this->cli->evalParam('logFile', true);
        $this->cli->evalParam('logFile', true);
        $this->cli->evalParam('charset', true);
        $this->cli->evalParam('nodeId', true);
        $this->cli->evalParam('tableKV', true);
    }

    /** @noinspection PhpMissingReturnTypeInspection
     * @noinspection PhpUnused
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    protected function runCliConnection($force = false)
    {
        if ($force === false && !$this->cli->getValue('databaseType')) {
            return null;
        }
        if ($force) {
            $this->pdoEvalParam();
        }
        $result = null;
        while (true) {
            try {
                $pdo = $this->createPdoInstance();
                if ($pdo === null) {
                    throw new RuntimeException('trying');
                }
                $this->cli->showCheck('OK', 'green', 'Connected to the database <bold>' . $this->cli->getValue('database') . '</bold>');
                $result = $pdo;
                break;
            } catch (Exception $ex) {
            }
            $rt = $this->cli->createParam('retry')
                ->setDescription('', 'Do you want to retry?')
                ->setInput(true, 'optionshort', ['yes', 'no'])->evalParam(true);
            if ($rt->value === 'no') {
                break;
            }
            $this->pdoEvalParam();
        } // retry database.
        return $result;
    }

    public function menuConnectSave(): void
    {
        $this->cli->upLevel('save');
        $this->cli->setColor(['byellow'])->showBread();
        $sg = $this->cli->createParam('yn', [], 'none')
            ->setDescription('', 'Do you want to save the configurations of connection?')
            ->setInput(true, 'optionshort', ['yes', 'no'])
            ->setDefault('yes')
            ->evalParam(true);
        if ($sg->value === 'yes') {
            $saveconfig = $this->cli->getParameter('fileconnect')->setInput()->evalParam(true);
            if ($saveconfig->value) {
                $arr=$this->pdoGetConfigArray();
                $r = $this->cli->saveDataPHPFormat($this->cli->getValue('fileconnect'), $arr);
                if ($r === '') {
                    $this->cli->showCheck('OK', 'green', 'file saved correctly');
                }
            }
        }
        $this->cli->downLevel();
    }



    public function menuConnectQuery(): void
    {
        $this->cli->upLevel('query');
        $this->cli->setColor(['byellow'])->showBread();
        while (true) {
            $query = $this->cli->createOrReplaceParam('query', [], 'none')
                ->setAddHistory()
                ->setDescription('query', 'query (empty to exit)')
                ->setInput()
                ->setAllowEmpty()
                ->evalParam(true);
            if ($query->value === $this->cli->emptyValue || $query->value === '') {
                break;
            }
            $pdo = $this->createPdoInstance();
            if ($pdo !== null) {
                try {
                    $result = $pdo->runRawQuery($query->value);
                    $this->cli->showLine(json_encode($result, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
                } catch (Exception $e) {
                    $this->cli->showCheck('ERROR', 'red', $e->getMessage());
                }
            } else {
                $this->cli->showCheck('ERROR', 'red', 'not connected');
            }
        }
        $this->cli->downLevel();
    }

    public function menuConnectload(): void
    {
        $this->cli->upLevel('load');
        $this->cli->setColor(['byellow'])->showBread();
        $saveconfig = $this->cli->getParameter('fileconnect')
            ->setInput()
            ->evalParam(true);
        if ($saveconfig->value) {
            $this->doReadConfig();
        }
        $this->cli->downLevel();
    }

    public function menuConnectConfigure(): void
    {
        while (true) {
            $this->cli->upLevel('configure');
            $this->cli->setColor(['byellow'])->showBread();
            $this->cli->createOrReplaceParam('databaseType', 'dt', 'longflag')
                ->setDescription('The type of database', 'Select the type of database', [
                    'Values allowed: <cyan><option/></cyan>'])
                ->setInput(true, 'optionshort', ['mysql', 'sqlsrv', 'oci', 'test'])
                ->setCurrentAsDefault()
                ->evalParam(true);
            $this->cli->createOrReplaceParam('server', 'srv', 'longflag')
                ->setDefault('127.0.0.1')
                ->setCurrentAsDefault()
                ->setDescription('The database server', 'Select the database server', [
                    'Example <dim>mysql: 127.0.0.1 , 127.0.0.1:3306</dim>',
                    'Example <dim>sqlsrv: (local)\sqlexpress 127.0.0.1\sqlexpress</dim>'])
                ->setInput()
                ->evalParam(true);
            $this->cli->createOrReplaceParam('user', 'u', 'longflag')
                ->setDescription('The username to access to the database', 'Select the username',
                    ['Example: <dim>sa, root</dim>'], 'user')
                ->setRequired(false)
                ->setCurrentAsDefault()
                ->setInput()
                ->evalParam(true);
            $this->cli->createOrReplaceParam('pwd', 'p', 'longflag')
                ->setRequired(false)
                ->setDescription('The password to access to the database', '', ['Example: <dim>12345</dim>'], 'pwd')
                ->setCurrentAsDefault()
                ->setInput(true, 'password')
                ->evalParam(true);
            $this->cli->createOrReplaceParam('database', 'db', 'longflag')
                ->setRequired(false)
                ->setDescription('The database/schema', 'Select the database/schema', [
                    'Example: <dim>sakila,contoso,adventureworks</dim>'], 'db')
                ->setCurrentAsDefault()
                ->setInput()
                ->evalParam(true);
            $this->cli->createOrReplaceParam('logFile', [], 'longflag')
                ->setRequired(false)
                ->setDefault('no')
                ->setDescription('Do you want to log into a file?', '', ['Example: <dim>yes</dim>'])
                ->setCurrentAsDefault()
                ->setInput(true, 'optionshort',['yes','no'])
                ->evalParam(true);
            $this->cli->createOrReplaceParam('charset', [], 'longflag')
                ->setRequired(false)
                ->setDefault(null)
                ->setAllowEmpty()
                ->setDescription('Select a charset (or empty for default)', '', ['Example: <dim>utf8mb4</dim>'])
                ->setCurrentAsDefault()
                ->setInput()
                ->evalParam(true);
            $this->cli->createOrReplaceParam('nodeId', [], 'longflag')
                ->setRequired(false)
                ->setDefault(1)
                ->setDescription('Select  the node id used by snowflake, (or empty for default)', '', ['Example: <dim>1</dim>'])
                ->setCurrentAsDefault()
                ->setInput(true,'number')
                ->evalParam(true);
            $this->cli->createOrReplaceParam('tableKV', [], 'longflag')
                ->setRequired(false)
                ->setDefault('')
                ->setAllowEmpty()
                ->setDescription('select the table key-value (or empty for default)', '', ['Example: <dim>table1</dim>'])
                ->setCurrentAsDefault()
                ->setInput()
                ->evalParam(true);
            $this->cli->downLevel();
            try {
                $pdo = $this->createPdoInstance();
                if ($pdo === null) {
                    throw new RuntimeException('trying');
                }
                $this->cli->showCheck('OK', 'green', 'Connected to the database <bold>' . $this->cli->getValue('database') . '</bold>');
                $this->cli->setVariable('connect', '<green>ok</green>');
                //$result = $pdo;
                break;
            } catch (Exception $ex) {
            }
            $rt = $this->cli->createParam('retry')
                ->setDescription('', 'Do you want to retry?')
                ->setInput(true, 'optionshort', ['yes', 'no'])->evalParam(true);
            if ($rt->value === 'no') {
                break;
            }
        }
    }
    public function pdoGetConfigArray():array
    {
        $r= $this->cli->getValueAsArray(
            ['databaseType','server','user','pwd','database','logFile','charset','nodeId','tableKV']);
        $r['logFile']= $r['logFile']==='yes';
        return $r;
    }
    public function pdoSetConfigArray(array $array): void
    {
        $backup=$this->cli->getValue('logFile'); //yes|no
        $this->cli->setParam('logFile',$array['logFile']?'yes':'no',false,true); //true|false
        $this->cli->setParamUsingArray($array,['databaseType','server','user','pwd','database','logFile','charset','nodeId','tableKV']);
        $this->cli->setParam('logFile',$backup);//yes|no
    }

    public function doReadConfig(): void
    {
        $r = $this->cli->readDataPHPFormat($this->cli->getValue('fileconnect'));
        if ($r !== null && $r[0] === true) {
            $this->cli->showCheck('OK', 'green', 'file read correctly');
            $this->cli->setVariable('connect', '<green>ok</green>');
            $this->pdoSetConfigArray($r[1]);
        } else {
            $this->cli->showCheck('ERROR', 'red', 'unable to read file ' . $this->cli->getValue('fileconnect') . ", cause " . $r[1]);
        }
    }

    /** @noinspection PhpMissingReturnTypeInspection
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function createPdoInstance()
    {
        $pdo = null;
        try {
            if ($this->cli->getValue('databaseType') === null
                || $this->cli->getValue('server') === null
                || $this->cli->getValue('user') === null
                || $this->cli->getValue('pwd') === null
                || $this->cli->getValue('database') === null
            ) {
                throw new RuntimeException('No configuration');
            }
            $r=$this->pdoGetConfigArray();
            $r=array_values($r);
            $pdo = new PdoOne(...$r);
            $pdo->logLevel = 1;
            $pdo->connect();
        } catch (Exception $ex) {
            if ($pdo !== null) {
                $this->cli->showCheck('ERROR', 'red', ['Unable to connect to database', $pdo->lastError(), $pdo->errorText]);
            } else {
                $this->cli->showCheck('ERROR', 'red', ['Unable to connect to database', $ex->getMessage()]);
            }
            return null;
        }
        $pdo->logLevel = 2;
        return $pdo;
    }

    public function getCli(): CliOne
    {
        return $this->cli;
    }

    public static function isCli(): bool
    {
        return !http_response_code();
    }

    /***
     * It finds the vendor path (where composer is located).
     * @param string|null $initPath
     * @return string
     *
     */
    public static function findVendorPath(?string $initPath = null): string
    {
        $initPath = $initPath ?: __DIR__;
        $prefix = '';
        $defaultvendor = $initPath;
        // finding vendor
        for ($i = 0; $i < 8; $i++) {
            if (@file_exists("$initPath/{$prefix}vendor/autoload.php")) {
                $defaultvendor = "{$prefix}vendor";
                break;
            }
            $prefix .= '../';
        }
        return $defaultvendor;
    }

    /**
     * It gets a list of files filtered by extension.
     * @param string $path
     * @param string $extension . Example: ".php", "php" (it could generate false positives)
     * @return array
     */
    protected function getFiles(string $path, string $extension): array
    {
        $scanned_directory = array_diff(scandir($path), ['..', '.']);
        $scanned2 = [];
        foreach ($scanned_directory as $k) {
            $fullname = pathinfo($k)['extension'] ?? '';
            if ($this->str_ends_with($fullname, $extension)) {
                $scanned2[$k] = $k;
            }
        }
        return $scanned2;
    }

    /**
     * for PHP <8.0 compatibility
     * @param string $haystack
     * @param string $needle
     * @return bool
     *
     */
    protected function str_ends_with(string $haystack, string $needle): bool
    {
        $needle_len = strlen($needle);
        $haystack_len = strlen($haystack);
        if ($haystack_len < $needle_len) {
            return false;
        }
        return ($needle_len === 0 || 0 === substr_compare($haystack, $needle, -$needle_len));
    }

    protected function showLogo(): void
    {
        $v = PdoOne::VERSION;
        $vc = self::VERSION;
        $this->cli->show("
 _____    _       _____           
|  _  | _| | ___ |     | ___  ___ 
|   __|| . || . ||  |  ||   || -_|
|__|   |___||___||_____||_|_||___|  
PdoOne: $v  Cli: $vc  

<yellow>Syntax:php " . basename(__FILE__) . " <command> <flags></yellow>

");
        $this->cli->showParamSyntax2();
    }

    /**
     * It is used internally to merge two arrays.
     * @noinspection PhpUnused
     */
    protected function updateMultiArray(?array $oldArray, ?array $newArray, string $name): ?array
    {
        if (count($newArray) !== 0) {
            // delete
            foreach ($newArray as $tableName => $columns) {
                if (isset($oldArray[$tableName])) {
                    foreach ($columns as $column => $v) {
                        if (!array_key_exists($column, $oldArray[$tableName])) {
                            $this->cli->showCheck('<bold>deleted</bold>', 'red', "$name: Column <bold>$tableName.$column</bold> deleted");
                            unset($newArray[$tableName][$column]);
                        }
                    }
                } else {
                    $this->cli->showCheck('<bold>deleted</bold>', 'red', "$name: Table <bold>$tableName</bold> delete");
                    unset($newArray[$tableName]);
                }
            }
            // insert
            foreach ($oldArray as $tableName => $columns) {
                if (isset($newArray[$tableName])) {
                    foreach ($columns as $column => $v) {
                        if (!array_key_exists($column, $newArray[$tableName])) {
                            $this->cli->showCheck(' added ', 'green', "$name: Column <bold>$tableName.$column</bold> added");
                            $newArray[$tableName][$column] = $v;
                            //unset($this->tablexclass[$tableName], $this->columnsTable[$tableName], $this->extracolumn[$tableName]);
                        }
                    }
                } else {
                    $this->cli->showCheck(' added ', 'green', "$name: Table <bold>$tableName</bold> added");
                    $newArray[$tableName] = $columns;
                }
            }
        } else {
            $newArray = $oldArray;
        }
        return $newArray;
    }
}
