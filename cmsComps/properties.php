<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$tableData=["vers","blocked","published","created_by","created_on","edited_by","edited_on","published_on","published_by"];
?>
<div style='max-width: 80%;margin: auto;margin-top:10px;'>
	<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Properties</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Other Infos</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
			<form class="form-horizontal">
				<div class="form-group">
					<label for="slug" class="col-sm-3 control-label">Content Code</label>
					<div class="col-sm-9">
						<p class="form-control-static"><?=$_POST['slug']?></p>
					</div>
				</div>
				<?php
					foreach($data as $key=>$val) {
						if(in_array($key,$tableData)) continue;
				?>
					<div class="form-group">
						<label for="<?=$key?>" class="col-sm-3 control-label"><?=toTitle($key)?></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="<?=$key?>" placeholder="<?=toTitle($key)?>" value='<?=$val?>' />
						</div>
					</div>
				<?php
					}
				?>
				<div class="form-group">
					<label for="blocked" class="col-sm-3 control-label">Blocked</label>
					<div class="col-sm-9">
						<select class="form-control" name="blocked">
							<?php
								if($data['blocked']=="true") {
									echo "<option value='false'>False</option><option value='true' selected>True</option>";
								} else {
									echo "<option value='false' selected>False</option><option value='true'>True</option>";
								}
							?>
						</select>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<button onclick='saveProperties(this)' type="button" class="btn btn-default btn-success pull-right">Submit</button>
					</div>
				</div>
			</form>
		</div>
    <div role="tabpanel" class="tab-pane" id="profile">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tbody>
					<?php
					$tableData=array_diff($tableData, ['blocked'] );
					foreach($data as $key=>$val) {
						if(!in_array($key,$tableData)) continue;
					?>
						<tr>
							<th>#</th>
							<th><?=toTitle($key)?></th>
							<td><?=$val?></td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
  </div>
</div>