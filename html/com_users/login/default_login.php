<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$session = Factory::getSession();
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
    ($this->params->get('logindescription_show') == 1 && $this->params->get('login_description') && trim($this->params->get('login_description')) != '')
  || $this->params->get('login_image') != ''
  ) : ?>
<div>
    <?php if($this->params->get('logindescription_show') == 1) : ?>
    <?php echo $this->params->get('login_description'); ?>
    <?php endif; ?>

    <?php if (($this->params->get('login_image')!='')) :?>
    <img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo Text::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="l-layout  l-row  l-gutter  l-flush-edge-gutter">
    <div class="l-layout__inner">

        <div class="l-box  ff-width-100--45--33-333">

            <h2>NPEU Website</h2>
            <form action="<?php echo Route::_('index.php?option=com_users&task=user.login'); ?>" method="post">
                <fieldset>

                    <?php foreach ($this->form->getFieldset('credentials') as $field): ?>
                    <?php if (!$field->hidden): ?>
                    <div class="l-layout  l-row">
                        <div class="l-layout__inner">

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
                            <div class="l-box  l-box--space--inline-end  ff-width-100--25--25">
                            <?php echo $label; ?>
                            </div>
                            <div class="l-box  ff-width-100--25--75">
                            <?php echo str_replace('class="', 'class="u-fill-width  ', $input); ?>
                            </div>

                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="l-layout  l-row  l-row--start">
                        <div class="l-layout__inner">
                            <?php if (PluginHelper::isEnabled('system', 'remember')) : ?>
                            <div class="l-box  l-box--space--inline-end">
                                <input id="remember" type="checkbox" name="remember" value="yes" />
                                <label id="remember-lbl" for="remember"><?php echo Text::_('JGLOBAL_REMEMBER_ME') ?></label>
                            </div>
                            <?php endif; ?>
                            <div class="l-box  l-box--push-end">
                                <button type="submit"><?php echo Text::_('JLOGIN'); ?></button>
                                <input type="hidden" name="return" value="<?php echo $return; ?>" />
                                <?php echo HTMLHelper::_('form.token'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="l-layout  l-row  l-row--start">
                        <p class="l-layout__inner">
                            <span class="l-box  l-box--space--inline-end">
                                <a href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>"><?php echo Text::_('COM_USERS_LOGIN_REMIND'); ?></a>
                            </span>
                            <span class="l-box">
                                <a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>"><?php echo Text::_('COM_USERS_LOGIN_RESET'); ?></a>
                            </span>
                        </p>
                    </div>
                </fieldset>

            </form>

        </div>
        <div class="l-box  ff-width-100--45--66-666  u-text-align--center">

            <div class="u-fill-height">
                <div class="l-layout  l-row  l-gutter  l-flush-edge-gutter  mod_cardlist">
                    <div class="l-layout__inner">
                        <div class="l-box  ff-width-100--35--50">
                            <h2>Randomisation</h2>
                            <p class="u-padding--s">
                                <a href="https://rct.npeu.ox.ac.uk" rel="external" class="c-badge  c-badge--limit-height">
                                    <img src="/assets/images/brand-logos/unit/npeu-ctu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-ctu-logo.png'; this.onerror=null;" alt="Logo: NPEU CTU" height="80" width="245">
                                </a>
                            </p>
                        </div>
                        <div class="l-box  ff-width-100--35--50">
                            <h2>MBRRACE-UK</h2>
                            <p class="u-padding--s">
                                <a href="https://www.mbrrace.ox.ac.uk/" rel="external" class="c-badge  c-badge--limit-height">
                                    <img src="/assets/images/brand-logos/unit/mbrrace-uk-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/mbrrace-uk-logo.png'; this.onerror=null;" alt="Logo: MBRRACE-UK" height="80" width="256">
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>