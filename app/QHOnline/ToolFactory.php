<?php

namespace App\QHOnline;

class ToolFactory
{
    public function getThumbnail($filename)
    {
        if ($filename) {
            return preg_replace("/(.*)\.(.*)/i", '$1_thumb.$2', $filename);
        }
        return '';
    }
}
