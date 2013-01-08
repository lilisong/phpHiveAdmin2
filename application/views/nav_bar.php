<!--Nav bar area-->
<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<a class="brand" href="<?php echo $this->config->base_url();?>"><?php echo $common_title;?></a>
		<div class="container">
			<!--<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>-->
			<div class="nav-collapse collapse">
				<ul class="nav">
				<li class="">
					<a class="active" href="/index.php">
						<?php echo $common_hql_query;?>
					</a>
				</li>
				<li class="">
					<a href="execEtl.php" target="right">
						<?php echo $common_etl;?>
					</a>
				</li>
				<li class="">
					<a href="getClusterStatus.php">
						<?php echo $common_cluster_status;?>
					</a>
				</li>
				<li class="">
					<a href="fileBrowser.php">
						<?php echo $common_hdfs_browser;?>
					</a>
				</li>
				<li class="">
					<a href="metaSummury.php">
						<?php echo $common_meta_summury;?>
					</a>
				</li>
				<li class="">
					<a href="history.php">
						<?php echo $common_history;?>
					</a>
				</li>
				<li class="">
					<a href="logOut.php">
						<?php echo $common_log_out;?>
					</a>
				</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--Nav bar area end-->