<?php
/**
 * Index template
 *
 * Website home page
 *
 * PHP version 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @package    ResqueBoard
 * @subpackage ResqueBoard.View
 * @author     Wan Qi Chen <kami@kamisama.me>
 * @copyright  2012-2013 Wan Qi Chen
 * @link       http://resqueboard.kamisama.me
 * @since      1.0.0
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use ResqueBoard\Lib\Service\Service;

?>

<?php \ResqueBoard\Lib\PageHelper::renderJobStats($stats); ?>

<div class="full-width"></div>

<div class="ftr-bloc" ng-controller="lastestJobGraphController">
	<?php if (!isset(Service::$settings['Mongo']['collection'])): ?>
	<h3>Last activities</h3>
	<div id="lastest-jobs" ng-show="_init==1"></div>
		<placeholder status="_init" error-code="_errorCode" loading-content-name="lastest job activities"
			content-name="active workers" icon="icon-cogs" init="init()"></placeholder>
	<?php endif; ?>
	<div id="job-details" class="modal hide">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Jobs <span ng-show="jobs.length>0" class="badge badge-info">{{jobs.length}}</span></h3>
		</div>
		<div class="modal-body">
			<ng-include src="'partials/jobs-list.html'"></ng-include>
			<placeholder status="jobmodal._init" error-code="jobmodal._errorCode" loading-content-name="list of jobs"
			content-name="jobs" icon="icon-cogs" init="fillModal(jobmodal.lastTime)"></placeholder>
		</div>
	</div>
</div>

<div class="span5">
 	<ng-include src="'partials/workers-list.html'" ng-cloak></ng-include>
</div>

<div class="span6">
 	<ng-include src="'partials/queues-table.html'"ng-cloak></ng-include>
	<?php if (!isset(Service::$settings['Mongo']['collection'])): ?>
		<ng-include src="'partials/latest-jobs-heatmap.html'" ng-cloak></ng-include>
	<?php endif; ?>
</div>
