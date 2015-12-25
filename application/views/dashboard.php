<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>

<div class="dashboard">

	<div class="container">
		<div class="tab-group" tabs style="display: none;">
			<a href="#/published" class="tab" ng-class="{'is--active': status == 1}">Published</a>
			<a href="#/drafts" class="tab" ng-class="{'is--active': status == 2}">Drafts</a>
			<a href="#/errors" class="tab" ng-class="{'is--active': status == 3}">Errors [{{errors}}]</a>
		</div>
	</div>

	<div ng-view=""></div>

</div>

<?php $this->load->view('partials/footer'); ?>
