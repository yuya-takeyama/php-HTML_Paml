<?php
namespace HTML\Paml;

use HTML\Paml\Loader;

require_once 'vfsStream/vfsStream.php';

/**
 * Test class for HTML\Paml\Loader.
 */
class LoaderTest extends \PHPUnit_Framework_TestCase
{
    const VFS_ROOT_DIR = 'root';
    const PAML_FILE    = 'test.paml';

    /**
     * @var \HTML\Paml\Loader
     */
    protected $loader;

    public function setUp()
    {
        \vfsStream::setup(self::VFS_ROOT_DIR);
        $this->loader = new Loader(array(
            'paml_dir' => \vfsStream::url(self::VFS_ROOT_DIR),
        ));
    }

    /**
     * @test
     */
    public function fetch_should_return_Paml_element_object()
    {
        $this->createFile('["div", "Foo"]');
        $this->assertSame(
            '<div>Foo</div>',
            $this->loader->fetch(self::PAML_FILE)->toString()
        );
    }

    /**
     * @test
     * @expectedException \HTML\Paml\Exception\EvalException
     */
    public function fetch_should_throw_EvalException_if_the_paml_file_is_broken()
    {
        $this->createFile('[');
        $this->loader->fetch(self::PAML_FILE);
    }

    /**
     * Creates file has specified content.
     *
     * @param  string $content Created file's content.
     * @return void
     */
    protected function createFile($content)
    {
        $fp = fopen(\vfsStream::url(self::VFS_ROOT_DIR) . '/' . self::PAML_FILE, 'w');
        fputs($fp, $content);
        fclose($fp);
    }
}
