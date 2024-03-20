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

echo $this->data['nav']->render();

$length = \max(12, 12);
?>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Loans'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table id="iVehicleList" class="default sticky">
                <thead>
                <tr>
                    <td>Loan
                    <td>
                <?php for ($i = 0; $i < $length; ++$i) : ?>
                    <td>
                <?php endfor; ?>
                <tbody>
                    <tr>
                        <td>Test
                        <td><span>Interest</span><br><span>Other costs</span><br><span>Repayment</span><br><span>Payout</span>
                        <?php for ($i = 0; $i < $length; ++$i) : ?>
                            <td>
                        <?php endfor; ?>
                    <tr>
                        <td>Test
                        <td><span>Interest</span><br><span>Other costs</span><br><span>Repayment</span><br><span>Payout</span>
                        <?php for ($i = 0; $i < $length; ++$i) : ?>
                            <td>
                        <?php endfor; ?>
                    <tr>
                        <td>Test
                        <td><span>Interest</span><br><span>Other costs</span><br><span>Repayment</span><br><span>Payout</span>
                        <?php for ($i = 0; $i < $length; ++$i) : ?>
                            <td>
                        <?php endfor; ?>