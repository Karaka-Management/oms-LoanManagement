<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\LoanManagement\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\LoanManagement\Admin;

use phpOMS\Application\ApplicationAbstract;
use phpOMS\Config\SettingsInterface;
use phpOMS\Module\InstallerAbstract;
use phpOMS\Module\ModuleInfo;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;

/**
 * Installer class.
 *
 * @package Modules\LoanManagement\Admin
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class Installer extends InstallerAbstract
{
    /**
     * Path of the file
     *
     * @var string
     * @since 1.0.0
     */
    public const PATH = __DIR__;

    /**
     * {@inheritdoc}
     */
    public static function install(ApplicationAbstract $app, ModuleInfo $info, SettingsInterface $cfgHandler) : void
    {
        parent::install($app, $info, $cfgHandler);

        /* Material types */
        $fileContent = \file_get_contents(__DIR__ . '/Install/costtypes.json');
        if ($fileContent === false) {
            return;
        }

        /** @var array $types */
        $types             = \json_decode($fileContent, true);
        $materialTypeArray = self::createCostTypes($app, $types);
    }

    /**
     * Install default material types
     *
     * @param ApplicationAbstract $app   Application
     * @param array               $types Material type definitions
     *
     * @return array
     *
     * @since 1.0.0
     */
    private static function createCostTypes(ApplicationAbstract $app, array $types) : array
    {
        /** @var array<string, array> $costType */
        $costType = [];

        /** @var \Modules\LoanManagement\Controller\ApiController $module */
        $module = $app->moduleManager->get('LoanManagement', 'Api');

        /** @var array $type */
        foreach ($types as $type) {
            $response = new HttpResponse();
            $request  = new HttpRequest();

            $request->header->account = 1;
            $request->setData('name', $type['name'] ?? '');
            $request->setData('title', \reset($type['l11n']));

            $module->apiLoanCostTypeCreate($request, $response);

            $responseData = $response->getData('');
            if (!\is_array($responseData)) {
                continue;
            }

            $costType[$type['name']] = \is_array($responseData['response'])
                ? $responseData['response']
                : $responseData['response']->toArray();

            $isFirst = true;
            foreach ($type['l11n'] as $language => $l11n) {
                if ($isFirst) {
                    $isFirst = false;
                    continue;
                }

                $response = new HttpResponse();
                $request  = new HttpRequest();

                $request->header->account = 1;
                $request->setData('title', $l11n);
                $request->setData('language', $language);
                $request->setData('type', $costType[$type['name']]['id']);

                $module->apiLoanCostTypeL11nCreate($request, $response);
            }
        }

        return $costType;
    }
}
