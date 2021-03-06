<?php

namespace Kohana\CascadingFilesystem\Autoloader;

/**
 * Provides autoloading support for Kohana module classes.
 */
class ModulesAutoloader extends AbstractModulesAutoloader
{
    public function autoload($class_name)
    {
        // Transform the class name according to PSR-0
        $class_name     = ltrim($class_name, '\\');
        $file      = '';
        $namespace = '';

        if ($last_namespace_position = strripos($class_name, '\\')) {
            $namespace = substr($class_name, 0, $last_namespace_position);
            $class_name = substr($class_name, $last_namespace_position + 1);
            $file = str_replace('\\', '/', $namespace).'/';
        }

        $file .= $this->translateUnderscores($class_name).$this->file_extension;

        return $this->loadClass($this->src_path.$file);
    }
}
