<!DOCTYPE html>
<html>
<head>
	<title>Insert Scripture</title>
</head>
<body>
	<article>
		<H1>Scripture Insert</H1>
		<form action="." method="post">
			<div class="form-group">
				<label>Book</label>
				<input type="text" name="book" class="form-control"required >
			</div>
			<div class="form-group">
				<label>Chapter</label> 
				<input type="text" name="chapter" class="form-control"required >
			</div>
			<div class="form-group">
				<label>Verse</label> 
				<input type="text" name="verse" class="form-control"required >
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" class="form-control" required ></textarea>
			</div>
			<div class="form-group">
				<label>Select Topic</label><br />
				<div class="row">
					<?php foreach ($topics as $topic): ?>
						<div class="space-1 col-all-6 col-xs-4 col-sm-3">
							<div class="input-group">
								<span class="input-group-addon">
									<input type="checkbox" name="topic_names[]" value="<?php echo $topic["name"]; ?>">
								</span>
								<div class="form-control">
									<?php echo $topic["name"]; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<div class="space-1 col-all-6 col-xs-4 col-sm-3">
						<div class="input-group">
							<span class="input-group-addon">
								<input type="checkbox" name="new_topic" value="true">
							</span>
							<input type="text" name="new_topic_name" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<button type="submit" name="action" value="insert_scripture" class="btn btn-default">Insert</button>
		</form>
	</article>
</body>
</html>

