<?php
/**
 * Paml: PHP array markup language.
 *
 * @author Yuya Takeyama
 */

namespace HTML\Paml;

use HTML\Paml\Parser;
use HTML\Paml\Exception\EvalException;

/**
 * Paml loader.
 *
 * @author Yuya Takeyama
 */
class Loader
{
    /**
     * @var \HTML\Paml\Parser
     */
    protected $_parser;

    /**
     * Directory to put paml files.
     *
     * @var string
     */
    protected $_pamlDir;

    /**
     * Constructor.
     *
     * @param  array $params
     *               - string paml_dir
     */
    public function __construct($params = array())
    {
        $this->_pamlDir = isset($params['paml_dir']) ? $params['paml_dir'] : NULL;
        $this->_parser  = isset($params['parser'])   ? $params['parser']   : new Parser;
    }

    /**
     * Loads specified file into buffer.
     *
     * @param  string $file File to load.
     * @return string       Content of the file.
     */
    public function load($file)
    {
        $file = isset($this->_pamlDir) ?
                "{$this->_pamlDir}/{$file}" :
                $file;
        return file_get_contents($file);
    }

    /**
     * Loads specified file as Paml element.
     *
     * @param  string $file File to load.
     * @return \HTML\Paml\ELement
     */
    public function fetch($file)
    {
        return $this->_parser->parseFromString($this->load($file));
    }
}
