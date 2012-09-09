<?php

namespace Liip\RD\Tests\Functional;


class RDFunctionalTestBase extends \PHPUnit_Framework_TestCase
{
    protected $tempDir;

    protected function setUp() {

        // Create a temp folder
        $this->tempDir = tempnam(sys_get_temp_dir(),'');
        if (file_exists($this->tempDir)) {
            unlink($this->tempDir);
        }
        mkdir($this->tempDir);
        chdir($this->tempDir);

        // Create the executable task inside
        $rdDir = realpath(__DIR__.'/../../../../');
        file_put_contents('RD', <<<EOF
#!/usr/bin/env php
<?php define('RD_CONFIG_DIR', __DIR__); ?>
<?php require '$rdDir/command.php'; ?>
EOF
        );
        exec('chmod +x RD');
    }

    protected function setJsonConfig($config) {
        file_put_contents('rd.json', $config);
    }

    protected function tearDown()
    {
        exec('rm -rf '.$this->tempDir);
    }

}
