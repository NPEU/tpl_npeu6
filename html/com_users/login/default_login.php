<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');
use Joomla\CMS\Factory;
$session = JFactory::getSession();
$registry = $session->get('registry');
$jinput = Factory::getApplication()->input;

$return = $registry->get('users.login.form.data.return', false);
if (!$return) {
    $return = '/user-profile';
} else {
    $return = base64_encode($return);
}
#echo '<pre>'; var_dump($return); echo '</pre>'; exit;
#echo '<pre>'; var_dump($jinput->get('return', '/user-profile')); echo '</pre>'; exit;
$return = $jinput->get('return', $return);

?>
<?php #echo TplNPEU6Helper::get_messages(); ?>

<?php if(isset($_GET['logged-out'])): ?>
<div>
    <p>You have successfully logged out.</p>
</div>
<?php endif; ?>

<?php if (
    ($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '')
  || $this->params->get('login_image') != ''
  ) : ?>
<div>
    <?php if($this->params->get('logindescription_show') == 1) : ?>
    <?php echo $this->params->get('login_description'); ?>
    <?php endif; ?>

    <?php if (($this->params->get('login_image')!='')) :?>
    <img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JTEXT::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="l-col-to-row--flush-edge-gutters  u-space--below">
    <div class="l-col-to-row  l-col-to-row--gutter">
        <div class="ff-width-100--45--33-333 l-col-to-row__item">

            <h2>NPEU Website</h2>
            <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="u-space--below--none">
                <fieldset class="u-space--below--none">
                    <div class="l-col-to-row">

                        <?php foreach ($this->form->getFieldset('credentials') as $field): ?>
                        <?php if (!$field->hidden): ?>

                        <?php
                        #$label = add_classes($field->label, '');
                        $label = $field->label;
                        #$input = add_classes(preg_replace('#\s?size="\d+"#', '', $field->input), '');
                        $input = $field->input;
                        if ($session->get('plgSystemFormErrors.password', false)) {
                            #$label = add_class($label, 'error');
                            #$input = add_class($input, 'error');
                        }
                        ?>
                        <div class="ff-width-100--25--25 l-col-to-row__item">
                        <?php echo $label; ?>
                        </div>
                        <div class="ff-width-100--25--75 l-col-to-row__item">
                        <?php echo $input; ?>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                    <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
                    <div>
                        <input id="remember" type="checkbox" name="remember" value="yes" />
                        <label id="remember-lbl" for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
                    </div>
                    <?php endif; ?>

                    <button type="submit"><?php echo JText::_('JLOGIN'); ?></button>
                    <input type="hidden" name="return" value="<?php echo $return; ?>" />
                    <?php echo JHtml::_('form.token'); ?>

                    <p class="u-text-group  u-text-group--wide-space">
                        <span>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
                            <?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
                        </span>
                        <span>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
                            <?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
                        </span>
                    </p>
                </fieldset>

            </form>

        </div>
        <div class="ff-width-100--45--66-666 l-col-to-row__item  u-text-align--center">

            <div class="u-fill-height">
                <div class="l-col-to-row">
                    <div class="ff-width-100--35--50 l-col-to-row__item">
                        <h2>Randomisation</h2>
                        <p class="u-padding--s">
                            <a href="https://rct.npeu.ox.ac.uk" rel="external" class="c-badge  c-badge--limit-height">
                                <img src="/assets/images/brand-logos/unit/npeu-ctu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-ctu-logo.png'; this.onerror=null;" alt="Logo: NPEU CTU" height="80">
                            </a>
                        </p>
                    </div>
                    <div class="ff-width-100--35--50 l-col-to-row__item">
                        <h2>MBRRACE-UK</h2>
                        <p class="u-padding--s">
                            <a href="https://www.mbrrace.ox.ac.uk/" rel="external" class="c-badge  c-badge--limit-height">
                                <img src="/assets/images/brand-logos/unit/mbrrace-uk-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/mbrrace-uk-logo.png'; this.onerror=null;" alt="Logo: MBRRACE-UK" height="80">
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>