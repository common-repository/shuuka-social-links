<?php
function SHUUKAGetPluginFilePath($folderName, $relativePath)
{
    return WP_PLUGIN_DIR . '/' . $folderName . '/' . $relativePath;
}