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
	<div id="rmstatistk">

		<div class="statistik_routes">
			<div class="header">
				<a  class=""
					data-toggle="collapse" 
					href="#collapseRoutes" 
					role="button" 
					aria-expanded="true" 
					aria-controls="collapseRoutes">
					<span class="rmicon"><i class="fas fa-chevron-down"></i></span>
					<span class="rm_header">Neueste Routen</span> 
				</a>
			</div>
			<div class="statistik_body">
				
				<?php for ($i = 0; $i < $show_beginn_routes; $i++) : ?>
					<div class="d-flex">
						<div class="" style="width: 2.3rem;"><?php echo $jrequest->data->route[$i]->uiaa; ?></div>
						<div class="">
							<a href="<?php echo $rm_url. $url_rm_route. $jrequest->data->route[$i]->id; ?>.html" target=_blank>
								<?php echo HTMLHelper::_('string.truncate', $jrequest->data->route[$i]->name, 23, false, false ); ?>
							</a>
						</div>
						<div class="ml-auto"><?php echo HTMLHelper::_('date', $jrequest->data->route[$i]->setterdate, 'd.m'); ?></div>
					</div>	
				<?php endfor; ?>
					<div class="collapse" id="collapseRoutes" aria-labelledby="routes" data-parent="#rmstatistk">
				
					<?php for ($i = 5; $i < $count_routes; $i++) : ?>
						<div class="d-flex">
							<div class="" style="width: 2.3rem;"><?php echo $jrequest->data->route[$i]->uiaa; ?></div>
							<div class="">
								<a href="<?php echo $rm_url. $url_rm_route. $jrequest->data->route[$i]->id; ?>.html" target=_blank>
									<?php echo HTMLHelper::_('string.truncate', $jrequest->data->route[$i]->name, 23, false, false ); ?>
								</a>
							</div>
						<div class="ml-auto"><?php echo HTMLHelper::_('date', $jrequest->data->route[$i]->setterdate, 'd.m'); ?></div>
					</div>	
					<?php endfor; ?>
				</div> 
				</div> 
			</div>
		
		<div class="statistik_comments mt-4">
			<div class="header">
				<a  class=""
					data-toggle="collapse" 
					href="#collapseComments" 
					role="button" 
					aria-expanded="true" 
					aria-controls="collapseComments">
					<span class="rmicon"><i class="fas fa-chevron-down"></i></span>
					<span class="rm_header">Neueste Kommentare</span> 
				</a>
			</div>
			<div class="statistik_body">
				<?php for ($i = 0; $i < $show_beginn_comments; $i++) : ?>
					<div class="mb-2">
						<span class="Stars" style=" --rating: <?php echo $jrequest->data->comment[$i]->stars; ?>;"></span>
						<span style="width: 35px;  display: inline-block; text-align: center"><?php echo $jrequest->data->comment[$i]->uiaa; ?></span>
						<a href="<?php echo $rm_url. $url_rm_route. $jrequest->data->comment[$i]->route_id; ?>.html"
								    class="float-right" 
									title="Zur Route"
									target="_blank">
									<i class="fas fa-chevron-circle-right"></i>
								</a>
						<div>
							<a rel="popover" 
								data-placement="bottom" 
								data-trigger="hover" 
								data-content="<?php echo trim($jrequest->data->comment[$i]->comment, '"'); ?>" <?php // Trim "" sonst bug Popover ?> 
							>
							<?php echo HTMLHelper::_('string.truncate', $jrequest->data->comment[$i]->comment, 75, false, false ); ?>
							</a>
							
						</div>
					</div>	
				<?php endfor; ?>
					<div class="collapse" id="collapseComments" aria-labelledby="comemnts" data-parent="#rmstatistk">
						<?php for ($i = $show_beginn_comments; $i < $count_comments; $i++) : ?>
							<div class="mb-2">
								<span class="Stars" style=" --rating: <?php echo $jrequest->data->comment[$i]->stars; ?>;"></span>
								<span style="width: 35px;  display: inline-block; text-align: center"><?php echo $jrequest->data->comment[$i]->uiaa; ?></span>
								 <a href="<?php echo $rm_url. $url_rm_route. $jrequest->data->comment[$i]->route_id; ?>.html"
								    class="float-right" 
									title="Zur Route"
									target="_blank">
									<i class="fas fa-chevron-circle-right"></i>
								</a>
								<div>
									<a rel="popover" 
						  	    	   data-placement="bottom" 
								       data-trigger="hover" 
									   data-content="<?php echo trim($jrequest->data->comment[$i]->comment, '"'); ?>" <?php // Trim "" sonst bug Popover ?> 
									>
									<?php echo HTMLHelper::_('string.truncate', $jrequest->data->comment[$i]->comment, 75, false, false ); ?>
									</a>
								</div>
							</div>	
						<?php endfor; ?>
					</div>
			</div>
		</div>
			
		<div class="rm_footer">
			<span class="rm_footer_txt">Aktuell <?php echo $jrequest->data->routestotal; ?> Routen</span>
			<a href="<?php echo $rm_url; ?>" 
			   target="_blank" 
			   rel="noopener" 
			   class="float-right" 
			   title="Zur Routendatenbank des Kletterzentrum Augsburg">
			   <i class="fas fa-hand-point-right"></i>
			</a>
		</div>
	</div>
		

<?php if($isAdmin AND 1 == $debugapi) :?>
	<?php print_R($jrequest); ?>
<?php endif; ?>

<script>
	jQuery(document).ready(function() {
        jQuery('[rel=popover]').popover();
	});
</script>