<?php
/**
 * Json Modul SiteOp mod_rm_statistik_json.php
 *
 * @version         1.0.0
 * @package         mod_rm_statistik_json
 * @author          Richard Gebhard <gebhard@site-optimierer.de>
 * @copyright       Copyright © 2020 Site-Optimierer All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link            https://www.site-optimierer.de
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

?> 

<?php if (0 == $debugapi) : ?>

		<div style="width:310px; border: 1px solid; padding: 20px;">

			<div class="statistik_routes">
				<div class="header"><b>Neueste Routen</b></div>
				<div class="statistik_body">
					<?php foreach ($jrequest->data->route as $route) : ?>
						<div>
							<?php echo $route->uiaa; ?>
							<?php echo $route->name; ?> 
							<?php echo HTMLHelper::_('date', $route->created, 'd.m.Y'); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			
			<div class="statistik_comments">
				<div class="header">
					<b>Neueste Kommentare</b>
				</div>
				<div class="statistik_body">
					<?php foreach ($jrequest->data->comment as $comment) : ?>
						<div>
							<?php echo $comment->stars; ?><br />
							<?php echo HTMLHelper::_('string.truncate', $comment->comment, 90, false, false ); ?>
						</div>	
					<?php endforeach; ?>
				</div>
			</div>
			
		</div>

<?php else : ?>
<?php print_R($jrequest); ?>
<?php endif; ?>

