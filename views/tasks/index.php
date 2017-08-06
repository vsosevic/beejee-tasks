<div class="container">

	<!-- Sort by tags section -->
	<div class="row">
		<div class="col-sm-12 text-center">
			Sort by:
			<a href="?sort=user_name">
				<div class="btn <?php if($_GET['sort'] == 'user_name') { echo 'bg-success'; } ?>">User name</div>
			</a>
			<a href="?sort=user_email">
				<div class="btn <?php if($_GET['sort'] == 'user_email') { echo 'bg-success'; } ?>">Email</div>
			<a href="?sort=status">
				<div class="btn <?php if($_GET['sort'] == 'status') { echo 'bg-success'; } ?>">Status</div>
			</a>
		</div>
	</div>

	<!-- List of tasks -->
	<?php foreach ($tasksList as $task):?>
		<div class="row is-table-row">
			
			<div class="col-sm-9 <?php echo ($task['status'] == 1 ? 'bg-info' : 'bg-danger') ?>">

				<!-- show Done btn for admin -->
				<?php if(!empty($_SESSION) && $_SESSION['admin'] && $task['status'] == 0): ?>
					<a href="/tasks/done/<?php echo $task['id_task'] ?>"><button class="btn">Done</button></a>
				<?php endif; ?>

				<h3> <?php echo $task['text'];?> </h3>

				<h4><?php echo $task['user_name'] ?>
					<small> <?php echo $task['user_email']; ?> </small>
				</h4>
				
			</div>

			<?php if(isset($task['img_path'])): ?>
			<div class="col-sm-3 bg-success text-center" id="task-img">
				<img src="<?php echo $task['img_path'];?>" class="img-responsive center-block">
			</div>
			<?php endif; ?>

		</div>
	<?php endforeach;?>

	<!-- Pagination -->
	<div class="row">
		<div class="col-sm-12 text-center">

			<?php for ($i=1; $i <= $numberOfPages; $i++): ?>
				<a href='<?php echo "/tasks/page/$i" . (isset($_GET["sort"]) ? "?sort=" . $_GET["sort"] : ""); ?>' >
					<div class="btn <?php if($i != $pageNumber) { echo 'bg-success'; } ?>"> <?php echo $i ?></div>
				</a>
			<?php endfor; ?>

		</div>
	</div>

</div>