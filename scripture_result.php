<!DOCTYPE html>
<html>
<head>
	<title>Scripture Results</title>
</head>
<body>
	<article>
		<h1>Scripture Resources</h1>
		<ul>
			<?php foreach ($scriptures as $scripture): ?>
				<li>
					<p>
						<strong>
							<?php echo $scripture['name']; ?>&nbsp;
							<?php echo $scripture['chapter']; ?>:
							<?php echo $scripture['verse']; ?>
						</strong>
						- <?php echo $scripture['content']; ?>
					</p>
					<p>Topics: </p>
					<ul>
						<?php foreach ($scripture['topics'] as $topic): ?>
							<li><?php echo $topic['name']; ?></li>
						<?php endforeach; ?>
					</ul>
				</li>
			<?php endforeach; ?>
		</ul>
	</article>
</body>
</html>