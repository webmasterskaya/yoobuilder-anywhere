<?php
    /**
     * @package    yoobuilder_anywhere
     *
     * @author     Артём <your@email.com>
     * @copyright  A copyright
     * @license    GNU General Public License version 2 or later; see LICENSE.txt
     * @link       http://your.url.com
     */

    use Joomla\CMS\Helper\ModuleHelper;
    use Joomla\CMS\HTML\HTMLHelper;

    defined('_JEXEC') or die;

    JLoader::register('ModYoobuilderAnywhereHelper', __DIR__ . '/helper.php');

    $cacheid = md5($module->id);

    $cacheparams = new stdClass;
    $cacheparams->cachemode = 'id';
    $cacheparams->class = 'ModYoobuilderAnywhereHelper';
    $cacheparams->method = 'getArticle';
    $cacheparams->methodparams = $params;
    $cacheparams->modeparams = $cacheid;

    /** @var stdClass $article */
    $article = ModuleHelper::moduleCache($module, $params, $cacheparams);

    if (!empty($article)) {
        $pattern = '/^<!-- (\{.*\}) -->/';
        $content = preg_match($pattern, $article->fulltext, $matches) ? $matches[1] : null;
        if (!empty($content)) {
            $theme = HTMLHelper::_('theme');
            // Used to determine active builder layout in html/helpers.php
            $theme->set('builder', true);
            echo $theme->builder->render($content, ['prefix' => 'article']);
        }
        unset($content);
    }