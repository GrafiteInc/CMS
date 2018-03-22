<?php

namespace Grafite\Cms\Services;

class BaseService
{
    /**
     * Get templates as options
     *
     * @param  string $module
     *
     * @return array
     */
    public function getTemplatesAsOptionsArray($module)
    {
        $availableTemplates = ['show'];
        $templates = glob(base_path('resources/themes/'.config('cms.frontend-theme').'/'.$module.'/*'));

        foreach ($templates as $template) {
            $template = str_replace(base_path('resources/themes/'.config('cms.frontend-theme').'/'.$module.'/'), '', $template);
            if (stristr($template, 'template')) {
                $template = str_replace('-template.blade.php', '', $template);
                if (!stristr($template, '.php')) {
                    $availableTemplates[] = $template.'-template';
                }
            }
        }

        return $availableTemplates;
    }
}
