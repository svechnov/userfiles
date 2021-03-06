<?php


class UserFilesOnDocFormPrerender extends UserFilesPlugin
{
    public function run()
    {
        $id = $this->modx->getOption('id', $this->scriptProperties, 0, true);
        $mode = $this->modx->getOption('mode', $this->scriptProperties, modSystemEvent::MODE_NEW, true);
        if ($mode == modSystemEvent::MODE_NEW OR empty($id)) {
            return;
        }

        /** @var modResource $resource */
        if (
            !$resource = $this->modx->getOption('resource', $this->scriptProperties)
            OR
            !$this->UserFiles->Tools->isWorkingTemplates($resource)
        ) {
            return;
        }

        $controller = &$this->modx->controller;
        $this->UserFiles->Tools->loadControllerJsCss($controller, array(
            'css'             => true,
            'config'          => true,
            'tools'           => true,
            'jquery'          => true,
            'dropzone'        => true,
            'cropper'         => true,
            'file'            => true,
            'inject/resource' => true,
        ));

        $this->modx->invokeEvent('UserFilesOnManagerCustomCssJs',
            array('controller' => $controller, 'page' => 'resource'));

    }

}