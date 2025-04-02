<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\LoanManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\LoanManagement\Models\NullLoan;

$loan  = $this->data['loan'] ?? new NullLoan();
$isNew = $loan->id === 0;

echo $this->data['nav']->render(); ?>
<div class="tabview tab-2">
    <?php if (!$isNew) : ?>
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Loan'); ?></label>
            <li><label for="c-tab-2"><?= $this->getHtml('Timeline'); ?></label>
        </ul>
    </div>
    <?php endif; ?>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2"<?= $isNew || $this->request->uri->fragment === 'c-tab-1' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <form id="fLoan"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}finance/loan?{?}&csrf={$CSRF}'); ?>">
                        <div class="portlet-head"><?= $this->getHtml('Loan'); ?></div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                                    <input type="text" name="id" id="iId" value="<?= $loan->id; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="iName"><?= $this->getHtml('Name'); ?></label>
                                    <input type="text" name="name" id="iName" value="<?= $this->printHtml($loan->name); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="iDescription"><?= $this->getHtml('Description'); ?></label>
                                    <textarea name="description" id="iDescription"><?= $this->printTextarea($loan->description); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="iSupplier"><?= $this->getHtml('Supplier'); ?></label>
                                    <input type="text" name="name" id="iSupplier" value="<?= $this->printHtml($loan->loanProvider->account->name1); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="iStart"><?= $this->getHtml('Start'); ?></label>
                                    <input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml($loan->start?->format('Y-m-d\TH:i:s')); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="iEnd"><?= $this->getHtml('End'); ?></label>
                                    <input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml($loan->end?->format('Y-m-d\TH:i:s')); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="iRate"><?= $this->getHtml('Rate%'); ?></label>
                                    <input type="number" step="any" id="iRate" name="rate" value="<?= $this->getCurrency($loan->nominalBorrowingRate, symbol: ''); ?>">
                                </div>
                            </div>
                            <div class="portlet-foot">
                                <?php if ($isNew) : ?>
                                    <input id="iCreateSubmit" type="Submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                                <?php else : ?>
                                    <input id="iSaveSubmit" type="Submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                                <?php endif; ?>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>