<!--Nav bar area-->
<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<!--<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>-->
			<div class="nav-collapse collapse">
				<ul class="nav">
				<li class="">
					<a class="active" href="index.php" target="left">
						<?php echo $common_hql_query;?>
					</a>
				</li>
				<li class="">
					<a href="execEtl.php" target="right">
						<?php echo $common_etl;?>
					</a>
				</li>
				<li class="">
					<a href="getClusterStatus.php" target="right">
						<?php echo $common_cluster_status;?>
					</a>
				</li>
				<li class="">
					<a href="fileBrowser.php" target="right">
						<?php echo $common_hdfs_browser;?>
					</a>
				</li>
				<li class="">
					<a href="metaSummury.php" target="right">
						<?php echo $common_meta_summury;?>
					</a>
				</li>
				<li class="">
					<a href="history.php" target="right">
						<?php echo $common_history;?>
					</a>
				</li>
				<li class="">
					<a href="logOut.php" target="_parent">
						<?php echo $common_log_out;?>
					</a>
				</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--Nav bar area end-->