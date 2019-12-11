<?php
    /**
     * @package     ${NAMESPACE}
     * @subpackage
     *
     * @copyright   A copyright
     * @license     A "Slug" license name e.g. GPL2
     */

    defined('_JEXEC') or die;

    use Joomla\CMS\MVC\Model\BaseDatabaseModel;


    class ModYoobuilderAnywhereHelper
    {
        public static function getArticle(&$params)
        {
            $item_id = intval($params->get('item_id', 0));

            if (!empty($item_id)) {
                BaseDatabaseModel::addIncludePath(JPATH_ADMINISTRATOR . '/../com_content/models');
                /** @var ContentModelArticle $model */
                $model = BaseDatabaseModel::getInstance('Article', 'ContentModel');

                $item = $model->getItem($item_id);

                if (!empty(intval($item))) {
                    return $item;
                }
            }

            return false;
        }
    }