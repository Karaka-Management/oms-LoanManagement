<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\LoanManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View $this
 */
$loans = $this->data['loans'];

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Loans'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td><?= $this->getHtml('Loan'); ?>
                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                    <td><?= $this->getHtml('Start'); ?>
                    <td><?= $this->getHtml('End'); ?>
                <tbody>
                <?php $c = 0;
                foreach ($loans as $key => $value) : ++$c;
                    $url = UriFactory::build('{/base}/finance/loan/view?{?}&id=' . $value->id); ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $value->id; ?></a>
                    <td><a href="<?= $url; ?>"></a>
                    <td><a href="<?= $url; ?>"><?= $value->name; ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->start?->format('Y-m-d'); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->end?->format('Y-m-d'); ?></a>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
                    <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
            </div>
        </section>
    </div>
</div>
